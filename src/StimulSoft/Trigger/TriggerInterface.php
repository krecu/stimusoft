<?php

namespace StimulSoft\Trigger;

/**
 * Interface TriggerInterface
 * @package StimulSoft\Trigger
 */
interface TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request);
}