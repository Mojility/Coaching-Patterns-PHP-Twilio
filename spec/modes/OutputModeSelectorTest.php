<?php

use Modes\OutputModeSelector;

class OutputModeSelectorTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        $this->selector = new OutputModeSelector();
    }

    function testCanGetRejectCallOutputBuilder() {
        $outputBuilder = $this->selector->builderFor(Group::REJECT_MODE);
        $this->assertInstanceOf('\Modes\Reject\RejectCallOutputBuilder', $outputBuilder);
    }

    function testCanGetForwardCallOutputBuilder() {
        $outputBuilder = $this->selector->builderFor(Group::FORWARD_MODE);
        $this->assertInstanceOf('\Modes\Forward\ForwardCallOutputBuilder', $outputBuilder);
    }

}
