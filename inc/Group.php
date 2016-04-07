<?php

class Group {

    const FORWARD_MODE = "forward";
    const REJECT_MODE = "reject_busy";
    const ADMIN_PHONE = "+19055551212";
    const ADMIN2_PHONE = "+14165551212";
    const MEMBER_PHONE = "+17055551212";

    protected $mode = null;

    public function __construct($mode = Group::REJECT_MODE) {
        $this->mode = $mode;
    }

    public function getName() { return "Test Group"; }
    public function getMode() { return $this->mode; }
    public function getPhone() { return "+14085551212"; }

    public function isAdministrator($phone) {
        return in_array($phone, $this->getAdministrators());
    }

    public function getAdministrators() {
        return array(Group::ADMIN_PHONE, Group::ADMIN2_PHONE);
    }

}
