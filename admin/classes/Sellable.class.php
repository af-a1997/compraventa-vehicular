<?php
    class Sellable{
        // Class for vehicles that can be sold by clients (or articles).
        private $id_art_venta;
        private $id_reg_veh;
        private $divisa_precio;
        private $valor_venta;
        private $momento_pub;
        private $detalles;
        private $vendedor;

        private $conn;
        private $tbl;
        
        public function __construct(){
            $this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
            $this->tbl = "a_vender";
            
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
	
        public function ART_Add(){
            $sql_query_adq_reg = "INSERT INTO $this->tbl (id_reg_veh, divisa_precio, valor_venta, momento_pub, detalles, vendedor) VALUES ($this->id_reg_veh, $this->divisa_precio, $this->valor_venta, '$this->momento_pub', '$this->detalles', $this->vendedor);";
            
            $r = mysqli_query($this->conn, $sql_query_adq_reg);
            
            return $r;
        }
	
        public function ART_ShowAll(){
            $sql_query_list_all_art = "SELECT * FROM $this->tbl;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_all_art);
            
            $arr_list_art = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new Sellable();
                
                $o->id_art_venta = $res["id_art_venta"];
                $o->id_reg_veh = $res["id_reg_veh"];
                $o->divisa_precio = $res["divisa_precio"];
                $o->valor_venta = $res["valor_venta"];
                $o->momento_pub = $res["momento_pub"];
                $o->detalles = $res["detalles"];
                $o->vendedor = $res["vendedor"];
                
                $arr_list_art[] = $o;
            }

            return $arr_list_art;
        }
	
        public function ART_ShowAllForList(){
            $sql_query_list_all_art4dd = "SELECT $this->tbl.*, usuarios.nro_id_u AS userid, usuarios.nombre_usuario AS uno, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vfb, marcas.nombre AS bno, divisas.abr AS cab FROM $this->tbl INNER JOIN usuarios ON a_vender.vendedor = usuarios.nro_id_u INNER JOIN registros ON a_vender.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON a_vender.divisa_precio = divisas.id_moneda;";
            $rt_db = mysqli_query($this->conn, $sql_query_list_all_art4dd);
            
            $arr_list_art = null;
            
            while($res = mysqli_fetch_assoc($rt_db)){
                $o = new Sellable();
                
                // Base
                $o->id_art_venta = $res["id_art_venta"];
                $o->id_reg_veh = $res["id_reg_veh"];
                $o->divisa_precio = $res["divisa_precio"];
                $o->valor_venta = $res["valor_venta"];
                $o->momento_pub = $res["momento_pub"];
                $o->detalles = $res["detalles"];
                $o->vendedor = $res["vendedor"];
                
                // Joins
                $o->userid = $res["userid"];
                $o->uno = $res["uno"];
                $o->vmo = $res["vmo"];
                $o->vfb = $res["vfb"];
                $o->bno = $res["bno"];
                $o->cab = $res["cab"];
                
                $arr_list_art[] = $o;
            }

            return $arr_list_art;
        }
	
        public function ART_ShowOne(){
            $sql_query_list_1_art ="SELECT $this->tbl.*, usuarios.nro_id_u AS userid, usuarios.nombre_usuario AS uno, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vfb, marcas.nombre AS bno, divisas.abr AS cab FROM $this->tbl INNER JOIN usuarios ON a_vender.vendedor = usuarios.nro_id_u INNER JOIN registros ON a_vender.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON a_vender.divisa_precio = divisas.id_moneda WHERE id_art_venta=$this->id_art_venta";
            $rt_db = mysqli_query($this->conn, $sql_query_list_1_art);
            
            $res = mysqli_fetch_assoc($rt_db);
            
            if($res){
                $o = new Sellable();
                
                // Base
                $o->id_art_venta = $res["id_art_venta"];
                $o->id_reg_veh = $res["id_reg_veh"];
                $o->divisa_precio = $res["divisa_precio"];
                $o->valor_venta = $res["valor_venta"];
                $o->momento_pub = $res["momento_pub"];
                $o->detalles = $res["detalles"];
                $o->vendedor = $res["vendedor"];
                
                // Joins
                $o->userid = $res["userid"];
                $o->uno = $res["uno"];
                $o->vmo = $res["vmo"];
                $o->vfb = $res["vfb"];
                $o->bno = $res["bno"];
                $o->cab = $res["cab"];
                
                $rt_one_art = $o;
            }
            else{
                $rt_one_art = null;
            }
            
            return $rt_one_art;
        }
        
        public function ART_UpdateOne(){
            $sql_query_upd_1_art = "UPDATE $this->tbl SET id_reg_veh=$this->id_reg_veh, divisa_precio=$this->divisa_precio, valor_venta=$this->valor_venta, detalles='$this->detalles', vendedor=$this->vendedor WHERE id_art_venta=$this->id_art_venta;";
            $r = mysqli_query($this->conn, $sql_query_upd_1_art);
            
            return $r;
        }
        
        public function ART_DeleteOne(){
            $sql_query_del_1_art = "DELETE FROM $this->tbl WHERE id_art_venta=$this->id_art_venta";
            $r = mysqli_query($this->conn, $sql_query_del_1_art);
            
            return $r;
        }
    }
?>