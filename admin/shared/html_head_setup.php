<meta charset=UTF-8 />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<style>
	/* Roboto font by Google */
	
	@font-face{
		font-family: Roboto;
		src: url("/admin/res/fonts/Roboto/Roboto-Regular.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: bold;
		src: url("/admin/res/fonts/Roboto/Roboto-Bold.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-style: italic;
		src: url("/admin/res/fonts/Roboto/Roboto-Italic.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: bold;
		font-style: italic;
		src: url("/admin/res/fonts/Roboto/Roboto-BoldItalic.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 100;
		src: url("/admin/res/fonts/Roboto/Roboto-Thin.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 100;
		font-style: italic;
		src: url("/admin/res/fonts/Roboto/Roboto-ThinItalic.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 300;
		src: url("/admin/res/fonts/Roboto/Roboto-Light.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 300;
		font-style: italic;
		src: url("/admin/res/fonts/Roboto/Roboto-LightItalic.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 500;
		src: url("/admin/res/fonts/Roboto/Roboto-Medium.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 500;
		font-style: italic;
		src: url("/admin/res/fonts/Roboto/Roboto-MediumItalic.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 900;
		src: url("/admin/res/fonts/Roboto/Roboto-Black.ttf");
	}
	@font-face{
		font-family: Roboto;
		font-weight: 900;
		font-style: italic;
		src: url("/admin/res/fonts/Roboto/Roboto-BlackItalic.ttf");
	}
	
	/*
		Material Icons by Google
		
		To download and use, check documentation at: https://developers.google.com/fonts/docs/material_icons	
	*/
	
	@font-face {
		font-family: 'Material Icons Round';
		font-style: normal;
		font-weight: 400;
		src: url("/admin/res/fonts/MaterialIconsRound-Regular.otf");
	}
	
	.card button, .card button:hover, .card button:active {
		margin: 15px;
		color: black;
		width: 250px;
	}
	
	main form {
		margin: 15px;
	}
	
	main form input {
		margin: 10px;
	}
	
	/* For some reason, this works here but not when I insert it on the [index.php] where I need it, so I'll just define here which fields are going to have a triangle down icon, this is only for datepicker fields. */
	#id_veh_faby {
		background: url("/admin/res/img/icons/triangle-upside-down.svg") 99% center/16px 16px no-repeat;
	}
	
	label[id$="-error"]{
		z-index: 10;
		
		background-color: rgba(64,0,0,0.8);
		box-shadow: 0 0 5px rgba(64,0,0,0.8);
		color: white;
		
		padding: 10px;
		border-radius: 5px;
	}
	
	ul.ul_style_elem_details{
		list-style-type: none;
		margin-left: 5px;
		line-height: 1.5;
	}
	ul.ul_style_elem_details li{
		border: 1px solid white;
		border-radius: 15px;
		padding: 15px 5px;
		margin-bottom: 10px;
	}
	
	span.hidden_pwd {
		color: #222;
		background-color: #222;
		border-radius: 15px;
		padding: 2px;
		cursor: help;
	}
	span.hidden_pwd:hover {
		color: white;
	}

	/* Tutorial credit to W3Schools: https://www.w3schools.com/howto/howto_css_circles.asp - color will be specified in the element's style attribute, using [background-color]. */
	span.colored_circle {
		width: 16px;
		height: 16px;
		border-radius: 50%;
		border: 2px solid white;
		box-shadow: 0 0 5px black;
		display: inline-block;
		margin-right: 5px;
	}

	/* ID selectors have the highest specificity over the ones used in the template stylesheet files, which is why I'm going to use IDs to add a calendar icon for datepicker fields, and list them all here. Read more about specificity here: < https://developer.mozilla.org/en-US/docs/Web/CSS/Specificity > */
	input#id_veh_yfab, input#id_acq_timestamp, input#id_field_rent_start, input#id_field_rent_end {
		background: transparent url("/shared/img/icons/stock_calendar-view-year(gnome-2.10.1).png") center right/16px 16px no-repeat;
		cursor: pointer;
	}
	input#id_field_rgb {
		cursor: pointer;
	}
	input#id_field_rgb::placeholder {
		text-transform: uppercase;
		color: #eee;
		font-weight: bold;
		font-style: italic;
	}
	/* Placeholder styling: < https://www.samanthaming.com/tidbits/57-styling-css-placeholder/ > */

	div.danger_area {
		border: 1px solid #FF2727;
		border-radius: 15px;
		padding: 25px;
		margin: 25px;
		color: #FFC0C0;

		/* Background gradient code generated with: < https://cssgradient.io/ > */
		background: rgb(61,0,0);
		background: -moz-linear-gradient(315deg, rgba(61,0,0,1) 0%, rgba(185,0,0,1) 100%);
		background: -webkit-linear-gradient(315deg, rgba(61,0,0,1) 0%, rgba(185,0,0,1) 100%);
		background: linear-gradient(315deg, rgba(61,0,0,1) 0%, rgba(185,0,0,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#3d0000",endColorstr="#b90000",GradientType=1);
	}
	div.danger_area div.danger_area_title {
		text-transform: uppercase;
		font-size: 16px;
		border-bottom: 3px solid #FF8C8C;
		color: #FF8C8C;
		margin-bottom: 15px;
	}
</style>

<!-- Font Awesome icons -->
<?php include $_SERVER["DOCUMENT_ROOT"]."/shared/utils/Utils.Imports.FA.php"; ?>

<!-- Material Dashboard's stylesheet -->
<link rel=stylesheet href="/admin/res/css/material-dashboard.css?v=3.0.4" id=pagestyle />