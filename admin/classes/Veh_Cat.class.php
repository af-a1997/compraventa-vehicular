<?php
class Veh_Cat{
	// Attributes for vehicle: ID, name and description.
	private $id_tipo;
	private $nombre;
	private $descripcion;
	
	private $conn;
	private $tbl;
	
	public function __construct(){
		$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
		$this->tbl = "tipo_veh";
		
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
	
	public function VCAT_Add(){
		$sql_query_veh_reg = "INSERT INTO $this->tbl (nombre, descripcion) VALUES ('$this->nombre', '$this->descripcion');";
		
		$r = mysqli_query($this->conn, $sql_query_veh_reg);
		return $r;
	}
	
	public function VCAT_ShowAll(){
		$sql_query_list_all_vcat = "SELECT * FROM $this->tbl;";
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_vcat);
		
		$arr_list_vcat = null;
		
		while($res = mysqli_fetch_assoc($rt_db)){
			$o = new Veh_Cat();
			
			$o->id_tipo = $res["id_tipo"];
			$o->nombre = $res["nombre"];
			$o->descripcion = $res["descripcion"];
			
			$arr_list_vcat[] = $o;
		}
		return $arr_list_vcat;
	}
	
	public function VCAT_ShowOne(){
		$sql_query_list_1vcat ="SELECT * FROM $this->tbl WHERE id_tipo=$this->id_tipo";
		$ret_consult = mysqli_query($this->conn, $sql_query_list_1vcat);
		
		$res = mysqli_fetch_assoc($ret_consult);
		
		if($res){
			$o = new Veh_Cat();
			
			$o->id_tipo = $res["id_tipo"];
			$o->nombre = $res["nombre"];
			$o->descripcion = $res["descripcion"];
			
			$vcat_info_r = $o;
		}
		else{
			$vcat_info_r = null;
		}
		return $vcat_info_r;
	}
	
	public function VCAT_UpdateOne(){
		$sql_query_upd_1vcat = "UPDATE $this->tbl SET nombre='$this->nombre', descripcion='$this->descripcion' WHERE id_tipo=$this->id_tipo";
		$r = mysqli_query($this->conn, $sql_query_upd_1vcat);
		
		return $r;
	}
	
	public function VCAT_DeleteOne(){
		$sql_query_del_1vcat = "DELETE FROM $this->tbl WHERE id_tipo=$this->id_tipo";
		$r = mysqli_query($this->conn, $sql_query_del_1vcat);
		
		return $r;
	}
}