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
	
	// In addition to the class attributes, it's needed to call the attributes from the other two classes that I'll instance here:
	
	// [gestion_veh.registros]
	private $id_reg;
	private $ultima_act_info;
	private $color;
	private $matricula;
	private $estado_act;
	private $kilometraje_act;
	private $usado;
	private $vehiculo_asociado;
	
	// [gestion_veh.adquisiciones]
	private $id_adq;
	private $tiempo;
	private $precio;
	private $estado_adq;
	private $kilometraje_adq;
	private $divisa_precio;
	private $id_del_adquirido;
	
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
	
	public function VEH_Reg(){
		$sql_query_veh_reg = "INSERT INTO $this->tbl (modelo, unidades, anho_fab, puertas, transmision, combustible_tipo, combustible_capac, motor, marca, categorizacion) VALUES ('$this->modelo', $this->unidades, $this->anho_fab, $this->puertas, $this->transmision, '$this->combustible_tipo', '$this->combustible_capac', $this->motor, $this->marca, $this->categorizacion);";
		
		$r = mysqli_query($this->conn, $sql_query_veh_reg);
		return $r;
	}
	
	public function VEH_List_all(){
		$sql_query_list_all_veh = "SELECT * FROM $this->tbl;";
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
		
		$arr_list_users = null;
		
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
			
			$arr_list_users[] = $o;
		}
		return $arr_list_users;
	}
	
	public function VEH_Show_one(){
		$sql_query_list_1_veh ="SELECT * FROM $this->tbl WHERE idno=$this->idno";
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
			
			$veh_info_r = $o;
		}
		else{
			$veh_info_r = null;
		}
		return $veh_info_r;
	}
	
	public function VEH_edit_one(){
		$sql_query_upd_1u = "UPDATE $this->tbl SET modelo='$this->modelo', unidades=$this->unidades, anho_fab=$this->anho_fab, puertas=$this->puertas, transmision=$this->transmision, 'combustible_tipo=$this->combustible_tipo', 'combustible_capac=$this->combustible_capac', 'motor=$this->motor, marca=$this->marca, categorizacion=$this->categorizacion WHERE idno=$this->idno";
		$r = mysqli_query($this->conn, $sql_query_upd_1u);
		
		return $r;
	}
	
	public function VEH_remove_one(){
		$sql_query_del_1u = "DELETE FROM $this->tbl WHERE idno=$this->idno";
		$r = mysqli_query($this->conn, $sql_query_del_1u);
		
		return $r;
	}
	
	public function ACQ_Reg(){
		$sql_query_adq_reg = "INSERT INTO $this->tbl (idno, modelo, unidades, anho_fab, puertas, transmision, combustible_tipo, combustible_capac, motor, marca, categorizacion) VALUES ($this->idno, '$this->modelo', $this->unidades, $this->anho_fab, $this->puertas, $this->transmision, '$this->combustible_tipo', '$this->combustible_capac', $this->motor, $this->marca, $this->categorizacion); INSERT INTO registros (ultima_act_info, color, matricula, estado_act, kilometraje_act, usado, vehiculo_asociado) VALUES ('$this->ultima_act_info', '$this->color', '$this->matricula', '$this->estado_act', '$this->kilometraje_act', $this->usado, $this->vehiculo_asociado); INSERT INTO adquisiciones (tiempo, precio, estado_adq, kilometraje_adq, divisa_precio, id_del_adquirido) VALUES ('$this->tiempo', $this->precio, '$this->estado_adq', $this->kilometraje_adq, $this->divisa_precio, $this->id_del_adquirido);";
		
		$r = mysqli_query($this->conn, $sql_query_adq_reg);
		return $r;
	}
}