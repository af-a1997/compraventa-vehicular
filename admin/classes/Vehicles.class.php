<?php
	class Vehicles{
		// Attributes for vehicle: ID, model, stock, year this model was made, doors, transmission, fuel type, fuel capacity, engine, brand ID and vehicle type ID.
		private $idno;
		private $modelo;
		private $unidades;
		private $anho_fab;
		private $puertas;
		private $transmision;
		private $combustible_tipo;
		private $combustible_capac;
		private $motor;
		private $marca;
		private $categorizacion;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "vehiculos";
			
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
		
		public function VEH_Add(){
			$sql_query_veh_reg = "INSERT INTO $this->tbl (modelo, unidades, anho_fab, puertas, transmision, combustible_tipo, combustible_capac, motor, marca, categorizacion) VALUES ('$this->modelo', $this->unidades, $this->anho_fab, $this->puertas, $this->transmision, '$this->combustible_tipo', $this->combustible_capac, '$this->motor', $this->marca, $this->categorizacion);";
			
			$r = mysqli_query($this->conn, $sql_query_veh_reg);
			
			return $r;
		}
		
		public function VEH_ShowAll(){
			$sql_query_list_all_veh = "SELECT * FROM $this->tbl;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
			
			$arr_list_veh = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Vehicles();
				
				$o->idno = $res["idno"];
				$o->modelo = $res["modelo"];
				$o->unidades = $res["unidades"];
				$o->anho_fab = $res["anho_fab"];
				$o->puertas = $res["puertas"];
				$o->transmision = $res["transmision"];
				$o->combustible_tipo = $res["combustible_tipo"];
				$o->combustible_capac = $res["combustible_capac"];
				$o->motor = $res["motor"];
				$o->marca = $res["marca"];
				$o->categorizacion = $res["categorizacion"];
				
				$arr_list_veh[] = $o;
			}
			return $arr_list_veh;
		}
		
		// List used for dropdown menu when registering acquisition and/or license plate.
		public function VEH_ShowAllForDD(){
			$sql_query_list_all_veh = "SELECT vehiculos.idno, vehiculos.modelo, marcas.nombre AS mno FROM vehiculos, marcas WHERE vehiculos.marca = marcas.idno;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
			
			$arr_list_veh_for_dd = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Vehicles();
				
				$o->idno = $res["idno"];
				$o->modelo = $res["modelo"];
				$o->mno = $res["mno"];
				
				$arr_list_veh_for_dd[] = $o;
			}
			return $arr_list_veh_for_dd;
		}
		
		// Shows list of vehicles for vehicle manager.
		public function VEH_ShowAllForList(){
			$sql_query_list_all_veh = "SELECT vehiculos.idno, vehiculos.modelo, vehiculos.unidades, vehiculos.anho_fab, marcas.nombre AS mno FROM vehiculos, marcas WHERE vehiculos.marca = marcas.idno;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
			
			$arr_list_veh_for_dd = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Vehicles();
				
				$o->idno = $res["idno"];
				$o->modelo = $res["modelo"];
				$o->unidades = $res["unidades"];
				$o->anho_fab = $res["anho_fab"];
				$o->mno = $res["mno"];
				
				$arr_list_veh_for_dd[] = $o;
			}
			return $arr_list_veh_for_dd;
		}
		
		// Shows all info for one vehicle.
		public function VEH_ShowOne(){
			$sql_query_list_1_veh ="SELECT vehiculos.*, marcas.nombre AS mno, tipo_veh.nombre AS tvo FROM vehiculos INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN tipo_veh ON vehiculos.categorizacion = tipo_veh.id_tipo WHERE vehiculos.idno = $this->idno;";
			
			$retorno = mysqli_query($this->conn, $sql_query_list_1_veh);
			
			$res = mysqli_fetch_assoc($retorno);
			
			if($res){
				$o = new Vehicles();
				
				$o->idno = $res["idno"];
				$o->modelo = $res["modelo"];
				$o->unidades = $res["unidades"];
				$o->anho_fab = $res["anho_fab"];
				$o->puertas = $res["puertas"];
				$o->transmision = $res["transmision"];
				$o->combustible_tipo = $res["combustible_tipo"];
				$o->combustible_capac = $res["combustible_capac"];
				$o->motor = $res["motor"];
				$o->marca = $res["marca"];
				$o->categorizacion = $res["categorizacion"];
				$o->mno = $res["mno"];
				$o->tvo = $res["tvo"];
				
				$veh_info_r = $o;
			}
			else{
				$veh_info_r = null;
			}
			return $veh_info_r;
		}
		
		public function VEH_UpdateOne(){
			$sql_query_upd_1u = "UPDATE $this->tbl SET modelo='$this->modelo', unidades=$this->unidades, anho_fab=$this->anho_fab, puertas=$this->puertas, transmision=$this->transmision, combustible_tipo='$this->combustible_tipo', combustible_capac=$this->combustible_capac, motor='$this->motor', marca=$this->marca, categorizacion=$this->categorizacion WHERE idno=$this->idno";
			$r = mysqli_query($this->conn, $sql_query_upd_1u);
			
			return $r;
		}
		
		public function VEH_DeleteOne(){
			$sql_query_del_1u = "DELETE FROM $this->tbl WHERE idno=$this->idno";
			$r = mysqli_query($this->conn, $sql_query_del_1u);
			
			return $r;
		}
	}
?>