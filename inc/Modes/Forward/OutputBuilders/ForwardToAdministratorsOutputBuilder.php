<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

class ForwardToAdministratorsOutputBuilder extends OutputBuilder {

    public function canHandle($group, $from, $digits) {
        return !$group->isAdministrator($from);
    }

    public function handle($group, $from, $digits) {
        return $this->responseWriter->outputForwardCallResponse($group);
    }

}
