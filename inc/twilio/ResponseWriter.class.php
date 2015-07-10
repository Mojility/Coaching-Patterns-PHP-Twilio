<?php

class ResponseWriter {

    private $response;

    public function __construct() {
        $this->response = new SimpleXMLElement("<Response/>");
    }

    function outputGatherDigitsResponse() {
        $child = $this->addChildWithAttributes("Gather", array("action" => SCRIPT_URL, "timeout" => 2));
        $child->addChild("Say", "Enter outgoing number.");

        $this->addChildWithAttributeTo($child, "Pause", "length", 8);

        $this->response->addChild("Say", "Sorry, I didn't get your input.");
        $this->response->addChild("Redirect", SCRIPT_URL);

        return $this->response->asXML();
    }

    function outputInvalidDigitsResponse() {
        $this->response->addChild("Say", "You must provide a valid 10-digit phone number to dial");
        $this->response->addChild("Redirect", SCRIPT_URL);
        return $this->response->asXML();
    }

    function outputOutgoingCallResponse($group, $Digits) {
        $attributes = array("timeout" => 30, "callerId" => $group->getPhone());
        $this->addChildWithAttributes("Dial", $attributes, $Digits);
        return $this->response->asXML();
    }

    function outputForwardCallResponse($group) {
        $dialElement = $this->response->addChild("Dial");
        foreach ($group->getAdministrators() as $phone)
            $dialElement->addChild("Number", $phone);
        $this->response->addChild("Say", "Sorry, nobody could be reached at this time. Please try again later.");
        return $this->response->asXML();
    }

    function outputRejectCallResponse() {
        $this->addChildWithAttribute('Reject', "reason", "busy");
        return $this->response->asXML();
    }



    private function addChildWithAttribute($elementName, $key, $value) {
        $child = $this->addChildWithAttributeTo($this->response, $elementName, $key, $value);
        return $child;
    }

    private function addChildWithAttributes($elementName, $attributes, $text = null) {
        $child = $this->response->addChild($elementName, $text);
        foreach ($attributes as $key => $value) {
            $child->addAttribute($key, $value);
        }
        return $child;
    }

    private function addChildWithAttributeTo($parent, $elementName, $key, $value) {
        $child = $parent->addChild($elementName);
        $child->addAttribute($key, $value);
        return $child;
    }
}

