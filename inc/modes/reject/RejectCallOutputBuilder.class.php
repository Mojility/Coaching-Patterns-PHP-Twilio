<?php

include_once("inc/modes/OutputBuilder.class.php");

class RejectCallOutputBuilder extends OutputBuilder {

    public function canHandle($groupMode) {
        return $groupMode == REJECT_MODE;
    }

    public function buildOutput($group, $from, $digits = null) {
        return $this->responseWriter->outputRejectCallResponse();
    }
}