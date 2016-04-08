<?php

spl_autoload_register(function($className) {
    $filename = "inc"
        . DIRECTORY_SEPARATOR
        . join(DIRECTORY_SEPARATOR, explode('\\', $className))
        . ".php";
    include($filename);
});

//$From = $_POST['From'];
//$From = ADMIN_PHONE;
$From = "+17055551212";

//$Digits = $_POST['Digits'];
//$Digits = "6135551212";
//$Digits = "48424";
$Digits = null;

$group = new Group();

if (Group::FORWARD_MODE == $group->getMode()) {

    if (!$group->isAdministrator($From)) {

        $response = "<Response>\n";
        $response .= "<Dial>\n";
        foreach($group->getAdministrators() as $phone) {
            $response .= "<Number>$phone</Number>\n";
        }
        $response .= "</Dial>\n";
        $response .= "<Say>Sorry, nobody could be reached at this time. Please try again later.</Say>\n";
        $response .= "</Response>\n";
        echo $response;

    } else {

        if ($Digits) {

            if (10 == strlen($Digits)) {

                $response = "<Response>\n";
                $response .= "<Dial";
                $response .= ' timeout="30"';
                $response .= ' callerId="' . $group->getPhone() . '"';
                $response .= ">$Digits</Dial>\n";
                $response .= "</Response>\n";
                echo $response;

            } else {

                $response = "<Response>\n";
                $response .= "<Say>You must provide a valid 10-digit phone number to dial</Say>\n";
                $response .= "<Redirect>" . Settings::SCRIPT_URL . "</Redirect>\n";
                $response .= "</Response>\n";
                echo $response;

            }

        } else {

            $response = "<Response>\n";
            $response .= "<Gather";
            $response .= ' action="' . Settings::SCRIPT_URL . '"';
            $response .= ' timeout="2"';
            $response .= ">\n";
            $response .= "<Say>Enter outgoing number.</Say>\n";
            $response .= "<Pause length=\"8\"/>\n";
            $response .= "</Gather>\n";
            $response .= "<Say>Sorry, I didn't get your input.</Say>\n";
            $response .= "<Redirect>" . Settings::SCRIPT_URL . "</Redirect>\n";
            $response .= "</Response>\n";
            echo $response;

        }

    }

} else {

    $response = new SimpleXMLElement("<Response/>");
    $response->addChild('Reject')->addAttribute("reason", "busy");
    echo $response->asXML();

}
