<?php

namespace StimulSoft\Trigger;

/**
 * Class EmailReport
 * @package StimulSoft\Trigger
 */

class EmailReport implements TriggerInterface {

    /**
     * @param $request
     * @return mixed
     */
    public function execute($request)
    {
        $args = new \stdClass();

        // $settings->to = $request->settings->email;
        // $settings->subject = $request->settings->subject;
        // $settings->message = $request->settings->message;
        // $settings->attachmentName = $request->fileName.'.'.$this->getFileExtension($request->format);
        
        return "Not implement";
    }
}
