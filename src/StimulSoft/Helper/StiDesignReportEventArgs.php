<?php

namespace StimulSoft\Helper;

class StiDesignReportEventArgs {
    public $fileName = null;

    function __construct($fileName) {
        $this->fileName = $fileName;
    }
}
