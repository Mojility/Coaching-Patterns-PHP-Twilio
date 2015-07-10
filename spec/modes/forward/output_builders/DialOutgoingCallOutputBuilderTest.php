<?php

require_once("spec/modes/forward/output_builders/OutputBuilderTestBase.php");

require_once("inc/Group.class.php");
require_once("inc/modes/forward/output_builders/DialOutgoingCallOutputBuilder.class.php");

class DialOutgoingCallOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new DialOutgoingCallOutputBuilder();
    }

    function testWontHandleFromNonAdministrators() {
        $this->assertFalse($this->checkCanHandle(MEMBER_PHONE, null));
    }

    function testWontHandleWithoutDigits() {
        $this->assertFalse($this->checkCanHandle(ADMIN_PHONE, null));
    }

    function testWontHandleInvalidDigits() {
        $this->assertFalse($this->checkCanHandle(ADMIN_PHONE, "123"));
    }

    function testWillHandleCorrectContext() {
        $this->assertTrue($this->checkCanHandle(ADMIN_PHONE, "1234567890"));
    }

    function testReturnsExpectedResults() {
        $output = $this->getHandleOutput(ADMIN_PHONE, MEMBER_PHONE);
        $this->assertContains("Response", $output);
        $this->assertContains("Dial", $output);
        $this->assertContains(MEMBER_PHONE, $output);
    }

}
