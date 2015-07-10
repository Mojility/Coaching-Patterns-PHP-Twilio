<?php

require_once("inc/modes/forward/ForwardContextRecognizer.class.php");

class ForwardContextRecognizerTest extends PHPUnit_Framework_TestCase {

    private $selector;
    private $group;

    function setUp() {
        $this->selector = new ForwardContextRecognizer();
        $this->group = new Group(FORWARD_MODE);
    }

    function testCanGetForwardToAdministrators() {
        $outputBuilder = $this->getOutputBuilder("+19051234567", null);
        $this->assertInstanceOf(ForwardToAdministratorsOutputBuilder, $outputBuilder);
    }

    function testCanGetGatherDigits() {
        $outputBuilder = $this->getOutputBuilder(ADMIN_PHONE, null);
        $this->assertInstanceOf(GatherDigitsOutputBuilder, $outputBuilder);
    }

    function testCanGetInvalidDigits() {
        $outputBuilder = $this->getOutputBuilder(ADMIN_PHONE, "111");
        $this->assertInstanceOf(InvalidDigitsOutputBuilder, $outputBuilder);
    }

    function testCanGetDialOutgoingCall() {
        $outputBuilder = $this->getOutputBuilder(ADMIN_PHONE, "9055551212");
        $this->assertInstanceOf(DialOutgoingCallOutputBuilder, $outputBuilder);
    }

    private function getOutputBuilder($from, $digits) {
        return $this->selector->getOutputBuilderFor($this->group, $from, $digits);
    }

}
