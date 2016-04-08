<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

class GatherDigitsOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return
            $group->isAdministrator($from)
            && !$digits;
    }

    public function buildOutput($group, $from, $digits = null) {
        return $this->responseWriter->outputGatherDigitsResponse();
    }

}
