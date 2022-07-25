<?php
    // Assists with sending empty fields to the database.
    function POST_Chk($field_namespace,$obj_param){
        if(strlen($_POST[$field_namespace]) == 0)
            $obj_param = null;

        else
            $obj_param = $_POST[$field_namespace];
    }
    // TODO: finish implementing optional field handling in all classes, since it also needs to be done there.

    // Radio buttons need to be handled a little differently, so this function is for them.
    function POST_Chk_RB($field_namespace,$obj_param){
        if(isset($_POST[$field_namespace]))
            $obj_param = $_POST[$field_namespace];
        
        else
            $obj_param = "";
        
    }
?>