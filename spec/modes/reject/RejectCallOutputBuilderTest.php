<?php

use Modes\Reject\RejectCallOutputBuilder;

class RejectCallOutputBuilderTest extends PHPUnit_Framework_TestCase {

    private $builder;

    function __construct() {
        $this->builder = new RejectCallOutputBuilder();
    }

    function testRespondsOnlyToCorrectMode() {
        $this->assertTrue($this->builder->canHandle(Group::REJECT_MODE));
        $this->assertFalse($this->builder->canHandle(Group::FORWARD_MODE));
    }

    function testReturnsExpectedResults() {
        $output = $this->builder->buildOutput(new Group(Group::REJECT_MODE), Group::ADMIN_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Reject", $output);
    }

}
