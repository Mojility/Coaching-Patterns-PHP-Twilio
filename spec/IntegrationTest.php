<?php

use Twilio\ResponseWriter;

class IntegrationTest extends PHPUnit_Framework_TestCase {

    private $dispatcher;

    function setUp() {
        $this->dispatcher = new Dispatcher(new ResponseWriter());
    }

    function testGeneratesRejectOutputForRejectMode() {
        $output = $this->getOutputFor(new Group(Group::REJECT_MODE), Group::MEMBER_PHONE, null);
        $this->assertContains("Reject", $output);
    }

    function testGeneratesForwardToAdministrators() {
        $output = $this->getOutputFor(new Group(Group::FORWARD_MODE), Group::MEMBER_PHONE, null);
        $this->assertContains("Dial", $output);
        $this->assertContains(Group::ADMIN_PHONE, $output);
        $this->assertContains(Group::ADMIN2_PHONE, $output);
    }

    function testGeneratesRequestDigitsForBridging() {
        $output = $this->getOutputFor(new Group(Group::FORWARD_MODE), Group::ADMIN_PHONE, null);
        $this->assertContains("Gather", $output);
    }

    function testGeneratesInvalidResponseForBadBridgeNumber() {
        $output = $this->getOutputFor(new Group(Group::FORWARD_MODE), Group::ADMIN_PHONE, "123");
        $this->assertContains("Redirect", $output);
    }

    function testGeneratesCallForValidBridgeNumber() {
        $output = $this->getOutputFor(new Group(Group::FORWARD_MODE), Group::ADMIN_PHONE, "1234567890");
        $this->assertContains("Dial", $output);
        $this->assertContains("1234567890", $output);
    }

    private function getOutputFor($group, $from, $digits) {
        $output = $this->dispatcher->invoke($group, $from, $digits);
        return $output;
    }

}
