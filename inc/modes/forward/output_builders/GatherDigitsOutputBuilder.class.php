<?php

include_once("inc/modes/OutputBuilder.class.php");

class GatherDigitsOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return
            $group->isAdministrator($from)
            && !$digits;
    }

    public function handle($group, $from, $digits) {
        return $this->responseWriter->outputGatherDigitsResponse();
    }

}