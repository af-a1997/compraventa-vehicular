<?php
    include $_SERVER["DOCUMENT_ROOT"]."/client/classes/Utils.CliClassLoader.class.php";

    $o_csl = new C_Sellable();

    $param_le = $_GET["req_le"];
    $param_he = $_GET["req_he"];
    $param_currid = $_GET["req_currid"];

    $o_csl_list = $o_csl->CSL_GetVehByCostRng($param_le,$param_he,$param_currid);

    // TODO: might be able to learn and use Ajax to include filters without reloading the pages, I only understand a little the basics for now, so I'm not sure yet I'm doing right preparing this query file in advance.
?>