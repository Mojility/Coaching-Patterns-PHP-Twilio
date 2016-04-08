<?php

use Twilio\ResponseWriter;

spl_autoload_register(function($className) {
    $filename = "inc"
        . DIRECTORY_SEPARATOR
        . join(DIRECTORY_SEPARATOR, explode('\\', $className))
        . ".php";
    include($filename);
});

//$from = $_POST['From'];
//$from = Group::ADMIN_PHONE;
$from = "+17055551212";
//$from = $argv[1];

//$digits = $_POST['Digits'];
//$digits = "6135551212";
//$digits = "48424";
//$digits = $argv[2];
$digits = null;

$group = new Group();
$responseWriter = new ResponseWriter();
$dispatcher = new Dispatcher($responseWriter);
echo $dispatcher->invoke($group, $from, $digits);
