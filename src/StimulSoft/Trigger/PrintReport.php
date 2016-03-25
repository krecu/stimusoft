<?php

namespace StimulSoft\Trigger;

/**
 * Class PrintReport
 * @package StimulSoft\Trigger
 */

class PrintReport implements TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        $args->fileName = $request->fileName;
        
        return "Not implement";
    }
}
