<?php

namespace Modes\Forward\OutputBuilders;

use Modes\OutputBuilder;

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
