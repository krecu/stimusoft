<?php

namespace StimulSoft\Helper;

use StimulSoft\Helper\StiResult;

class StiRequest {
    public $sender = null;
    public $event = null;
    public $connectionString = null;
    public $queryString = null;
    public $database = null;
    public $report = null;
    public $data = null;
    public $fileName = null;
    public $format = null;
    public $settings = null;

    public function parse() {
        $data = null;
        if (isset($HTTP_RAW_POST_DATA)) $data = $HTTP_RAW_POST_DATA;
        if ($data == null) $data = file_get_contents("php://input");

        $obj = json_decode($data);
        if ($obj == null) return StiResult::error("JSON parser error");

        if (isset($obj->sender)) $this->sender = $obj->sender;
        if (isset($obj->event)) $this->event = $obj->event;
        if (isset($obj->connectionString)) $this->connectionString = $obj->connectionString;
        if (isset($obj->queryString)) $this->queryString = $obj->queryString;
        if (isset($obj->database)) $this->database = $obj->database;
        if (isset($obj->report)) $this->report = $obj->report;
        if (isset($obj->data)) $this->data = $obj->data;
        if (isset($obj->fileName)) $this->fileName = $obj->fileName;
        if (isset($obj->format)) $this->format = $obj->format;
        if (isset($obj->settings)) $this->settings = $obj->settings;

        return StiResult::success(null, $this);
    }
}