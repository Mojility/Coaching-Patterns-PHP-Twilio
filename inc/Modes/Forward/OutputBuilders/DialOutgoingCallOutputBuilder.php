<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

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
