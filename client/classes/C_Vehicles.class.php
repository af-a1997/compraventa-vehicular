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

		public function CVEH_ShowAllOfCat(){
			$sql_query_list_sqr_veh = "SELECT $this->tbl.*, marcas.nombre AS bna FROM $this->tbl INNER JOIN marcas ON $this->tbl.marca = marcas.idno WHERE categorizacion = $this->categorizacion;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_sqr_veh);
			
			$arr_list_veh = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Vehicles();
				
				// Base
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
				
				// Joins
				$o->bna = $res["bna"];
				
				$arr_list_veh[] = $o;
			}
			return $arr_list_veh;
		}

		public function CVEH_Search($search_param = ""){
			$sql_query_list_sqr_veh = "SELECT $this->tbl.*, marcas.nombre AS bna, tipo_veh.nombre AS vty FROM $this->tbl INNER JOIN marcas ON $this->tbl.marca = marcas.idno INNER JOIN tipo_veh ON $this->tbl.categorizacion = tipo_veh.id_tipo WHERE $this->tbl.modelo LIKE '%".$search_param."%';";
			$rt_db = mysqli_query($this->conn, $sql_query_list_sqr_veh);
			
			$arr_list_veh = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Vehicles();
				
				// Base
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
				
				// Joins
				$o->bna = $res["bna"];
				$o->vty = $res["vty"];
				
				$arr_list_veh[] = $o;
			}
			return $arr_list_veh;
		}

        // List used for dropdown menu when registering acquisition and/or license plate.
        public function CVEH_GetCountByVCAT($cat_no){
            $sql_query_list_sqr_veh = "SELECT COUNT(categorizacion) AS total_veh_cat FROM vehiculos WHERE categorizacion = $cat_no;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_sqr_veh);
            
            $obt_arts_on_vcat_count = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new C_Vehicles();
                
                $o->total_veh_cat = $res["total_veh_cat"];
                
                $obt_arts_on_vcat_count = $o;
            }
            return $obt_arts_on_vcat_count;
        }
    }
?>