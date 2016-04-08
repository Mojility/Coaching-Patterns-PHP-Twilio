<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

class ForwardToAdministratorsOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return !$group->isAdministrator($from);
    }

    public function buildOutput($group, $from, $digits = null) {
        return $this->responseWriter->outputForwardCallResponse($group);
    }

}
