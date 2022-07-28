<?php
    class C_VCAT{
        private $id_tipo;
        private $nombre;
        private $descripcion;
        
        private $conn;
        private $tbl;
        
        public function __construct(){
            $this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
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

        public function CVCAT_ShowAllNoD(){
            $sql_query_list_all_veh = "SELECT id_tipo, nombre FROM $this->tbl;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
            
            $arr_list_vcat = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new C_VCAT();
                
                $o->id_tipo = $res["id_tipo"];
                $o->nombre = $res["nombre"];
                
                $arr_list_vcat[] = $o;
            }
            return $arr_list_vcat;
        }
    }
?>