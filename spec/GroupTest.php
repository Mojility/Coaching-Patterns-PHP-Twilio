<?php

class GroupTest extends PHPUnit_Framework_TestCase {

    protected $group = null;

    function setUp() {
        $this->group = new Group();
    }

    function testGroupHasAdministrator() {
        $this->assertTrue($this->group->isAdministrator(Group::ADMIN_PHONE));
    }

}
