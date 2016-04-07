<?php

namespace Modes\Forward;

class ForwardContextRecognizer {

    private $builders;

    public function __construct() {
        $this->builders = [
            new OutputBuilders\ForwardToAdministratorsOutputBuilder(),
            new OutputBuilders\GatherDigitsOutputBuilder(),
            new OutputBuilders\InvalidDigitsOutputBuilder(),
            new OutputBuilders\DialOutgoingCallOutputBuilder()
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
            throw new \Modes\NoBuilderFoundException();
    }

}
