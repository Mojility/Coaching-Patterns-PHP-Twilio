<?php

namespace Modes\Reject;

use Group;
use Modes\OutputBuilder;

class RejectCallOutputBuilder extends OutputBuilder {

    public function canHandle($groupMode) {
        return $groupMode == Group::REJECT_MODE;
    }

    public function buildOutput($group, $from, $digits = null) {
        return $this->responseWriter->outputRejectCallResponse();
    }
}
