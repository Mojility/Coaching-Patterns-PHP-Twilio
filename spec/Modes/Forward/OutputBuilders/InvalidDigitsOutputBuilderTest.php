<?php

namespace Modes\Forward\OutputBuilders;

use Group;
use Modes\Forward\OutputBuilders\InvalidDigitsOutputBuilder;

class InvalidDigitsOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new InvalidDigitsOutputBuilder();
    }

    function testWontHandleFromNonAdministrators() {
        $this->assertFalse($this->checkCanHandle(Group::MEMBER_PHONE, null));
    }

    function testWontHandleWithValidDigits() {
        $this->assertFalse($this->checkCanHandle(Group::ADMIN_PHONE, "1234567890"));
    }

    function testReturnsExpectedResults() {
        $output = $this->getHandleOutput(Group::MEMBER_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Redirect", $output);
    }

}
