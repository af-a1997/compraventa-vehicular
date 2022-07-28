<?php
    // TODO: implement handling optional fields, this will be done later. Low priority for now.
    function POST_Chk($field_namespace,$obj_param){
        if(isset($_POST[$field_namespace]))
            $obj_param = $_POST[$field_namespace];

        else
            $obj_param = null;
    }
?>