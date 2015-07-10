<?php

require_once("inc/twilio/ResponseWriter.class.php");

abstract class OutputBuilder {

    protected $responseWriter;

    public function __construct() {
        $this->responseWriter = new ResponseWriter();
    }

}