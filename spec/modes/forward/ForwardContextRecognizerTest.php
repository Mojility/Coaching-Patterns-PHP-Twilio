<?php

use Modes\Forward\ForwardContextRecognizer;

class ForwardContextRecognizerTest extends PHPUnit_Framework_TestCase {

    private $selector;
    private $group;

    function setUp() {
        $this->selector = new ForwardContextRecognizer();
        $this->group = new Group(Group::FORWARD_MODE);
    }

    function testCanGetForwardToAdministrators() {
        $outputBuilder = $this->getOutputBuilder("+19051234567", null);
        $this->assertInstanceOf('\Modes\Forward\OutputBuilders\ForwardToAdministratorsOutputBuilder', $outputBuilder);
    }

    function testCanGetGatherDigits() {
        $outputBuilder = $this->getOutputBuilder(Group::ADMIN_PHONE, null);
        $this->assertInstanceOf('\Modes\Forward\OutputBuilders\GatherDigitsOutputBuilder', $outputBuilder);
    }

    function testCanGetInvalidDigits() {
        $outputBuilder = $this->getOutputBuilder(Group::ADMIN_PHONE, "111");
        $this->assertInstanceOf('\Modes\Forward\OutputBuilders\InvalidDigitsOutputBuilder', $outputBuilder);
    }

    function testCanGetDialOutgoingCall() {
        $outputBuilder = $this->getOutputBuilder(Group::ADMIN_PHONE, "9055551212");
        $this->assertInstanceOf('\Modes\Forward\OutputBuilders\DialOutgoingCallOutputBuilder', $outputBuilder);
    }

    private function getOutputBuilder($from, $digits) {
        return $this->selector->getOutputBuilderFor($this->group, $from, $digits);
    }

}
