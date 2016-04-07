<?php

spl_autoload_register(function($className) {
    $filename = "inc"
        . DIRECTORY_SEPARATOR
        . join(DIRECTORY_SEPARATOR, explode('\\', $className))
        . ".php";
    include($filename);
});

//$from = $_POST['From'];
$from = Group::ADMIN_PHONE;
//$from = "+17055551212";
//$from = $argv[1];

//$digits = $_POST['Digits'];
//$digits = "6135551212";
//$digits = "48424";
//$digits = $argv[2];
$digits = null;

$group = new Group(Group::FORWARD_MODE);

$selector = new Modes\OutputModeSelector();
$outputBuilder = $selector->builderFor($group->getMode());
$output = $outputBuilder->buildOutput($group, $from, $digits);

echo $output;
