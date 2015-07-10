<?php

require_once("inc/twilio/ResponseWriter.class.php");

class ResponseWriterTest extends PHPUnit_Framework_TestCase {

    protected $responseWriter = null;

    function setUp() {
        $this->responseWriter = new ResponseWriter();
    }

    function testResponseWriterExists() {
        $this->assertNotNull($this->responseWriter);
    }

}
