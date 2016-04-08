<?php

class Dispatcher {

    protected $responseWriter;
    protected $selector;

    function __construct($responseWriter) {
        $this->responseWriter = $responseWriter;
        $this->selector = new \Modes\OutputModeSelector();
    }

    function invoke($group, $from, $digits) {
        $builder = $this->selector->builderFor($group->getMode());
        return $builder->buildOutput($group, $from, $digits);
    }

}
