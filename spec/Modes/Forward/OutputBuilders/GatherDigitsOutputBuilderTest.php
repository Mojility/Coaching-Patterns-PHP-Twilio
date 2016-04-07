<?php

namespace Modes\Forward\OutputBuilders;

use Group;
use Modes\Forward\OutputBuilders\GatherDigitsOutputBuilder;

class GatherDigitsOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new GatherDigitsOutputBuilder();
    }

    function testWontHandleFromNonAdministrators() {
        $this->assertFalse($this->checkCanHandle(Group::MEMBER_PHONE, null));
    }

    function testWontHandleForDigitsPresent() {
        $this->assertFalse($this->checkCanHandle(Group::MEMBER_PHONE, "123"));
    }

    function testReturnsExpectedResults() {
        $output = $this->getHandleOutput(Group::MEMBER_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Gather", $output);
    }

}
