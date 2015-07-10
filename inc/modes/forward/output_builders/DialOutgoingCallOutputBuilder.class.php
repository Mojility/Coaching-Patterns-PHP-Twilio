<?php

include_once("inc/modes/OutputBuilder.class.php");

class DialOutgoingCallOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return
            $group->isAdministrator($from)
            && (10 == strlen($digits));
    }

    public function handle($group, $from, $digits) {
        return $this->responseWriter->outputOutgoingCallResponse($group, $digits);
    }

}