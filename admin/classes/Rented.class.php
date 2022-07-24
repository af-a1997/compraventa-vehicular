<?php
	class Rented{
		// Notice: class [Rented] is for the register of rented vehicles, [Rentable] is for vehicles available for rent.
		private $id_hst_alq;
		private $momento_alquilado;
		private $momento_devolucion;
		private $estado_alquiler;
		private $id_veh_alquilado;
		private $no_cli;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "historial_alquiler";
			
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
		
		public function RHI_Add(){
			$sql_query_rhi_reg = "INSERT INTO $this->tbl (momento_alquilado, momento_devolucion, id_veh_alquilado, no_cli) VALUES ('$this->momento_alquilado', '$this->momento_devolucion', $this->id_veh_alquilado, $this->no_cli);";
			
			$r = mysqli_query($this->conn, $sql_query_rhi_reg);
			
			return $r;
		}
		
		public function RHI_ShowAll(){
			$sql_query_list_all_rhi = "SELECT * FROM $this->tbl;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_rhi);
			
			$arr_list_rhi = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Rented();
				
				$o->id_hst_alq = $res["id_hst_alq"];
				$o->momento_alquilado = $res["momento_alquilado"];
				$o->momento_devolucion = $res["momento_devolucion"];
				$o->estado_alquiler = $res["estado_alquiler"];
				$o->id_veh_alquilado = $res["id_veh_alquilado"];
				$o->no_cli = $res["no_cli"];
				
				$arr_list_rhi[] = $o;
			}
			return $arr_list_rhi;
		}
		
		public function RHI_ShowAllForList(){
			$sql_query_list_all_rhi_select = "SELECT historial_alquiler.*, registros.matricula AS reg_lp, vehiculos.modelo AS veh_mod, vehiculos.anho_fab AS veh_yfb, marcas.nombre AS bnd_name, seleccion_alquiler.valor_diario_alq AS ren_cost, divisas.abr AS coin, usuarios.nro_id_u AS uid, usuarios.nombre_usuario AS uun FROM historial_alquiler ";
			
			$sql_query_list_all_rhi_join = "INNER JOIN seleccion_alquiler ON historial_alquiler.id_veh_alquilado = seleccion_alquiler.id_art_alq INNER JOIN registros ON seleccion_alquiler.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON seleccion_alquiler.id_divisa = divisas.id_moneda INNER JOIN usuarios ON historial_alquiler.no_cli = usuarios.nro_id_u;";
			
			$sql_query_list_all_rhi = $sql_query_list_all_rhi_select.$sql_query_list_all_rhi_join;
			
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_rhi);
			
			$arr_list_rhi_for_list = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Rented();
				
				// Base table items
				$o->id_hst_alq = $res["id_hst_alq"];
				$o->momento_alquilado = $res["momento_alquilado"];
				$o->momento_devolucion = $res["momento_devolucion"];
				$o->estado_alquiler = $res["estado_alquiler"];
				$o->id_veh_alquilado = $res["id_veh_alquilado"];
				$o->no_cli = $res["no_cli"];
				
				// Aliases for items on other tables
				$o->reg_lp = $res["reg_lp"];
				$o->veh_mod = $res["veh_mod"];
				$o->veh_yfb = $res["veh_yfb"];
				$o->bnd_name = $res["bnd_name"];
				$o->ren_cost = $res["ren_cost"];
				$o->coin = $res["coin"];
				$o->uid = $res["uid"];
				$o->uun = $res["uun"];
				
				$arr_list_rhi_for_list[] = $o;
			}
			return $arr_list_rhi_for_list;
		}
		
		public function RHI_ShowOne(){
			$sql_query_list_1rhi_select = "SELECT historial_alquiler.*, registros.matricula AS reg_lp, vehiculos.modelo AS veh_mod, vehiculos.anho_fab AS veh_yfb, marcas.nombre AS bnd_name, seleccion_alquiler.valor_diario_alq AS ren_cost, divisas.abr AS coin, usuarios.nro_id_u AS uid, usuarios.nombre_usuario AS uun FROM historial_alquiler ";
			
			$sql_query_list_1rhi_join = "INNER JOIN seleccion_alquiler ON historial_alquiler.id_veh_alquilado = seleccion_alquiler.id_art_alq INNER JOIN registros ON seleccion_alquiler.id_reg_veh = registros.id_reg INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno INNER JOIN marcas ON vehiculos.marca = marcas.idno INNER JOIN divisas ON seleccion_alquiler.id_divisa = divisas.id_moneda INNER JOIN usuarios ON historial_alquiler.no_cli = usuarios.nro_id_u ";
			
			$sql_query_list_1rhi_filter = "WHERE id_hst_alq=$this->id_hst_alq;";
			
			$sql_query_list_1rhi = $sql_query_list_1rhi_select.$sql_query_list_1rhi_join.$sql_query_list_1rhi_filter;
			
			$ret_rhi_info = mysqli_query($this->conn, $sql_query_list_1rhi);
			
			$res = mysqli_fetch_assoc($ret_rhi_info);
			
			if($res){
				$o = new Rented();
				
				// Base table items
				$o->id_hst_alq = $res["id_hst_alq"];
				$o->momento_alquilado = $res["momento_alquilado"];
				$o->momento_devolucion = $res["momento_devolucion"];
				$o->estado_alquiler = $res["estado_alquiler"];
				$o->id_veh_alquilado = $res["id_veh_alquilado"];
				$o->no_cli = $res["no_cli"];
				
				// Aliases for items on other tables
				$o->reg_lp = $res["reg_lp"];
				$o->veh_mod = $res["veh_mod"];
				$o->veh_yfb = $res["veh_yfb"];
				$o->bnd_name = $res["bnd_name"];
				$o->ren_cost = $res["ren_cost"];
				$o->coin = $res["coin"];
				$o->uid = $res["uid"];
				$o->uun = $res["uun"];
				
				$arranged_rhi_info = $o;
			}
			else{
				$arranged_rhi_info = null;
			}
			return $arranged_rhi_info;
		}
		
		public function RHI_UpdateOne(){
			$sql_query_upd_1rhi = "UPDATE $this->tbl SET momento_alquilado='$this->momento_alquilado', momento_devolucion='$this->momento_devolucion', estado_alquiler=$this->estado_alquiler, id_veh_alquilado=$this->id_veh_alquilado, no_cli=$this->no_cli WHERE id_hst_alq=$this->id_hst_alq;";
			$r = mysqli_query($this->conn, $sql_query_upd_1rhi);
			
			return $r;
		}
		
		public function RHI_StopRental(){
			$sql_query_upd_1rhi = "UPDATE $this->tbl SET estado_alquiler=$this->estado_alquiler WHERE id_hst_alq=$this->id_hst_alq";
			$r = mysqli_query($this->conn, $sql_query_upd_1rhi);
			
			return $r;
		}
		
		public function RHI_DeleteOne(){
			$sql_query_del_1rhi = "DELETE FROM $this->tbl WHERE id_hst_alq=$this->id_hst_alq;";
			$r = mysqli_query($this->conn, $sql_query_del_1rhi);
			
			return $r;
		}
	}
?>