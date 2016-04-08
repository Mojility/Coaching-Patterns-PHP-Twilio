<?php

namespace Modes;

use \Modes\Forward\ForwardCallOutputBuilder;
use \Modes\NoBuilderFoundException;
use \Modes\Reject\RejectCallOutputBuilder;

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
