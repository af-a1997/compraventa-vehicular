<?php
	class Rentable{
		// Notice: class [Rented] is for the register of rented vehicles, [Rentable] is for vehicles available for rent.
		private $id_art_alq;
		private $id_reg_veh;
		private $id_divisa;
		private $valor_diario_alq;
		private $disponibilidad;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
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
		
		public function RNT_Add(){
			$sql_query_rnt_reg = "INSERT INTO $this->tbl (id_reg_veh, id_divisa, valor_diario_alq, disponibilidad) VALUES ($this->id_reg_veh, $this->id_divisa, $this->valor_diario_alq, $this->disponibilidad);";
			
			$r = mysqli_query($this->conn, $sql_query_rnt_reg);
			
			return $r;
		}
		
		public function RNT_ShowAll(){
			$sql_query_list_all_rnt = "SELECT * FROM $this->tbl;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_rnt);
			
			$arr_list_rnt = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Rentable();
				
				$o->id_art_alq = $res["id_art_alq"];
				$o->id_reg_veh = $res["id_reg_veh"];
				$o->id_divisa = $res["id_divisa"];
				$o->valor_diario_alq = $res["valor_diario_alq"];
				$o->disponibilidad = $res["disponibilidad"];
				
				$arr_list_rnt[] = $o;
			}
			return $arr_list_rnt;
		}
		
		public function RNT_ShowAllForDD(){
			$sql_query_list_all_rnt = "SELECT $this->tbl.*, registros.matricula AS rlp, vehiculos.modelo AS vmo, marcas.nombre AS bno FROM $this->tbl INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno;";
			
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_rnt);
			
			$arr_list_rnt = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Rentable();
				
				// Base
				$o->id_art_alq = $res["id_art_alq"];
				$o->id_reg_veh = $res["id_reg_veh"];
				$o->id_divisa = $res["id_divisa"];
				$o->valor_diario_alq = $res["valor_diario_alq"];
				$o->disponibilidad = $res["disponibilidad"];
				
				// Joins
				$o->rlp = $res["rlp"];
				$o->vmo = $res["vmo"];
				$o->bno = $res["bno"];
				
				$arr_list_rnt[] = $o;
			}
			return $arr_list_rnt;
		}
		
		public function RNT_ShowAllForList(){
			$sql_query_list_all_rnt = "SELECT $this->tbl.*, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vfb, marcas.nombre AS bno, divisas.abr AS cab FROM $this->tbl INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON $this->tbl.id_divisa = divisas.id_moneda;";
			
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_rnt);
			
			$arr_list_rnt_for_list = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Rentable();
				
				// Base
				$o->id_art_alq = $res["id_art_alq"];
				$o->id_reg_veh = $res["id_reg_veh"];
				$o->id_divisa = $res["id_divisa"];
				$o->valor_diario_alq = $res["valor_diario_alq"];
				$o->disponibilidad = $res["disponibilidad"];
				
				// Joins
				$o->vmo = $res["vmo"];
				$o->vfb = $res["vfb"];
				$o->bno = $res["bno"];
				$o->cab = $res["cab"];
				
				$arr_list_rnt_for_list[] = $o;
			}
			return $arr_list_rnt_for_list;
		}
		
		public function RNT_ShowOne(){
			$sql_query_list_1rnt = "SELECT * FROM $this->tbl WHERE id_art_alq=$this->id_art_alq;";
			
			$ret_rnt_info = mysqli_query($this->conn, $sql_query_list_1rnt);
			
			$res = mysqli_fetch_assoc($ret_rnt_info);
			
			if($res){
				$o = new Rentable();
				
				$o->id_art_alq = $res["id_art_alq"];
				$o->id_reg_veh = $res["id_reg_veh"];
				$o->id_divisa = $res["id_divisa"];
				$o->valor_diario_alq = $res["valor_diario_alq"];
				$o->disponibilidad = $res["disponibilidad"];
				
				$arranged_rnt_info = $o;
			}
			else{
				$arranged_rnt_info = null;
			}
			return $arranged_rnt_info;
		}
		
		public function RNT_UpdateOne(){
			$sql_query_upd_1rnt = "UPDATE $this->tbl SET id_reg_veh=$this->id_reg_veh, id_divisa=$this->id_divisa, valor_diario_alq=this->$valor_diario_alq, id_veh_alquilado=$this->id_veh_alquilado, disponibilidad=$this->disponibilidad WHERE id_art_alq=$this->id_art_alq;";
			$r = mysqli_query($this->conn, $sql_query_upd_1rnt);
			
			return $r;
		}
		
		public function RNT_DeleteOne(){
			$sql_query_del_1rnt = "DELETE FROM $this->tbl WHERE id_art_alq=$this->id_art_alq;";
			$r = mysqli_query($this->conn, $sql_query_del_1rnt);
			
			return $r;
		}
	}
?>