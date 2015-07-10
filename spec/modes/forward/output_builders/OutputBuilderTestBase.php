<?php

class OutputBuilderTestBase extends PHPUnit_Framework_TestCase {
    protected $builder;
    protected $group;

    public function __construct() {
        $this->group = new Group(FORWARD_MODE);
    }

    function checkCanHandle($from, $digits) {
        return $this->builder->canHandle($this->group, $from, $digits);
    }

    function getHandleOutput($from, $digits) {
        return $this->builder->handle($this->group, $from, $digits);
    }
}
