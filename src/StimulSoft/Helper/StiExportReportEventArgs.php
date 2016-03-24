<?php

namespace StimulSoft\Helper;

class StiExportReportEventArgs {
    public $sender = null;
    public $settings = null;
    public $format = null;
    public $fileName = null;
    public $data = null;

    function __construct($settings, $format, $fileName, $data = null) {
        $this->settings = $settings;
        $this->format = $format;
        $this->fileName = $fileName;
        $this->data = $data;
    }
}