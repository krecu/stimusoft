<?php

namespace StimulSoft\Trigger;

/**
 * Class EndExportReport
 * @package StimulSoft\Trigger
 */

class EndExportReport implements TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        $args->format = $request->format;
        $args->fileName = $request->fileName;
        $args->data = $request->data;
        
        return "Not implement";
    }
}
