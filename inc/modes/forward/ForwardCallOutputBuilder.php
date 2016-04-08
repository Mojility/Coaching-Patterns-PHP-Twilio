<?php

namespace Modes\Forward;

use Group;

class ForwardCallOutputBuilder {

    public function canHandle($groupMode) {
        return $groupMode == Group::FORWARD_MODE;
    }

    public function buildOutput($group, $from, $digits = null) {
        $recognizer = new ForwardContextRecognizer();
        $builder = $recognizer->getOutputBuilderFor($group, $from, $digits);
        return $builder->buildOutput($group, $from, $digits);
    }

}
