<?php

require_once("spec/modes/forward/output_builders/OutputBuilderTestBase.php");

require_once("inc/Group.class.php");
require_once("inc/modes/forward/output_builders/ForwardToAdministratorsOutputBuilder.class.php");

class ForwardToAdministratorsOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new ForwardToAdministratorsOutputBuilder();
    }

    function testWillHandleForNonAdministrators() {
        $this->assertTrue($this->checkCanHandle(MEMBER_PHONE, null));
    }

    function testWontHandleForAdministrators() {
        $this->assertFalse($this->checkCanHandle(ADMIN_PHONE, null));
    }

    function testReturnsExpectedResults() {
        $output = $this->builder->handle($this->group, MEMBER_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Dial", $output);
        $this->assertContains(ADMIN_PHONE, $output);
        $this->assertContains(ADMIN2_PHONE, $output);
    }

}
