<?php

namespace StimulSoft\Helper;

use \StimulSoft\Adapter\StiMsSqlAdapter;
use \StimulSoft\Adapter\StiPostgreSqlAdapter;
use \StimulSoft\Adapter\StiFirebirdAdapter;
use \StimulSoft\Adapter\StiMySqlAdapter;

use StimulSoft\Helper\StiResult;
use StimulSoft\Helper\StiResponse;
use StimulSoft\Helper\StiRequest;



new \StimulSoft\Trigger\TriggerContext(new \StimulSoft\Trigger\SaveAsReport());


class StiHandler
{

    const XML = "XML";
    const JSON = "JSON";
    const MySQL = "MySQL";
    const MSSQL = "MS SQL";
    const PostgreSQL = "PostgreSQL";
    const Firebird = "Firebird";

    const BeginProcessData = "BeginProcessData";
    //const EndProcessData = "EndProcessData";
    const CreateReport = "CreateReport";
    const OpenReport = "OpenReport";
    const SaveReport = "SaveReport";
    const SaveAsReport = "SaveAsReport";
    const PrintReport = "PrintReport";


    const Html = "Html";
    const Html5 = "Html5";
    const Pdf = "Pdf";
    const Excel2007 = "Excel2007";
    const Word2007 = "Word2007";

    private function checkEventResult($event, $args)
    {
        if (isset($event)) $result = $event($args);
        if (!isset($result)) $result = StiResult::success();
        if ($result === true) return StiResult::success();
        if ($result === false) return StiResult::error();
        if (gettype($result) == "string") return StiResult::error($result);
        if (isset($args)) $result->object = $args;
        return $result;
    }

    public $onBeginProcessData = null;

    private function invokeBeginProcessData($request)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        $args->database = $request->database;
        $args->connectionString = $request->connectionString;
        $args->queryString = $request->queryString;
        return $this->checkEventResult($this->onBeginProcessData, $args);
    }

    public $onEndProcessData = null;

    private function invokeEndProcessData($request, $result)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        $args->result = $result;
        return $this->checkEventResult($this->onEndProcessData, $args);
    }


    /**
     * Перенаправляем все ошибки на свои обработчики
     */
    public function registerErrorHandlers()
    {
        set_error_handler(array($this, 'stiErrorHandler'));
        register_shutdown_function(array($this, 'stiShutdownFunction'));
    }


    public function stiErrorHandler($errNo, $errStr, $errFile, $errLine) {
        $result = StiResult::error("[".$errNo."] ".$errStr." (".$errFile.", Line ".$errLine.")");
        StiResponse::json($result);
    }

    public function stiShutdownFunction() {
        $err = error_get_last();
        if (($err["type"] & E_COMPILE_ERROR) || ($err["type"] & E_ERROR) || ($err["type"] & E_CORE_ERROR) || ($err["type"] & E_RECOVERABLE_ERROR)) {
            $result = StiResult::error("[".$err["type"]."] ".$err["message"]." (".$err["file"].", Line ".$err["line"].")");
            StiResponse::json($result);
        }
    }

    /**
     * Типа респонс на реквест
     *
     * @param bool $response
     * @return null|StiResult
     */
    public function process($response = true)
    {
        $result = $this->innerProcess();
        if ($response) StiResponse::json($result);
        return $result;
    }


    /**
     * Create DB connection
     *
     * @param $args
     * @return StiResult
     */
    private function createConnection($args)
    {
        switch ($args->database) {
            case self::MySQL:
                $connection = new StiMySqlAdapter();
                break;
            case self::MSSQL:
                $connection = new StiMsSqlAdapter();
                break;
            case self::Firebird:
                $connection = new StiFirebirdAdapter();
                break;
            case self::PostgreSQL:
                $connection = new StiPostgreSqlAdapter();
                break;
        }

        if (isset($connection)) {
            $connection->parse($args->connectionString);
            return StiResult::success(null, $connection);
        }

        return StiResult::error("Unknown database type [" . $args->database . "]");
    }

    private function innerProcess()
    {
        $request = new StiRequest();
        $result = $request->parse();

        if (method_exists($this, $request->event)) {
            return $this->{$request->event}($request);
        } else {
            $result = StiResult::error("Unknown event [" . $request->event . "]");
        }



        if ($result->success) {
            switch ($request->event) {
                case self::BeginProcessData:
                    $result = $this->invokeBeginProcessData($request);
                    if (!$result->success) return $result;
                    $queryString = $result->object->queryString;
                    $result = $this->createConnection($result->object);
                    if (!$result->success) return $result;
                    $connection = $result->object;
                    if (isset($queryString)) $result = $connection->execute($queryString);
                    else $result = $connection->test();
                    $result = $this->invokeEndProcessData($request, $result);
                    if (!$result->success) return $result;
                    if (isset($result->object) && isset($result->object->result)) return $result->object->result;
                    return $result;
            }

            $result = StiResult::error("Unknown event [" . $request->event . "]");
        }

        return $result;
    }

}