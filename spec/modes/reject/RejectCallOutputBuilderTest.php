<?php

require_once("inc/modes/reject/RejectCallOutputBuilder.class.php");

class RejectCallOutputBuilderTest extends PHPUnit_Framework_TestCase {

    private $builder;

    function __construct() {
        $this->builder = new RejectCallOutputBuilder();
    }

    function testRespondsOnlyToCorrectMode() {
        $this->assertTrue($this->builder->canHandle(REJECT_MODE));
        $this->assertFalse($this->builder->canHandle(FORWARD_MODE));
    }

    function testReturnsExpectedResults() {
        $output = $this->builder->buildOutput(new Group(REJECT_MODE), ADMIN_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Reject", $output);
    }

}
