<?php
    class C_VCAT{
        private $id_tipo;
        private $nombre;
        private $descripcion;
        private $icono_fa;
        
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

        // Lists categories for previews or lists of filters along with their icons, descriptions are displayed in the category's list of articles.
        public function CVCAT_ShowAllNoD(){
            $sql_query_list_all_veh = "SELECT id_tipo, nombre, icono_fa FROM $this->tbl;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
            
            $arr_list_vcat = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new C_VCAT();
                
                $o->id_tipo = $res["id_tipo"];
                $o->nombre = $res["nombre"];
                $o->icono_fa = $res["icono_fa"];
                
                $arr_list_vcat[] = $o;
            }
            return $arr_list_vcat;
        }

        public function CVCAT_ShowOne(){
            $sql_query_list_all_veh = "SELECT * FROM $this->tbl WHERE id_tipo = $this->id_tipo;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_all_veh);
            
            $arr_list_vcat = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new C_VCAT();
                
                $o->id_tipo = $res["id_tipo"];
                $o->nombre = $res["nombre"];
                $o->descripcion = $res["descripcion"];
                $o->icono_fa = $res["icono_fa"];
                
                $arr_list_vcat = $o;
            }
            return $arr_list_vcat;
        }
    }
?>