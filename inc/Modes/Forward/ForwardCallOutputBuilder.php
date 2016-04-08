<?php

namespace Modes\Forward;

use Group;
use Modes\OutputBuilder;

class ForwardCallOutputBuilder extends OutputBuilder {

    public function canHandle($groupMode) {
        return $groupMode == Group::FORWARD_MODE;
    }

    public function buildOutput($group, $from, $digits = null) {
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
        return $output;
    }

}
