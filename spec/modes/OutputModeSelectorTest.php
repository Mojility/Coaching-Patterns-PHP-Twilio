<?php

require_once("inc/modes/OutputModeSelector.class.php");

class OutputModeSelectorTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        $this->selector = new OutputModeSelector();
    }

    function testCanGetRejectCallOutputBuilder() {
        $outputBuilder = $this->selector->builderFor(REJECT_MODE);
        $this->assertInstanceOf(RejectCallOutputBuilder, $outputBuilder);
    }

    function testCanGetForwardCallOutputBuilder() {
        $outputBuilder = $this->selector->builderFor(FORWARD_MODE);
        $this->assertInstanceOf(ForwardCallOutputBuilder, $outputBuilder);
    }

}
