<?php

namespace StimulSoft\Helper;

class StiSaveReportEventArgs {
    public $sender = null;
    public $report = null;
    public $fileName = null;

    function __construct($report, $fileName) {
        $this->report = $report;
        $this->fileName = $fileName;
    }
}
