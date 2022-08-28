<?php
	class Client{
		private $nro_id_u;
		private $nombre;
		private $apellidos;
		private $nombre_usuario;
		private $clave;
		private $cedula_identidad;
		private $email;
		private $residencia_actual;
		private $tel_cel;
		private $tel_fijo;
		private $momento_registro;
		private $cargo_en_sitio;
		
		private $conn;
		private $tbl;
		
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_cli","t@*%k77Sx#!T9t93","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "usuarios";
			
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

		public function PUBCLI_VerifyUsernameAvail($compare_param){
			$sql_query_un_lookup = "SELECT nombre_usuario FROM $this->tbl;";
			
			$ret_un_list = mysqli_query($this->conn, $sql_query_un_lookup);
			
			$un_entries = array();
			
			while($un_entry = mysqli_fetch_array($ret_un_list, MYSQLI_NUM))
				$un_entries[] = $un_entry;
			
			foreach($un_entries as $c){
				if($c[0] == $compare_param) return $ret_compare_result = true;
				else $ret_compare_result = false;
			}
			
			return $ret_compare_result;
		}

		public function PUBCLI_RegAcc(){
			$sql_query_reg_cli = "INSERT INTO $this->tbl (nombre, apellidos, nombre_usuario, clave, cedula_identidad, email, residencia_actual, tel_cel, tel_fijo, momento_registro, cargo_en_sitio) VALUES ('$this->nombre', '$this->apellidos', '$this->nombre_usuario', '$this->clave', '$this->cedula_identidad', '$this->email', '$this->residencia_actual', '$this->tel_cel', '$this->tel_fijo', '$this->momento_registro', 2);";
			
			$r = mysqli_query($this->conn, $sql_query_reg_cli);
			
			return $r;
		}

		public function PUBCLI_ShowTheirInfo(){
			$sql_query_list_1_cli = "SELECT * FROM $this->tbl WHERE nro_id_u=$this->nro_id_u";
			
			$retorno = mysqli_query($this->conn, $sql_query_list_1_cli);
			
			$res = mysqli_fetch_assoc($retorno);
			
			// If a client with this ID was found, return its info in an array, otherwise returns null content.
			if($res){
				$o = new Client();
				
				$o->nro_id_u = $res["nro_id_u"];
				$o->nombre = $res["nombre"];
				$o->apellidos = $res["apellidos"];
				$o->nombre_usuario = $res["nombre_usuario"];
				$o->clave = $res["clave"];
				$o->cedula_identidad = $res["cedula_identidad"];
				$o->email = $res["email"];
				$o->residencia_actual = $res["residencia_actual"];
				$o->tel_cel = $res["tel_cel"];
				$o->tel_fijo = $res["tel_fijo"];
				$o->momento_registro = $res["momento_registro"];
				$o->cargo_en_sitio = $res["cargo_en_sitio"];
				
				$cli_info_r = $o;
			}
			else $cli_info_r = null;
			
			return $cli_info_r;
		}
		
		public function PUBCLI_EditTheirInfo(){
			$sql_query_upd_1u = "UPDATE $this->tbl SET nombre='$this->nombre', apellidos='$this->apellidos', cedula_identidad='$this->cedula_identidad', email='$this->email', residencia_actual='$this->residencia_actual', tel_cel='$this->tel_cel', tel_fijo='$this->tel_fijo' WHERE nro_id_u=$this->nro_id_u;";
			
			$r = mysqli_query($this->conn, $sql_query_upd_1u);
			
			return $r;
		}
		
		// I feel it's best to edit access credentials separately, since username availability needs to be checked, and also, change session data to reflect the new username. Old password also needs to be verified.
		public function PUBCLI_AlterAccessCredentials($changing_username = false){
			if($changing_username == true)
				$username_availability = PUBCLI_VerifyUsernameAvail($this->nombre_usuario);
			
			$r = null;
			$got_old_pwd = false;

			$old_pwd = mysqli_query($this->conn, "SELECT clave FROM $this->tbl WHERE nro_id_u = $this->nro_id_u;");

			if($old_pwd == $this->clave)
				$got_old_pwd = true;

			if($username_availability == true && $got_old_pwd == true){
				$sql_query_upd_1u_ac = "UPDATE $this->tbl SET nombre_usuario='$this->nombre_usuario', clave='$this->clave' WHERE nro_id_u=$this->nro_id_u";
				$r = mysqli_query($this->conn, $sql_query_upd_ac);

				$_SESSION["client_id"] = $this->nombre_usuario;
			}
			
			if($changing_username == false && $got_old_pwd == true){
				$sql_query_upd_1u_ac = "UPDATE $this->tbl SET clave='$this->clave' WHERE nro_id_u=$this->nro_id_u";
				$r = mysqli_query($this->conn, $sql_query_upd_ac);
			}

			if($got_old_pwd == false)
				$r = "err_wrong_old_pwd";
			
			return $r;
		}
		
		public function PUBCLI_LoginDataCheck(){
			$sql_query_find_cli = "SELECT nro_id_u, nombre_usuario, clave, cargo_en_sitio FROM $this->tbl WHERE nombre_usuario='$this->nombre_usuario' AND clave='$this->clave' AND cargo_en_sitio=2;";
			
			$r_cli_find = mysqli_query($this->conn, $sql_query_find_cli);
			
			$res = mysqli_fetch_assoc($r_cli_find);
			
			if($res){
				$o = new Client();
				
				$o->nro_id_u = $res["nro_id_u"];
				$o->nombre_usuario = $res["nombre_usuario"];

				$r_cli_tk = $o;
			}
			else $r_cli_tk = null;

			return $r_cli_tk;
		}
	}
?>