<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

class DialOutgoingCallOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return
            $group->isAdministrator($from)
            && (10 == strlen($digits));
    }

    public function buildOutput($group, $from, $digits = null) {
        return $this->responseWriter->outputOutgoingCallResponse($group, $digits);
    }

}
