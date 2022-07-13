<?php
class Registered_Veh_Info{
	private $id_reg;			// INT
	private $ultima_act_info;	// DATETIME
	private $color;				// VARCHAR(10)
	private $matricula;			// VARCHAR(10)
	private $estado_act;		// LONGTEXT
	private $kilometraje_act;	// DOUBLE
	private $usado;				// BOOLEAN -> TINYINT
	private $vehiculo_asociado;	// INT - foreign key to [vehiculos]
	
	private $conn;
	private $tbl;
	
	// public function __construct($id_reg,$ultima_act_info,$color,$matricula,$estado_act,$kilometraje_act,$usado,$vehiculo_asociado){
	public function __construct($id_reg,$ultima_act_info,$color,$matricula,$estado_act,$kilometraje_act,$usado,$vehiculo_asociado){
		$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
		$this->tbl = "registros";
		
		/*
		$this->id_reg = $id_reg;
		$this->ultima_act_info = $ultima_act_info;
		$this->color = $color;
		$this->matricula = $matricula;
		$this->estado_act = $estado_act;
		$this->kilometraje_act = $kilometraje_act;
		$this->usado = $usado;
		$this->vehiculo_asociado = $vehiculo_asociado;
		*/
		
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
	
	public function RVI_Add(){
		$sql_query_rvi_add = "INSERT INTO $this->tbl (ultima_act_info, color, matricula, estado_act, kilometraje_act, usado, vehiculo_asociado) VALUES ('$this->ultima_act_info', '$this->color', '$this->matricula', '$this->estado_act', '$this->kilometraje_act', $this->usado, $this->vehiculo_asociado);";
		
		$r = mysqli_query($this->conn, $sql_query_rvi_add);
		return $r;
	}
	
	public function RVI_ShowAll(){
		$sql_query_list_all_rvi = "SELECT * FROM $this->tbl;";
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_rvi);
		
		$arr_list_rvi = null;
		
		while($res = mysqli_fetch_assoc($rt_db)){
			$o = new Registered_rvi_Info();
			
			$o->id_reg = $res["id_reg"];
			$o->ultima_act_info = $res["ultima_act_info"];
			$o->color = $res["color"];
			$o->matricula = $res["matricula"];
			$o->estado_act = $res["estado_act"];
			$o->kilometraje_act = $res["kilometraje_act"];
			$o->usado = $res["usado"];
			$o->vehiculo_asociado = $res["vehiculo_asociado"];
			
			$arr_list_rvi[] = $o;
		}
		return $arr_list_rvi;
	}
	
	public function RVI_ShowOne(){
		$sql_query_list_1_rvi ="SELECT * FROM $this->tbl WHERE id_reg=$this->id_reg";
		$retorno = mysqli_query($this->conn, $sql_query_list_1_rvi);
		
		$res = mysqli_fetch_assoc($retorno);
		
		if($res){
			$o = new Registered_rvi_Info();
			
			$o->id_reg = $res["id_reg"];
			$o->ultima_act_info = $res["ultima_act_info"];
			$o->color = $res["color"];
			$o->matricula = $res["matricula"];
			$o->estado_act = $res["estado_act"];
			$o->kilometraje_act = $res["kilometraje_act"];
			$o->usado = $res["usado"];
			$o->vehiculo_asociado = $res["vehiculo_asociado"];
			
			$rvi_r = $o;
		}
		else{
			$rvi_r = null;
		}
		
		return $rvi_r;
	}
	
	public function RVI_EditOne(){
		$sql_query_upd_1_rvi = "UPDATE $this->tbl SET ultima_act_info='$this->ultima_act_info', 'color=$this->color', 'matricula=$this->matricula', 'estado_act=$this->estado_act', kilometraje_act=$this->kilometraje_act, usado=$this->usado, vehiculo_asociado=$this->vehiculo_asociado WHERE id_reg=$this->id_reg;";
		$r = mysqli_query($this->conn, $sql_query_upd_1_rvi);
		
		return $r;
	}
	
	public function RVI_DelOne(){
		$sql_query_del_1_rvi = "DELETE FROM $this->tbl WHERE id_reg=$this->id_reg";
		$r = mysqli_query($this->conn, $sql_query_del_1_rvi);
		
		return $r;
	}
?>