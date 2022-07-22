<?php
class Currencies{
	private $id_moneda;			// INT
	private $nombre;			// VARCHAR(100)
	private $abr;				// VARCHAR(5)
	private $simbolizacion;		// VARCHAR(5)
	private $pos_sim;			// BOOLEAN or TINYINT
	
	private $conn;
	private $tbl;
	
	public function __construct(){
		$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
		$this->tbl = "divisas";
		
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
	
	public function CCY_Add(){
		$sql_query_rvi_add = "INSERT INTO $this->tbl (nombre, abr, simbolizacion, pos_sim) VALUES ('$this->nombre', '$this->abr', '$this->simbolizacion', $this->pos_sim);";
		
		$r = mysqli_query($this->conn, $sql_query_rvi_add);
		return $r;
	}
	
	public function CCY_ShowAll(){
		$sql_query_list_all_rvi = "SELECT * FROM $this->tbl;";
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_rvi);
		
		$arr_list_currency = null;
		
		while($res = mysqli_fetch_assoc($rt_db)){
			$o = new Currencies();
			
			$o->id_moneda = $res["id_moneda"];
			$o->nombre = $res["nombre"];
			$o->abr = $res["abr"];
			$o->simbolizacion = $res["simbolizacion"];
			$o->pos_sim = $res["pos_sim"];
			
			$arr_list_currency[] = $o;
		}
		return $arr_list_currency;
	}
	
	public function CCY_ShowOne(){
		$sql_query_list_1ccy ="SELECT * FROM $this->tbl WHERE id_moneda=$this->id_moneda";
		$retorno = mysqli_query($this->conn, $sql_query_list_1ccy);
		
		$res = mysqli_fetch_assoc($retorno);
		
		if($res){
			$o = new Currencies();
			
			$o->id_moneda = $res["id_moneda"];
			$o->nombre = $res["nombre"];
			$o->abr = $res["abr"];
			$o->simbolizacion = $res["simbolizacion"];
			$o->pos_sim = $res["pos_sim"];
			
			$ccy_r = $o;
		}
		else{
			$ccy_r = null;
		}
		
		return $ccy_r;
	}
	
	public function CCY_EditOne(){
		$sql_query_upd_1ccy = "UPDATE $this->tbl SET nombre='$this->nombre', abr='$this->abr', simbolizacion='$this->simbolizacion', pos_sim=$this->pos_sim WHERE id_moneda=$this->id_moneda;";
		$r = mysqli_query($this->conn, $sql_query_upd_1ccy);
		
		return $r;
	}
	
	public function CCY_DelOne(){
		$sql_query_del_1ccy = "DELETE FROM $this->tbl WHERE id_reg=$this->id_reg";
		$r = mysqli_query($this->conn, $sql_query_del_1ccy);
		
		return $r;
	}
}
?>