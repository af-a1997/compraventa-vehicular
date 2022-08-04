<?php
	class C_Rentable{
		private $id_art_alq;
		private $id_reg_veh;
		private $id_divisa;
		private $valor_diario_alq;
		private $disponibilidad;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "seleccion_alquiler";
			
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
		
		public function CRNT_ShowAllForList(){
			$sql_query_list_all_rnt = "SELECT $this->tbl.*, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vyf, marcas.nombre AS bna, divisas.abr AS cab FROM $this->tbl INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON $this->tbl.id_divisa = divisas.id_moneda;";
			
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_rnt);
			
			$arr_list_rnt_for_list = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Rentable();
				
				// Base
				$o->id_art_alq = $res["id_art_alq"];
				$o->id_reg_veh = $res["id_reg_veh"];
				$o->id_divisa = $res["id_divisa"];
				$o->valor_diario_alq = $res["valor_diario_alq"];
				$o->disponibilidad = $res["disponibilidad"];
				
				// Joins
				$o->vmo = $res["vmo"];
				$o->vyf = $res["vyf"];
				$o->bna = $res["bna"];
				$o->cab = $res["cab"];
				
				$arr_list_rnt_for_list[] = $o;
			}
			return $arr_list_rnt_for_list;
		}
		
		public function CRNT_ShowOne(){
			$sql_query_list_1rnt = "SELECT $this->tbl.*, divisas.abr AS cab, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vyf, vehiculos.categorizacion AS vca, vehiculos.puertas AS vdo, vehiculos.transmision AS vtr, vehiculos.combustible_tipo AS vft, vehiculos.combustible_capac AS vfc, vehiculos.motor AS ven, marcas.nombre AS bna FROM $this->tbl INNER JOIN divisas ON $this->tbl.id_divisa = divisas.id_moneda INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno WHERE id_art_alq=$this->id_art_alq;";
			
			$ret_rnt_info = mysqli_query($this->conn, $sql_query_list_1rnt);
			
			$res = mysqli_fetch_assoc($ret_rnt_info);
			
			if($res){
				$o = new C_Rentable();
				
				// Base
				$o->id_art_alq = $res["id_art_alq"];
				$o->id_reg_veh = $res["id_reg_veh"];
				$o->id_divisa = $res["id_divisa"];
				$o->valor_diario_alq = $res["valor_diario_alq"];
				$o->disponibilidad = $res["disponibilidad"];

                // Joins
                $o->cab = $res["cab"];        // <--- Currency short name.
                $o->vmo = $res["vmo"];        // <--- Vehicle model.
                $o->vyf = $res["vyf"];        // <--- Vehicle year of fabrication.
                $o->vca = $res["vca"];        // <--- Vehicle category.
                $o->vdo = $res["vdo"];        // <--- Vehicle doors count.
                $o->vtr = $res["vtr"];        // <--- Vehicle transmission.
                $o->vft = $res["vft"];        // <--- Vehicle fuel type.
                $o->vfc = $res["vfc"];        // <--- Vehicle fuel capacity.
                $o->ven = $res["ven"];        // <--- Vehicle engine.
                $o->bna = $res["bna"];        // <--- Brand name.
				
				$arranged_rnt_info = $o;
			}
			else{
				$arranged_rnt_info = null;
			}
			return $arranged_rnt_info;
		}
	}
?>