<?php
    session_start();

    // Not all pages will need client session check, in such cases, run this function after including this file.
    function isForLoggedInUser($session_req = true){
        if((!isset($_SESSION['client_session']) || !isset($_SESSION['client_id'])) && $session_req == true)
            header("Location:/login/client");

        else if($session_req == false && isset($_SESSION['client_session']))
            header("Location:/");
    }
?>