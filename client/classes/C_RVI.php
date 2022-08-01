<?php
	class C_RVI{
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
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "registros";
			
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
	}
?>