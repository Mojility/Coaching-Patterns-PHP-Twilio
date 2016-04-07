<?php

namespace Modes\Forward\OutputBuilders;

use Group;
use Modes\Forward\OutputBuilders\DialOutgoingCallOutputBuilder;

class DialOutgoingCallOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new DialOutgoingCallOutputBuilder();
    }

    function testWontHandleFromNonAdministrators() {
        $this->assertFalse($this->checkCanHandle(Group::MEMBER_PHONE, null));
    }

    function testWontHandleWithoutDigits() {
        $this->assertFalse($this->checkCanHandle(Group::ADMIN_PHONE, null));
    }

    function testWontHandleInvalidDigits() {
        $this->assertFalse($this->checkCanHandle(Group::ADMIN_PHONE, "123"));
    }

    function testWillHandleCorrectContext() {
        $this->assertTrue($this->checkCanHandle(Group::ADMIN_PHONE, "1234567890"));
    }

    function testReturnsExpectedResults() {
        $output = $this->getHandleOutput(Group::ADMIN_PHONE, Group::MEMBER_PHONE);
        $this->assertContains("Response", $output);
        $this->assertContains("Dial", $output);
        $this->assertContains(Group::MEMBER_PHONE, $output);
    }

}
