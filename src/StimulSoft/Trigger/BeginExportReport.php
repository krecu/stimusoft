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
        $args->settings = $request->settings;
        $args->format = $request->format;
        $args->fileName = $request->fileName;
        
        return "Not implement";
    }
}
