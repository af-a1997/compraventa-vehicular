<?php
class Acquired_Veh{
	private $id_adq;			// INT
	private $tiempo;			// DATETIME
	private $precio;			// DOUBLE
	private $estado_adq;		// LONGTEXT
	private $kilometraje_adq;	// DOUBLE
	private $divisa_precio;		// INT - foreign key to [divisas].
	private $id_del_adquirido;	// INT - foreign key to [registros].
	
	private $conn;
	private $tbl;
	
	public function __construct(){
		$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
		$this->tbl = "adquisiciones";
		
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
	
	public function ACQ_Add(){
		$sql_query_acq_add = "INSERT INTO $this->tbl (tiempo, precio, estado_adq, kilometraje_adq, divisa_precio, id_del_adquirido) VALUES ('$this->tiempo', $this->precio, '$this->estado_adq', $this->kilometraje_adq, $this->divisa_precio, $this->id_del_adquirido);";
		
		$r = mysqli_query($this->conn, $sql_query_acq_add);
		return $r;
	}
	
	public function ACQ_ShowAll(){
		$sql_query_list_all_acq = "SELECT * FROM $this->tbl;";
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_acq);
		
		$arr_list_acq = null;
		
		while($res = mysqli_fetch_assoc($rt_db)){
			$o = new Registered_acq_Info();
			
			$o->id_adq = $res["id_adq"];
			$o->tiempo = $res["tiempo"];
			$o->precio = $res["precio"];
			$o->estado_adq = $res["estado_adq"];
			$o->kilometraje_adq = $res["kilometraje_adq"];
			$o->divisa_precio = $res["divisa_precio"];
			$o->id_del_adquirido = $res["id_del_adquirido"];
			
			$arr_list_acq[] = $o;
		}
		return $arr_list_acq;
	}
	
	public function ACQ_ShowOne(){
		$sql_query_list_1_acq ="SELECT * FROM $this->tbl WHERE id_adq=$this->id_adq";
		$retorno = mysqli_query($this->conn, $sql_query_list_1_acq);
		
		$res = mysqli_fetch_assoc($retorno);
		
		if($res){
			$o = new Registered_acq_Info();
			
			$o->id_adq = $res["id_adq"];
			$o->tiempo = $res["tiempo"];
			$o->precio = $res["precio"];
			$o->estado_adq = $res["estado_adq"];
			$o->kilometraje_adq = $res["kilometraje_adq"];
			$o->divisa_precio = $res["divisa_precio"];
			$o->id_del_adquirido = $res["id_del_adquirido"];
			
			$acqv_r = $o;
		}
		else{
			$acqv_r = null;
		}
		
		return $acqv_r;
	}
	
	public function ACQ_EditOne(){
		$sql_query_upd_1_acq = "UPDATE $this->tbl SET tiempo='$this->tiempo', precio=$this->precio, 'estado_adq=$this->estado_adq', kilometraje_adq=$this->kilometraje_adq, divisa_precio=$this->divisa_precio, id_del_adquirido=$this->id_del_adquirido WHERE id_adq=$this->id_adq;";
		$r = mysqli_query($this->conn, $sql_query_upd_1_acq);
		
		return $r;
	}
	
	public function ACQ_DelOne(){
		$sql_query_del_1_acq = "DELETE FROM $this->tbl WHERE id_adq=$this->id_adq";
		$r = mysqli_query($this->conn, $sql_query_del_1_acq);
		
		return $r;
	}
?>