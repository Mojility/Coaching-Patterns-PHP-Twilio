<?php
require_once("inc/Group.class.php");
require_once("inc/modes/OutputModeSelector.class.php");

define("SCRIPT_URL", "http://myserver.com/phones/index.php");

//$from = $_POST['From'];
//$from = ADMIN_PHONE;
//$from = "+17055551212";
//$from = $argv[1];

//$digits = $_POST['Digits'];
//$digits = "6135551212";
//$digits = "48424";
//$digits = $argv[2];

$group = new Group(FORWARD_MODE);

$selector = new OutputModeSelector();
$outputBuilder = $selector->builderFor($group->getMode());
$output = $outputBuilder->buildOutput($group, $from, $digits);

echo $output;