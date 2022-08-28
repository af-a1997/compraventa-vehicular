<?php
    session_start();

    // Not all pages will need client session check, in such cases, run this function after including this file.
    function isForLoggedInUser(){
        if(!isset($_SESSION['client_session']) || !isset($_SESSION['client_id'])){
            header("Location:/login/client");
        }
    }
?>