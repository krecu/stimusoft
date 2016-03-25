<?php

namespace StimulSoft\Trigger;

/**
 * Class TriggerContext
 * @package StimulSoft\Trigger
 */
class TriggerContext {

    /** @var null|TriggerInterface  */
    private $strategy = NULL;

    /**
     * TriggerContext constructor.
     * @param TriggerInterface $strategy
     */
    public function __construct(TriggerInterface $strategy) {
        return $this->strategy = $strategy;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request) {
        return $this->strategy->execute($request);
    }
}