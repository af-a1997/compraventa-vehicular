<?php
    // Since I noticed I keep reusing the same "click here to..." string in various parts of the panel, thought I'd have fun coding a neat little something to ease dealing with that and change the message if needed be. This function is made for use ONLY in form submittal actions.

    /*
     * Parameters:
     * 
     * $action_param = 0 or 1 (0 to show a return to list string or 1 to show a retry string)
     * $up_dir_count = how many times in the server hierarchy to go up, if you use "-1", use same directory as file where the function is called, i.e.: "./".
     * $file_pointer = just a path to the PHP file if needed be, this is in some cases required and in others best omitted.
     * 
     * Usage example:
     * 
     * _____
     * $link_act_all = BTL_Gen(0,2);
     * echo "<p>Vehículo &laquo;".$old_veh_details."&raquo; eliminado".$link_act_all."</p>";
     * _____
     * 
     * This'll show the full message and a link in part of that message that directs you two directories up when clicked, for example to a route like [/admin/pages/manage/vehicles/].
     * 
     * Finally, in case you're wondering, "BTL" is not "battle", it's an acronym I made up, for "Back To List". :)
     * "Gen" is just short for "generate".
     */
    function BTL_Gen($action_param = 0, $up_dir_count = 0, $file_pointer = "", $section_param = ""){
        $up_dir_str = "";
        $act_str = "";

        if($up_dir_count > 0){
            for($x = 0 ; $x < $up_dir_count ; $x++){
                $up_dir_str .= "../";
            }
        }
        else if($up_dir_count == -1)
            $up_dir_str = "./";

        if($action_param == 0)
            $act_str = "volver a la lista";
        else if($action_param == 1)
            $act_str = "volver a intentarlo";
        else if($action_param == 2)
            $act_str = "ir a la lista de ".$section_param;

        if($up_dir_count == 0 && $file_pointer == "")
            return ".";
        
        else
            return ", <a href=\"".$up_dir_str.$file_pointer."\">pincha aquí para ".$act_str."</a>.";
    }
?>