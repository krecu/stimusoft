<?php

namespace StimulSoft\Trigger;

/**
 * Class BeginExportReport
 * @package StimulSoft\Trigger
 */

class BeginExportReport implements TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        $args->database = $request->database;
        $args->connectionString = $request->connectionString;
        $args->queryString = $request->queryString;

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

        return "Not implement";
    }
}
