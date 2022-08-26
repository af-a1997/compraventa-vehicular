<?php
	// Strings exclusive to administrators.
	
	// Misc
	const a_dsb = "Panel de administración";
	const a_credits = "Agradecimientos";
	const a_txc_con = "Remises contratados";
	const a_s_con = "Detener contrato con remise";
	
	// Prefixes for sections and breadcrumbs
	const a_mp = "Gestión de ";
	const a_dtl = "Detalles de ";
	const a_lof = "Lista de ";
	const a_reg = "Registrar ";
	const a_upd = "Editar ";
	const a_del = "Eliminar ";
	
	// Top level section names
	const a_artman = a_mp."artículos";
	const a_climan = a_mp."clientela";
	const a_conman = "Gestionar remises contratados";
	const a_haman = a_mp."vehículos alquilables";
	const a_hvman = a_mp."alquileres";
	const a_oman = a_mp."otros";
	const a_phman = "Historial de adquisiciones";
	const a_regman = a_mp."registros";
	const a_tcman = a_mp."remises";
	const a_vehman = a_mp."vehículos";
	
	// Sub-sections for [Other]
	const a_o_brands = "Gestionar marcas";
	const a_o_catveh = "Gestionar categorización de vehículos";
	const a_o_curr = "Gestionar divisas";
	
	// New element
	const a_n_acq = a_reg."adquisición de vehículo";
	const a_n_brn = a_reg."marca";
	const a_n_ccy = a_reg."divisa";
	const a_n_cli = a_reg."cliente";
	const a_n_rnt = a_reg."veh. rentable";
	const a_n_slb = a_reg."veh. para vender";
	const a_n_txc = a_reg."remise";
	const a_n_vcat = a_reg."categoría";
	const a_n_veh = a_reg."vehículo";

	// Details
	const a_d_brn = a_dtl."la marca ";
	const a_d_ccy = a_dtl."la divisa ";
	const a_d_cli = a_dtl."el cliente ";
	const a_d_con = a_dtl."el contrato con remise ";
	const a_d_rhi = a_dtl."el alquiler ";
	const a_d_rnt = a_dtl."el veh. alquilable ";
	const a_d_slb = a_dtl."el veh. en venta ";
	const a_d_txc = a_dtl."el remise ";
	const a_d_vcat = a_dtl."la categoría ";
	const a_d_veh = a_dtl."el vehículo ";
	
	// Update element
	const a_u_brn = a_upd."datos de la marca ";
	const a_u_ccy = a_upd."la divisa ";
	const a_u_cli = a_upd."el cliente ";
	const a_u_reg = a_upd."el registro ";
	const a_u_rnt = a_upd."el vehículo rentable ";
	const a_u_rhi = a_upd."la instancia de alquiler ";
	const a_u_slb = a_upd."el veh. en venta ";
	const a_u_txc = a_upd."el remise ";
	const a_u_veh = a_upd."el vehículo ";
	const a_u_vcat = a_upd."la categoría ";

	// Remove element
	const a_r_acq = a_del."entrada de adquisición ";
	const a_r_brn = a_del."la marca ";
	const a_r_cli = a_del."el cliente ";
	const a_r_ccy = a_del."la divisa ";
	const a_r_reg = a_del."el registro ";
	const a_r_rhi = a_del."la instancia de alquiler ";
	const a_r_rnt = a_del."el veh. rentable ";
	const a_r_slb = a_del."el veh. en venta ";
	const a_r_txc = a_del."el remise ";
	const a_r_vcat = a_del."la categoría ";
	const a_r_veh = a_del."el vehículo ";
	
	// Full table wipeout sections
	const a_w_acq = a_del."todas las entradas de adquisiciones";
	const a_w_con = a_del."contratos con remises";
	const a_w_rhi = a_del."historial de alquileres";

	// List vehicles by brand
	const a_l_vbb_all = a_lof."vehículos por marca";
	const a_l_vbb_one = a_lof."vehículos por la marca ";

	// Vehicle availability lists
	const a_ss_sellable = "Vehículos disponibles para vender";
	const a_ss_rentable = "Vehículos disponibles para alquilar";
?>