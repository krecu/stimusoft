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
        $args->result = $result;
        
        return "Not implement";
    }
}
