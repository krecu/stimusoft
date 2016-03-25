<?php

namespace StimulSoft\Helper;

class StiDatabaseEventArgs {
    public $sender = null;
    public $database = null;
    public $connectionInfo = null;
    public $queryString = null;

    function __construct($sender, $database, $connectionInfo, $queryString = null) {
        $this->sender = $sender;
        $this->database = $database;
        $this->connectionInfo = $connectionInfo;
        $this->queryString = $queryString;
    }
}