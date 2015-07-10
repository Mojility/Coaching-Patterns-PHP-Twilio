<?php

include_once("inc/modes/OutputBuilder.class.php");

class InvalidDigitsOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return
            $group->isAdministrator($from)
            && $digits
            && (10 != strlen($digits));
    }

    public function handle($group, $from, $digits) {
        return $this->responseWriter->outputInvalidDigitsResponse();
    }

}