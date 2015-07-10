<?php

require_once("inc/modes/forward/ForwardCallOutputBuilder.class.php");
require_once("inc/modes/reject/RejectCallOutputBuilder.class.php");

class NoBuilderFoundException extends Exception {}

class OutputModeSelector {

    private $builders;

    public function __construct() {
        $this->builders = [
            new ForwardCallOutputBuilder(),
            new RejectCallOutputBuilder()
        ];
    }

    public function builderFor($groupMode) {
        $candidates = array_filter(
            $this->builders,
            function($b) use($groupMode) { return $b->canHandle($groupMode); }
        );

        if (count($candidates)>0)
            return array_shift($candidates);
        else
            throw new NoBuilderFoundException();
    }

}