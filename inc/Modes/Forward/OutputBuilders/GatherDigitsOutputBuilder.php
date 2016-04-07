<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

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
