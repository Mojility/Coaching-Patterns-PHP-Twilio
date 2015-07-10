<?php

require_once("spec/modes/forward/output_builders/OutputBuilderTestBase.php");

require_once("inc/Group.class.php");
require_once("inc/modes/forward/output_builders/InvalidDigitsOutputBuilder.class.php");

class InvalidDigitsOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new InvalidDigitsOutputBuilder();
    }

    function testWontHandleFromNonAdministrators() {
        $this->assertFalse($this->checkCanHandle(MEMBER_PHONE, null));
    }

    function testWontHandleWithValidDigits() {
        $this->assertFalse($this->checkCanHandle(ADMIN_PHONE, "1234567890"));
    }

    function testReturnsExpectedResults() {
        $output = $this->getHandleOutput(MEMBER_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Redirect", $output);
    }

}
