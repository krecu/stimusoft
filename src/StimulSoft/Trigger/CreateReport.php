<?php

namespace StimulSoft\Trigger;

/**
 * Class BeginExportReport
 * @package StimulSoft\Trigger
 */

class CreateReport implements TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $args = new \stdClass();
        $args->sender = $request->sender;
        return "Not implement";
    }
}
