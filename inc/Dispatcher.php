<?php

class Dispatcher {

    protected $responseWriter;

    function __construct($responseWriter) {
        $this->responseWriter = $responseWriter;
    }

    function invoke($group, $from, $digits) {
        if (Group::FORWARD_MODE == $group->getMode()) {
            if (!$group->isAdministrator($from)) {
                $output = $this->responseWriter->outputForwardCallResponse($group);
            } else {
                if ($digits) {
                    if (10 == strlen($digits)) {
                        $output = $this->responseWriter->outputOutgoingCallResponse($group, $digits);
                    } else {
                        $output = $this->responseWriter->outputInvalidDigitsResponse();
                    }
                } else {
                    $output = $this->responseWriter->outputGatherDigitsResponse();
                }
            }
        } else {
            $output = $this->responseWriter->outputRejectCallResponse();
        }
        return $output;
    }

}
