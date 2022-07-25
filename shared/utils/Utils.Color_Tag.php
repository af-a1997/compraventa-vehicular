<?php
    // This function is used within information display containers to show a color tag with the exact color in HEX format in an user-friendly way, while looking nice. The CSS rules are defined in the [html_head_setup.php] file in [/admin/shared/].
    
    function GEN_ColorTag($obj_param){
		$r_ct = "";

        if($obj_param == null) $r_ct = "No especificado.";
        else $r_ct = "<span class=colored_circle style=\"background-color: $obj_param;\"></span> $obj_param";

        return $r_ct;
    }
?>