<?php

require_once("spec/modes/forward/output_builders/OutputBuilderTestBase.php");

require_once("inc/Group.class.php");
require_once("inc/modes/forward/output_builders/GatherDigitsOutputBuilder.class.php");

class GatherDigitsOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new GatherDigitsOutputBuilder();
    }

    function testWontHandleFromNonAdministrators() {
        $this->assertFalse($this->checkCanHandle(MEMBER_PHONE, null));
    }

    function testWontHandleForDigitsPresent() {
        $this->assertFalse($this->checkCanHandle(MEMBER_PHONE, "123"));
    }

    function testReturnsExpectedResults() {
        $output = $this->getHandleOutput(MEMBER_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Gather", $output);
    }

}
