<?php

require_once("inc/Group.class.php");
require_once("inc/modes/OutputModeSelector.class.php");

class IntegrationTest extends PHPUnit_Framework_TestCase {

    private $selector;

    function setUp() {
        $this->selector = new OutputModeSelector();
    }

    function testGeneratesRejectOutputForRejectMode() {
        $output = $this->getOutputFor(new Group(REJECT_MODE), MEMBER_PHONE, null);
        $this->assertContains("Reject", $output);
    }

    function testGeneratesForwardToAdministrators() {
        $output = $this->getOutputFor(new Group(FORWARD_MODE), MEMBER_PHONE, null);
        $this->assertContains("Dial", $output);
        $this->assertContains(ADMIN_PHONE, $output);
        $this->assertContains(ADMIN2_PHONE, $output);
    }

    function testGeneratesRequestDigitsForBridging() {
        $output = $this->getOutputFor(new Group(FORWARD_MODE), ADMIN_PHONE, null);
        $this->assertContains("Gather", $output);
    }

    function testGeneratesInvalidResponseForBadBridgeNumber() {
        $output = $this->getOutputFor(new Group(FORWARD_MODE), ADMIN_PHONE, "123");
        $this->assertContains("Redirect", $output);
    }

    function testGeneratesCallForValidBridgeNumber() {
        $output = $this->getOutputFor(new Group(FORWARD_MODE), ADMIN_PHONE, "1234567890");
        $this->assertContains("Dial", $output);
        $this->assertContains("1234567890", $output);
    }

    private function getOutputFor($group, $from, $digits) {
        $outputBuilder = $this->selector->builderFor($group->getMode());
        $output = $outputBuilder->buildOutput($group, $from, $digits);
        return $output;
    }

}
