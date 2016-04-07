<?php

namespace Modes;

use Twilio\ResponseWriter;

abstract class OutputBuilder {

    protected $responseWriter;

    public function __construct() {
        $this->responseWriter = new ResponseWriter();
    }

}
