<?php

namespace StimulSoft\Trigger;

/**
 * Class SaveAsReport
 * @package StimulSoft\Trigger
 */

class SaveAsReport implements TriggerInterface {

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
