<?php
    class C_Vehicles{
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
			$this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
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

        // List used for dropdown menu when registering acquisition and/or license plate.
        public function CVEH_GetCountByVCAT($cat_no){
            $sql_query_list_all_veh = "SELECT COUNT(categorizacion) AS total_veh_cat FROM vehiculos WHERE categorizacion = $cat_no;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
            
            $arr_list_vcat_count = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new C_Vehicles();
                
                $o->total_veh_cat = $res["total_veh_cat"];
                
                $arr_list_vcat_count[] = $o;
            }
            return $arr_list_vcat_count;
        }
    }
?>