<?php

namespace StimulSoft\Helper;

class StiReportEventArgs {
    public $sender = null;
    public $report = null;

    function __construct($sender, $report = null) {
        $this->sender = $sender;
        $this->report = $report;
    }
}