<?php

include_once("inc/modes/forward/output_builders/ForwardToAdministratorsOutputBuilder.class.php");
include_once("inc/modes/forward/output_builders/GatherDigitsOutputBuilder.class.php");
include_once("inc/modes/forward/output_builders/InvalidDigitsOutputBuilder.class.php");
include_once("inc/modes/forward/output_builders/DialOutgoingCallOutputBuilder.class.php");

class ForwardContextRecognizer {

    private $builders;

    public function __construct() {
        $this->builders = [
            new ForwardToAdministratorsOutputBuilder(),
            new GatherDigitsOutputBuilder(),
            new InvalidDigitsOutputBuilder(),
            new DialOutgoingCallOutputBuilder()
        ];
    }

    public function getOutputBuilderFor($group, $from, $digits) {
        $candidates = array_filter(
            $this->builders,
            function($b) use($group, $from, $digits) { return $b->canHandle($group, $from, $digits); }
        );

        if (count($candidates)>0)
            return array_shift($candidates);
        else
            throw new NoBuilderFoundException();
    }

}