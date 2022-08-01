<?php
    class C_Sellable{
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
            $this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
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

		public function CSL_ListAllPub(){
			$sql_query_filter_veh = "SELECT $this->tbl.*, divisas.abr AS cab, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vyf, vehiculos.categorizacion AS vca, marcas.nombre AS bna FROM $this->tbl INNER JOIN divisas ON $this->tbl.divisa_precio = divisas.id_moneda INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno;";
			$rt_db = mysqli_query($this->conn, $sql_query_filter_veh);

			$arr_list_pubveh = null;

			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Sellable();

                // Base
                $o->id_art_venta = $res["id_art_venta"];
                $o->id_reg_veh = $res["id_reg_veh"];
                $o->divisa_precio = $res["divisa_precio"];
                $o->valor_venta = $res["valor_venta"];
                $o->momento_pub = $res["momento_pub"];
                $o->detalles = $res["detalles"];
                $o->vendedor = $res["vendedor"];

                // Joins
                $o->cab = $res["cab"];  // <--- Currency short name.
                $o->vmo = $res["vmo"];  // <--- Vehicle model.
                $o->vyf = $res["vyf"];  // <--- Vehicle year of fabrication.
                $o->vca = $res["vca"];  // <--- Vehicle category.
                $o->bna = $res["bna"];  // <--- Brand name.

                $arr_list_pubveh[] = $o;
			}

            return $arr_list_pubveh;
		}

		public function CSL_ArticleDetails(){
			$sql_query_artdtl = "SELECT $this->tbl.*, divisas.abr AS cab, vehiculos.modelo AS vmo, vehiculos.anho_fab AS vyf, vehiculos.categorizacion AS vca, vehiculos.puertas AS vdo, vehiculos.transmision AS vtr, vehiculos.combustible_tipo AS vft, vehiculos.combustible_capac AS vfc, vehiculos.motor AS ven, marcas.nombre AS bna, usuarios.nro_id_u AS userid, usuarios.nombre_usuario AS uun FROM $this->tbl INNER JOIN divisas ON $this->tbl.divisa_precio = divisas.id_moneda INNER JOIN registros ON $this->tbl.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN usuarios ON $this->tbl.vendedor = usuarios.nro_id_u WHERE id_art_venta = $this->id_art_venta;";
			$rt_db = mysqli_query($this->conn, $sql_query_artdtl);

			$arr_list_pubveh = null;

			if($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Sellable();

                // Base
                $o->id_art_venta = $res["id_art_venta"];
                $o->id_reg_veh = $res["id_reg_veh"];
                $o->divisa_precio = $res["divisa_precio"];
                $o->valor_venta = $res["valor_venta"];
                $o->momento_pub = $res["momento_pub"];
                $o->detalles = $res["detalles"];
                $o->vendedor = $res["vendedor"];

                // Joins
                $o->cab = $res["cab"];        // <--- Currency short name.
                $o->vmo = $res["vmo"];        // <--- Vehicle model.
                $o->vyf = $res["vyf"];        // <--- Vehicle year of fabrication.
                $o->vca = $res["vca"];        // <--- Vehicle category.
                $o->vdo = $res["vdo"];        // <--- Vehicle doors count.
                $o->vtr = $res["vtr"];        // <--- Vehicle transmission.
                $o->vft = $res["vft"];        // <--- Vehicle fuel type.
                $o->vfc = $res["vfc"];        // <--- Vehicle fuel capacity.
                $o->ven = $res["ven"];        // <--- Vehicle engine.
                $o->bna = $res["bna"];        // <--- Brand name.
                $o->userid = $res["userid"];  // <--- User ID.
                $o->uun = $res["uun"];        // <--- Username.

                $arr_list_pubveh = $o;
			}

            return $arr_list_pubveh;
		}

        // TODO: planned function to filter vehicles based on a price range. Unused for now.
		public function CSL_GetVehByCostRng($lower_end,$higher_end,$currency_identifier){
			$sql_query_filter_veh = "SELECT * FROM $this->tbl WHERE valor_venta >= ".$lower_end." AND valor_venta <= ".$higher_end." AND divisa_precio = ".$currency_identifier;
			$rt_db = mysqlii_query($this->conn, $sql_query_filter_veh);

			$arr_list_filtered_veh_list = null;

			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new C_Sellable();

                $o->id_art_venta = $res["id_art_venta"];
                $o->id_reg_veh = $res["id_reg_veh"];
                $o->divisa_precio = $res["divisa_precio"];
                $o->valor_venta = $res["valor_venta"];
                $o->momento_pub = $res["momento_pub"];
                $o->detalles = $res["detalles"];
                $o->vendedor = $res["vendedor"];
			}
		}
    }
?>