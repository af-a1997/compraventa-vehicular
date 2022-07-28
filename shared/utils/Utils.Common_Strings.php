<?php
	// General use strings (both client and admin side).
	const g_home = "Inicio";
	const g_login = "Iniciar sesión";
	const g_logout = "Cerrar sesión";
	
	// Small, constant code snippets for general use.
	const g_snp_reqf = "<span style=\"color: red; font-weight: bold;\">*</span>";
	const g_snp_cal = "\"background: url(/shared/img/icons/Calendar-icon.svg) 99% center/24px 24px no-repeat; cursor: pointer;\""; // This adds a calendar icon to all input fields that use jQuery date and time picker, since I won't use this function and property on anything else. Icon from: https://openclipart.org/detail/213247/calendar-icon (edited to have white color due to the dark theme). Echo this on an input with style property.
?>