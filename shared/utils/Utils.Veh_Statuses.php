<?php
	$e = array("Abortado", "En uso", "En reparaciones", "Extraviado", "Disponible");
	$em = sizeof($e); // Not used here but is used in some pages where this snippet is included, to make it easy to add/remove statuses just from this file.
	$x = 0;

	function UVS_BuildBadge($st){
		global $e; // Global keyword allows getting value of a variable outside the context of the function, in this case I want to get the array from above without re-writing it twice, the idea is that the user may worry with changing this once.

		$ec = "bg-gradient-";
		$test = null;

		if(($st == 0) or ($st == 3))
			$ec .= "danger";
		else if(($st == 1) or ($st == 4))
			$ec .= "success";
		else if($st == 2)
			$ec .= "warning";
	
		return "<span class=\"badge badge-sm ".$ec."\">$e[$st]</span>";
	}
?>