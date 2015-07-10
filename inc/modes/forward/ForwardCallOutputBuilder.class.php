<?php

include_once("inc/modes/forward/ForwardContextRecognizer.class.php");

class ForwardCallOutputBuilder {

    public function canHandle($groupMode) {
        return $groupMode == FORWARD_MODE;
    }

    public function buildOutput($group, $from, $digits = null) {
        $recognizer = new ForwardContextRecognizer();
        $builder = $recognizer->getOutputBuilderFor($group, $from, $digits);
        return $builder->handle($group, $from, $digits);
    }

}