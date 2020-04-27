<?php    $array = array("object" => "", "mail-client" => "", "mail" => "", "message" => "", "objectError" => "", "mail-clientError" => "", "mailError" => "", "messageError" => "", "isSuccess" => false);

    $emailTo = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $array["object"] = verifyInput($_POST["object"]);
        $array["mail-client"] = verifyInput($_POST["mail-client"]);
        $array["mail"] = verifyInput($_POST["mail"]);
        $array["message"] = verifyInput($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText = "";

        if(empty($array["object"])){

            $array["objectError"] = "Veuillez reseigner l'objet de votre message.";
            $isSucess = false;
        }

        else{
            $emailText .= "Objet: {$array["object"]}\n";
        }

        if(!isEmail($array["mail-client"])){

            $array["mail-clientError"] = "Veuillez renseigner votre adresse email.";
            $array["isSuccess"] = false;
        }

        else{

            $emailText .= "Email client: {$array["mail-client"]}\n";
        }

        if($array["mail"] === "--Choisir l'option correspondant à votre demande--"){

            $array["mailError"] = "Selectionnez une des 3 options";
            $array["isSuccess"] = false;
        }

        else{
            if ($_POST["mail"] === "Contact"){
                $emailTo = "contact@tacidlane.com"
            }
        
            if ($_POST["mail"] === "Sounds"){
                $emailTo = "sounds@tacidlane.com"
            }
        
            if ($_POST["mail"] === "Booking"){
                $emailTo = "booking@tacidlane.com"
            }
        }

        if(empty($array["message"])){

            $array["messageError"] = "Veuillez renseigner un message.";
            $array["isSuccess"] = false;
        }
        else{
            $emailText .= "Message: {$array["message"]}\n";
        }

        if($array["isSuccess"]){

            $headers = "From: {$array["object"]} <{$array["mail-client"]}>\r\nReply-To: {$array["mail-client"]}";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
        }

        echo json_encode($array);
    }    

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);        
        return $var;
    }

?>