<?php
class Brands{
	// Attributes for vehicle: ID, name, description and URL to its logo picture.
	private $idno;
	private $nombre;
	private $descripcion;
	private $url_img;
	
	private $conn;
	private $tbl;
	
	public function __construct(){
		$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
		$this->tbl = "marcas";
		
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
	
	public function BRAND_Add(){
		$sql_query_brand_reg = "INSERT INTO $this->tbl (nombre, descripcion, url_img) VALUES ('$this->nombre', \"$this->descripcion\", '$this->url_img');";
		echo $sql_query_brand_reg;
		
		$r = mysqli_query($this->conn, $sql_query_brand_reg);
		return $r;
	}
	
	public function BRAND_ShowAll(){
		$sql_query_list_all_vcat = "SELECT * FROM $this->tbl;";
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_vcat);
		
		$arr_list_brand = null;
		
		while($res = mysqli_fetch_assoc($rt_db)){
			$o = new Veh_Cat();
			
			$o->idno = $res["idno"];
			$o->nombre = $res["nombre"];
			$o->descripcion = $res["descripcion"];
			$o->url_img = $res["url_img"];
			
			$arr_list_brand[] = $o;
		}
		return $arr_list_brand;
	}
	
	public function BRAND_ShowAllWithVehStat(){
		/*
		 * This was quite harder to figure out than what I first thought, but it works now.
		 * I didn't know that COUNT() returns a total of non-null values, which is <<<probably>>> why the other rows other than "BMW" (from the sample data) weren't showing up in the list.
		 * With this, even brands with 0 vehicles registered will show up.
		 * 
		 * Credits to solution: https://stackoverflow.com/a/58572751 (user GMB from Stack Overflow).
		 * */
		$sql_query_list_all_vcat = "SELECT b.*, (SELECT COUNT(*) FROM vehiculos v WHERE v.marca = b.idno) AS vcc FROM $this->tbl b;";
		
		$rt_db = mysqli_query($this->conn, $sql_query_list_all_vcat);
		
		$arr_list_brand = null;
		
		while($res = mysqli_fetch_assoc($rt_db)){
			$o = new Veh_Cat();
			
			$o->idno = $res["idno"];
			$o->nombre = $res["nombre"];
			$o->descripcion = $res["descripcion"];
			$o->url_img = $res["url_img"];
			$o->vcc = $res["vcc"];
			
			$arr_list_brand[] = $o;
		}
		return $arr_list_brand;
	}
	
	public function BRAND_ShowOne(){
		$sql_query_list_1brand ="SELECT b.*, (SELECT COUNT(*) FROM vehiculos v WHERE v.marca = b.idno) AS vcc FROM $this->tbl b WHERE idno=$this->idno";
		$ret_consult = mysqli_query($this->conn, $sql_query_list_1brand);
		
		$res = mysqli_fetch_assoc($ret_consult);
		
		if($res){
			$o = new Veh_Cat();
			
			$o->idno = $res["idno"];
			$o->nombre = $res["nombre"];
			$o->descripcion = $res["descripcion"];
			$o->url_img = $res["url_img"];
			$o->vcc = $res["vcc"];
			
			$brand_info_r = $o;
		}
		else{
			$brand_info_r = null;
		}
		return $brand_info_r;
	}
	
	public function BRAND_UpdateOne($with_logo = false){
		$attach_logo = "";
		if($with_logo == true)
			$attach_logo = ", url_img='$this->url_img'";

		$sql_query_upd_1brand = "UPDATE $this->tbl SET nombre=\"$this->nombre\", descripcion=\"$this->descripcion\"".$attach_logo." WHERE idno=$this->idno";

		$r = mysqli_query($this->conn, $sql_query_upd_1brand);
		
		return $r;
	}
	
	public function BRAND_DeleteOne(){
		$sql_query_del_1brand = "DELETE FROM $this->tbl WHERE idno=$this->idno";
		$r = mysqli_query($this->conn, $sql_query_del_1brand);
		
		return $r;
	}
}