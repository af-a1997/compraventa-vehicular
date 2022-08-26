<?php
    // Taxicab contract statuses: active, finished.
    $e = array("Activo", "Finalizado");

    // First parameter is contract end date and time, the second is the current time of the server. With this, we generate a badge based on whether or not the contract has ended, only two scenarios are covered, because if the field is null, it means the contract is active, otherwise if it has a timestamp and is older than the current date, it means the contract expired/ended.
	function UTC_GenStBadge($timestamp_contract_end,$timestamp_today){
		global $e;

        $st = 0;
		$ec = "bg-gradient-";

        if($timestamp_contract_end == null){
            $ec .= "success";
            $st = 0;
        }
        else if($timestamp_contract_end < $timestamp_today){
            $ec .= "danger";
            $st = 1;
        }
	
		return "<span class=\"badge badge-sm ".$ec."\">$e[$st]</span>";
	}
?>