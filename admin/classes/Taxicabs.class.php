<?php
	class Taxicabs{
		private $id_remise;
		private $nombres;
		private $apellidos;
		private $cedula_identidad;
		private $tel_cel;
		private $tel_fijo;
		private $email;
		private $clave;
		private $ubicacion_residencia;
		private $costo_d;
		private $costo_espera_h;
		private $divisa_precio;
		private $id_reg_veh;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
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
		
		public function TXC_Add(){
			$sql_query_veh_reg = "INSERT INTO $this->tbl (nombres, apellidos, cedula_identidad, tel_cel, tel_fijo, email, clave, ubicacion_residencia, costo_d, costo_espera_h, divisa_precio, id_reg_veh) VALUES ('$this->nombres', '$this->apellidos', '$this->cedula_identidad', '$this->tel_cel', '$this->tel_fijo', '$this->email', '$this->clave', '$this->ubicacion_residencia', $this->costo_d, $this->costo_espera_h, $this->divisa_precio, $this->id_reg_veh);";
			
			$r = mysqli_query($this->conn, $sql_query_veh_reg);
			
			return $r;
		}
		
		public function TXC_ShowAll(){
			$sql_query_list_all_txc = "SELECT * FROM $this->tbl;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_txc);
			
			$arr_list_txc = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Taxicabs();
				
				$o->id_remise = $res["id_remise"];
				$o->nombres = $res["nombres"];
				$o->apellidos = $res["apellidos"];
				$o->cedula_identidad = $res["cedula_identidad"];
				$o->tel_cel = $res["tel_cel"];
				$o->tel_fijo = $res["tel_fijo"];
				$o->email = $res["email"];
				$o->clave = $res["clave"];
				$o->ubicacion_residencia = $res["ubicacion_residencia"];
				$o->costo_d = $res["costo_d"];
				$o->costo_espera_h = $res["costo_espera_h"];
				$o->divisa_precio = $res["divisa_precio"];
				$o->id_reg_veh = $res["id_reg_veh"];
				
				$arr_list_txc[] = $o;
			}
			return $arr_list_txc;
		}
		
		public function TXC_ShowAllForList(){
			$sql_query_list_all_txc = "SELECT $this->tbl.id_remise, $this->tbl.nombres, $this->tbl.apellidos, $this->tbl.email, $this->tbl.costo_d, $this->tbl.costo_espera_h, $this->tbl.divisa_precio, $this->tbl.id_reg_veh, divisas.abr AS cab FROM $this->tbl INNER JOIN divisas ON $this->tbl.divisa_precio = divisas.id_moneda;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_txc);
			
			$arr_list_txc_for_list = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Taxicabs();
				
				// Base
				$o->id_remise = $res["id_remise"];
				$o->nombres = $res["nombres"];
				$o->apellidos = $res["apellidos"];
				$o->email = $res["email"];
				$o->costo_d = $res["costo_d"];
				$o->costo_espera_h = $res["costo_espera_h"];
				$o->divisa_precio = $res["divisa_precio"];
				$o->id_reg_veh = $res["id_reg_veh"];

				// Joins
				$o->cab = $res["cab"];
				
				$arr_list_txc_for_list[] = $o;
			}
			return $arr_list_txc_for_list;
		}
		
		public function TXC_ShowOne(){
			$sql_query_list_1_txc = "SELECT $this->tbl.*, divisas.abr AS cab FROM $this->tbl INNER JOIN divisas ON $this->tbl.divisa_precio = divisas.id_moneda WHERE id_remise=$this->id_remise;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_1_txc);
			
			$res = mysqli_fetch_assoc($rt_db);
			
			if($res){
				$o = new Taxicabs();
				
				// Base
				$o->id_remise = $res["id_remise"];
				$o->nombres = $res["nombres"];
				$o->apellidos = $res["apellidos"];
				$o->cedula_identidad = $res["cedula_identidad"];
				$o->tel_cel = $res["tel_cel"];
				$o->tel_fijo = $res["tel_fijo"];
				$o->email = $res["email"];
				$o->clave = $res["clave"];
				$o->ubicacion_residencia = $res["ubicacion_residencia"];
				$o->costo_d = $res["costo_d"];
				$o->costo_espera_h = $res["costo_espera_h"];
				$o->divisa_precio = $res["divisa_precio"];
				$o->id_reg_veh = $res["id_reg_veh"];

				// Joins
				$o->cab = $res["cab"];
				
				$txc_info_r = $o;
			}
			else{
				$txc_info_r = null;
			}
			return $txc_info_r;
		}
		
		public function TXC_UpdateOne(){
			$sql_query_upd_1_txc = "UPDATE $this->tbl SET nombres='$this->nombres', apellidos='$this->apellidos', cedula_identidad='$this->cedula_identidad', tel_cel='$this->tel_cel', tel_fijo='$this->tel_fijo', email='$this->email', clave='$this->clave', ubicacion_residencia='$this->ubicacion_residencia', costo_d=$this->costo_d, costo_espera_h=$this->costo_espera_h, divisa_precio=$this->divisa_precio, id_reg_veh=$this->id_reg_veh WHERE id_remise=$this->id_remise;";
			
			$r = mysqli_query($this->conn, $sql_query_upd_1_txc);
			
			return $r;
		}
		
		public function TXC_DeleteOne(){
			$sql_query_del_1_txc = "DELETE FROM $this->tbl WHERE id_remise=$this->id_remise;";
			$r = mysqli_query($this->conn, $sql_query_del_1_txc);
			
			return $r;
		}
	}
?>