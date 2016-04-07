<?php

namespace Modes\Forward\OutputBuilders;

use Group;
use Modes\Forward\OutputBuilders\ForwardToAdministratorsOutputBuilder;

class ForwardToAdministratorsOutputBuilderTest extends OutputBuilderTestBase {

    function __construct() {
        parent::__construct();
        $this->builder = new ForwardToAdministratorsOutputBuilder();
    }

    function testWillHandleForNonAdministrators() {
        $this->assertTrue($this->checkCanHandle(Group::MEMBER_PHONE, null));
    }

    function testWontHandleForAdministrators() {
        $this->assertFalse($this->checkCanHandle(Group::ADMIN_PHONE, null));
    }

    function testReturnsExpectedResults() {
        $output = $this->builder->handle($this->group, Group::MEMBER_PHONE, null);
        $this->assertContains("Response", $output);
        $this->assertContains("Dial", $output);
        $this->assertContains(Group::ADMIN_PHONE, $output);
        $this->assertContains(Group::ADMIN2_PHONE, $output);
    }

}
