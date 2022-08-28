<?php
	class Taxicab_Contracts{
		private $id_entrada_reg;
		private $tiempo_inicio;
		private $tiempo_fin;
		private $pago_diario_contrato;
		private $pago_horario_contrato;
		private $pago_total;
		private $remisero;
		private $contratador;
		private $divisa_cuotas;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "reg_contrato_remises";
			
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
		
		public function CON_Add(){
			$sql_query_con_reg = "INSERT INTO $this->tbl (tiempo_inicio, tiempo_fin, pago_diario_contrato, pago_horario_contrato, pago_total, remisero, contratador, divisa_cuotas) VALUES ('$this->tiempo_inicio', '$this->tiempo_fin', $this->pago_diario_contrato, $this->pago_horario_contrato, $this->pago_total, $this->remisero, $this->contratador, $this->divisa_cuotas);";
			
			$r = mysqli_query($this->conn, $sql_query_con_reg);
			
			return $r;
		}
		
		public function CON_ShowAll(){
			$sql_query_list_all_con = "SELECT * FROM $this->tbl;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_con);
			
			$arr_list_con = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Taxicab_Contracts();
				
				$o->id_entrada_reg = $res["id_entrada_reg"];
				$o->tiempo_inicio = $res["tiempo_inicio"];
				$o->tiempo_fin = $res["tiempo_fin"];
				$o->pago_diario_contrato = $res["pago_diario_contrato"];
				$o->pago_horario_contrato = $res["pago_horario_contrato"];
				$o->pago_total = $res["pago_total"];
				$o->remisero = $res["remisero"];
				$o->contratador = $res["contratador"];
				$o->divisa_cuotas = $res["divisa_cuotas"];
				
				$arr_list_con[] = $o;
			}
			return $arr_list_con;
		}
		
		public function CON_ShowAllForList(){
			$sql_query_list_all_con_select = "SELECT $this->tbl.id_entrada_reg, $this->tbl.tiempo_inicio, $this->tbl.tiempo_fin, $this->tbl.remisero, $this->tbl.contratador, registros.id_reg AS rid, registros.matricula AS reg_lp, usuarios.nombre_usuario AS uun, remises.nombres AS tna, remises.apellidos AS tsn FROM $this->tbl ";
			
			$sql_query_list_all_con_join = "INNER JOIN remises ON $this->tbl.remisero = remises.id_remise INNER JOIN registros ON remises.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON $this->tbl.divisa_cuotas = divisas.id_moneda INNER JOIN usuarios ON $this->tbl.contratador = usuarios.nro_id_u;";
			
			$sql_query_list_all_con = $sql_query_list_all_con_select.$sql_query_list_all_con_join;
			
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_con);
			
			$arr_list_con_for_list = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Taxicab_Contracts();
				
				// Base
				$o->id_entrada_reg = $res["id_entrada_reg"];
				$o->tiempo_inicio = $res["tiempo_inicio"];
				$o->tiempo_fin = $res["tiempo_fin"];
				$o->remisero = $res["remisero"];
				$o->contratador = $res["contratador"];
				
				// Joins
				$o->rid = $res["rid"];
				$o->reg_lp = $res["reg_lp"];
				$o->uun = $res["uun"];
				$o->tna = $res["tna"];
				$o->tsn = $res["tsn"];
				
				$arr_list_con_for_list[] = $o;
			}
			return $arr_list_con_for_list;
		}
		
		public function CON_ShowOne(){
			$sql_query_list_1_con_select = "SELECT $this->tbl.*, registros.id_reg AS rid, divisas.abr AS coin, usuarios.nro_id_u AS uid, usuarios.nombre_usuario AS uun, remises.nombres AS tna, remises.apellidos AS tsn FROM $this->tbl ";
			
			$sql_query_list_1_con_join = "INNER JOIN remises ON $this->tbl.remisero = remises.id_remise INNER JOIN registros ON remises.id_reg_veh = registros.id_reg INNER JOIN divisas ON $this->tbl.divisa_cuotas = divisas.id_moneda INNER JOIN usuarios ON $this->tbl.contratador = usuarios.nro_id_u ";
			
			$sql_query_list_1_con_filter = "WHERE id_entrada_reg=$this->id_entrada_reg;";
			
			$sql_query_list_1_con = $sql_query_list_1_con_select.$sql_query_list_1_con_join.$sql_query_list_1_con_filter;
			
			$ret_con_info = mysqli_query($this->conn, $sql_query_list_1_con);
			
			$res = mysqli_fetch_assoc($ret_con_info);
			
			if($res){
				$o = new Taxicab_Contracts();
				
				// Base
				$o->id_entrada_reg = $res["id_entrada_reg"];
				$o->tiempo_inicio = $res["tiempo_inicio"];
				$o->tiempo_fin = $res["tiempo_fin"];
				$o->pago_diario_contrato = $res["pago_diario_contrato"];
				$o->pago_horario_contrato = $res["pago_horario_contrato"];
				$o->pago_total = $res["pago_total"];
				$o->remisero = $res["remisero"];
				$o->contratador = $res["contratador"];
				$o->divisa_cuotas = $res["divisa_cuotas"];
				
				// Joins
				$o->rid = $res["rid"];
				$o->coin = $res["coin"];
				$o->uid = $res["uid"];
				$o->uun = $res["uun"];
				$o->tna = $res["tna"];
				$o->tsn = $res["tsn"];
				
				$arranged_con_info = $o;
			}
			else{
				$arranged_con_info = null;
			}
			return $arranged_con_info;
		}
		
		public function CON_UpdateOne(){
			$sql_query_upd_1_con = "UPDATE $this->tbl SET tiempo_inicio='$this->tiempo_inicio', tiempo_fin='$this->tiempo_fin', pago_diario_contrato=$this->pago_diario_contrato, pago_horario_contrato=$this->pago_horario_contrato, pago_total=$this->pago_total, remisero=$this->remisero, contratador=$this->contratador, divisa_cuotas=$this->divisa_cuotas WHERE id_entrada_reg=$this->id_entrada_reg;";
			$r = mysqli_query($this->conn, $sql_query_upd_1_con);
			
			return $r;
		}
		
        // This function will delete all contracts that have already expired (i.e.: current date is newer than contract end date). For date comparison tutorial, check this: < https://stackoverflow.com/questions/804193/delete-from-a-table-based-on-date >
		public function CON_DeleteAllExpired(){
            include $_SERVER["DOCUMENT_ROOT"]."/admin/shared/Utils.Gen.Time.php";

			$sql_query_del_expired_con = "DELETE FROM $this->tbl WHERE tiempo_fin <= \"".$cdt."\";";
			$r = mysqli_query($this->conn, $sql_query_del_expired_con);
			
			return $r;
		}
		
		// I find deleting one contract at a time makes little sense, it's slow and unnecessary, you'd prefer to clear all inactive contracts at once and leave the active ones out of it. This function will stop a contract by setting the end date to the current one.
		public function CON_StopOne(){
            include $_SERVER["DOCUMENT_ROOT"]."/admin/shared/Utils.Gen.Time.php";

			$sql_query_stop_1_con = "UPDATE $this->tbl SET tiempo_fin='$cdt' WHERE id_entrada_reg=$this->id_entrada_reg;";
			$r = mysqli_query($this->conn, $sql_query_stop_1_con);
			
			return $r;
		}
	}
?>