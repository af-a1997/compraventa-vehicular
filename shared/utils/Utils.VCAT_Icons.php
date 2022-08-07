<?php
    /*
     * Multidimensional array used to create icon picker dropdown with SelectBoxIt: < http://gregfranko.com/jquery.selectBoxIt.js/index.html >
     * 
     * See an example of use by checking the file: [/admin/pages/manage/other/do/vcat/Edit.php]
     * 
     * Format for accessing array: $icon_set[icon_id][value]
     * 
     * [value] can be:
     * -> 0 = Font Awesome icon class, used for storing value in DDBB. ONLY use fa-* class, NOT the style class such as [fas].
     * -> 1 = Pointer to SVG file.
     * -> 2 = Display name in dropdown element.
     * 
     * */

	// Put SVGs of Font Awesome icons here:
    const vcat_icons_loc = "/shared/extras/font-awesome/svg/";

	// Add/remove usable icons (will show up in icon selector dropdown, only in vehicle category add/edit):
	$icon_set = array(
		array("fa-horse", vcat_icons_loc."horse-solid.svg", "Animal"),
		array("fa-car", vcat_icons_loc."car-solid.svg", "Automóvil"),
		array("fa-plane-up", vcat_icons_loc."plane-up-solid.svg", "Avión"),
		array("fa-ship", vcat_icons_loc."ship-solid.svg", "Barco"),
		array("fa-bicycle", vcat_icons_loc."bicycle-solid.svg", "Bicicleta"),
		array("fa-bus", vcat_icons_loc."bus-solid.svg", "Bus (1)"),
		array("fa-bus-simple", vcat_icons_loc."bus-simple-solid.svg", "Bus (2)"),
		array("fa-truck", vcat_icons_loc."truck-solid.svg", "Camión"),
		array("fa-helicopter", vcat_icons_loc."helicopter-solid.svg", "Helicóptero"),
		array("fa-truck-pickup", vcat_icons_loc."truck-pickup-solid.svg", "Pick-up"),
		array("fa-tractor", vcat_icons_loc."tractor-solid.svg", "Tractor"),
		array("fa-train", vcat_icons_loc."train-solid.svg", "Tren"),
		array("fa-van-shuttle", vcat_icons_loc."van-shuttle-solid.svg", "Van / Furgón")
	);
?>