<?php
require_once("inc/Group.php");
require_once("inc/ResponseWriter.class.php");

define("SCRIPT_URL", "http://myserver.com/phones/index.php");

//$from = $_POST['From'];
$from = ADMIN_PHONE;
//$from = "+17055551212";

//$digits = $_POST['Digits'];
//$digits = "6135551212";
//$digits = "48424";

$group = new Group();

$responseWriter = new ResponseWriter();

$output = null;

if (FORWARD_MODE == $group->getMode()) {
    if (!$group->isAdministrator($from)) {
        $responseWriter->outputForwardCallResponse($group);
    } else {
        if ($digits) {
            if (10 == strlen($digits)) {
                $responseWriter->outputOutgoingCallResponse($group, $digits);
            } else {
                $responseWriter->outputInvalidDigitsResponse();
            }
        } else {
            $responseWriter->outputGatherDigitsResponse();
        }
    }
} else {
    $responseWriter->outputRejectCallResponse();
}
