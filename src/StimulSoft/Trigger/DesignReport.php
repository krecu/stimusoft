<?php

namespace StimulSoft\Trigger;

/**
 * Class DesignReport
 * @package StimulSoft\Trigger
 */

class DesignReport implements TriggerInterface {

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
