<?php

namespace StimulSoft\Trigger;

/**
 * Class BeginExportReport
 * @package StimulSoft\Trigger
 */

class SaveReport implements TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        $args->report = $request->report;
        $args->fileName = $request->fileName;
        
        return "Not implement";
    }
}
