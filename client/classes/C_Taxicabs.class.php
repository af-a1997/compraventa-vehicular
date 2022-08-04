<?php
	class C_Taxicabs{
		private $id_remise;
		private $nombres;
		private $apellidos;
		private $cedula_identidad;
		private $tel_cel;
		private $tel_fijo;
		private $email;
		private $ubicacion_residencia;
		private $costo_d;
		private $costo_espera_h;
		private $divisa_precio;
		private $id_reg_veh;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "remises";
			
			mysqli_set_charset($this->conn,"utf8");
		}
		public function __destruct(){
			unset($this->link);
		}
		
		public function __get($key){
			return $this->$key;
		}
		public function __set($key, $value){
			return $this->$key = $value;
		}
		
		public function CTXC_ShowAllForList(){
			$sql_query_list_all_pub_txc = "SELECT $this->tbl.*, divisas.abr AS cab, registros.matricula AS mat, vehiculos.idno AS vid, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vyf, marcas.nombre AS bna FROM $this->tbl INNER JOIN divisas ON $this->tbl.divisa_precio = divisas.id_moneda INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_pub_txc);
			
			$arr_list_txc_pub = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Taxicabs();
				
				// Base
				$o->id_remise = $res["id_remise"];
				$o->nombres = $res["nombres"];
				$o->apellidos = $res["apellidos"];
				$o->cedula_identidad = $res["cedula_identidad"];
				$o->tel_cel = $res["tel_cel"];
				$o->tel_fijo = $res["tel_fijo"];
				$o->email = $res["email"];
				$o->ubicacion_residencia = $res["ubicacion_residencia"];
				$o->costo_d = $res["costo_d"];
				$o->costo_espera_h = $res["costo_espera_h"];
				$o->divisa_precio = $res["divisa_precio"];
				$o->id_reg_veh = $res["id_reg_veh"];
				
				// Joins
				$o->cab = $res["cab"];
				$o->mat = $res["mat"];
				$o->vid = $res["vid"];
				$o->vmo = $res["vmo"];
				$o->vyf = $res["vyf"];
				$o->bna = $res["bna"];
				
				$arr_list_txc_pub[] = $o;
			}
			return $arr_list_txc_pub;
		}
		
		public function CTXC_ShowOne(){
			$sql_query_details_1_txc ="SELECT $this->tbl.*, divisas.abr AS cab, registros.matricula AS mat, vehiculos.idno AS vid, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vyf, vehiculos.categorizacion AS vca, vehiculos.puertas AS vdo, vehiculos.transmision AS vtr, vehiculos.combustible_tipo AS vft, vehiculos.combustible_capac AS vfc, vehiculos.motor AS ven, marcas.nombre AS bna FROM $this->tbl INNER JOIN divisas ON $this->tbl.divisa_precio = divisas.id_moneda INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno WHERE $this->tbl.id_remise = $this->id_remise;";
			
			$rt_db = mysqli_query($this->conn, $sql_query_details_1_txc);
			
			$res = mysqli_fetch_assoc($rt_db);
			
			if($res){
				$o = new C_Taxicabs();
				
				// Base
				$o->id_remise = $res["id_remise"];
				$o->nombres = $res["nombres"];
				$o->apellidos = $res["apellidos"];
				$o->cedula_identidad = $res["cedula_identidad"];
				$o->tel_cel = $res["tel_cel"];
				$o->tel_fijo = $res["tel_fijo"];
				$o->email = $res["email"];
				$o->ubicacion_residencia = $res["ubicacion_residencia"];
				$o->costo_d = $res["costo_d"];
				$o->costo_espera_h = $res["costo_espera_h"];
				$o->divisa_precio = $res["divisa_precio"];
				$o->id_reg_veh = $res["id_reg_veh"];
				
				// Joins
				$o->cab = $res["cab"];
				$o->mat = $res["mat"];
				$o->vid = $res["vid"];
				$o->vmo = $res["vmo"];
				$o->vyf = $res["vyf"];
                $o->vca = $res["vca"];
                $o->vdo = $res["vdo"];
                $o->vtr = $res["vtr"];
                $o->vft = $res["vft"];
                $o->vfc = $res["vfc"];
                $o->ven = $res["ven"];
				$o->bna = $res["bna"];
				
				$veh_info_r = $o;
			}
			else{
				$veh_info_r = null;
			}
			return $veh_info_r;
		}
	}
?>