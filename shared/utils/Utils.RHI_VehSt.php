<?php
	/*
	 * This file contains definitions on vehicle rental status, just to check on the status of the vehicle while rented, and a function that generates a colored badge to illustrate the status in a user-friendly way (that receives the status bit as parameter).
	 * 
	 * Monitoring status is not required while the vehicle is at one of the company's buildings (i.e.: vehicle is not rented), but that can be changed if needed be.
	 * 
	 * It's compatible with both templates used on the system, because they're both made on Bootstrap, plus this file doesn't contain admin-exclusive info, so it's placed on the shared folder for all user roles.
	 * 
	 * Please note that the column with the status bit is a TINYINT, so there's a hard limit on how many statuses can you create, but 6 will certainly be enough.
	 * ALSO, THIS IS IMPORTANT, but ensure the "RHI" entries deletion will work as intended after adding more statuses (or removing some) then adjust code accordingly. For now code was made assuming it's left as-is.
	 * 
	 * Statuses from array: temprary suspension, in use, under repairs, lost, available, archived entry (non-manageable).
	 */
	$e = array("Susp. temp.", "En uso", "En reparaciones", "Extraviado", "Disponible", "Ent. arch.");
	$em = sizeof($e); // Not used here but is used in some pages where this snippet is included, to make it easy to add/remove statuses just from this file.
	$x = 0;

	function URV_GenStBadge($st){
		global $e; // Global keyword allows getting value of a variable outside the context of the function, in this case I want to get the array from above without re-writing it twice, the idea is that the webmaster may worry with changing this once.

		$ec = "bg-gradient-";

		if(($st == 0) or ($st == 3))
			$ec .= "danger";
		else if(($st == 1) or ($st == 4))
			$ec .= "success";
		else if($st == 2)
			$ec .= "warning";
		else if($st == 6)
			$ec .= "secondary";
	
		return "<span class=\"badge badge-sm ".$ec."\">$e[$st]</span>";
	}
?>