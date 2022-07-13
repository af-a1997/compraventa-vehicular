<?php
	class Users{
		// Attributes for this class.
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
		private $cargo_en_sitio;
		
		private $conn;
		private $tbl;
		
		// Constructor: function to run when class is instanced. In this case, opens a connection with the database.
		public function __construct(){
			$this->conn = mysqli_connect("localhost","cmman_admin","#V!c2bMr69xo!8%A","gestion_veh") or die ("Hubo un fallo al conectarse a la BBDD, conexión abortada.");
			$this->tbl = "usuarios";
			
			mysqli_set_charset($this->conn,"utf8");
		}

		// Destructor: function to run when class instance is finished. In this case, closes connection with database.
		public function __destruct(){
			unset($this->link);
		}
		
		// Getters and setters used for all functions in this class.
		public function __get($key){
			return $this->$key;
		}
		public function __set($key, $value){
			return $this->$key = $value;
		}
		
		// Register a client
		public function CLI_Reg(){
			$sql_query_cli_reg = "INSERT INTO $this->tbl (nombre, apellidos, nombre_usuario, clave, cedula_identidad, email, residencia_actual, tel_cel, tel_fijo, cargo_en_sitio) VALUES ('$this->nombre', '$this->apellidos', '$this->nombre_usuario', '$this->clave', '$this->cedula_identidad', '$this->email', '$this->residencia_actual', '$this->tel_cel', '$this->tel_fijo', $this->cargo_en_sitio);";
			
			$r = mysqli_query($this->conn, $sql_query_cli_reg);
			return $r;
		}
		
		// List all clients by running a query on the database, return its result and convert it into a 2D array that can be easily manipulated.
		public function CLI_ShowAll(){
			$sql_query_list_all_cli = "SELECT $this->tbl.*, puesto.id_puesto, puesto.nombre FROM $this->tbl INNER JOIN puesto ON usuarios.cargo_en_sitio = puesto.id_puesto;";
			$rt_db = mysqli_query($this->conn, $sql_query_list_all_cli);
			
			$arr_list_users = null;
			
			while($res = mysqli_fetch_assoc($rt_db)){
				$o = new Users();
				
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
				$o->cargo_en_sitio = $res["cargo_en_sitio"];
				
				$arr_list_users[] = $o;
			}
			return $arr_list_users;
		}
		
		// Shows the info for only one client, works the same way as the function above.
		public function CLI_Show_one(){
			$sql_query_list_1_cli ="SELECT * FROM $this->tbl WHERE nro_id_u=$this->nro_id_u";
			$retorno = mysqli_query($this->conn, $sql_query_list_1_cli);
			
			$res = mysqli_fetch_assoc($retorno);
			
			// If a client with this ID was found, return its info in an array, otherwise returns null content.
			if($res){
				$o = new Users();
				
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
				$o->cargo_en_sitio = $res["cargo_en_sitio"];
				
				$cli_info_r = $o;
			}
			else{
				$cli_info_r = null;
			}
			return $cli_info_r;
		}
		
		/*
		 * Edit only one client.
		 *
		 * In a system I previously made, I had to make a separate function for when the user doesn't need to have their profile picture update, since this feature isn't planned, only one function has been made.
		 */
		public function CLI_edit_one(){
			$sql_query_upd_1u = "UPDATE $this->tbl SET nombre='$this->nombre', apellidos='$this->apellidos', nombre_usuario='$this->nombre_usuario', clave='$this->clave', cedula_identidad=$this->cedula_identidad, 'email=$this->email', 'residencia_actual=$this->residencia_actual', 'tel_cel='$this->tel_cel', tel_fijo='$this->tel_fijo', cargo_en_sitio=$this->cargo_en_sitio WHERE nro_id_u=$this->nro_id_u";
			$r = mysqli_query($this->conn, $sql_query_upd_1u);
			
			return $r;
		}
		
		// Remove information of one client.
		public function CLI_remove_one(){
			// TODO: handle potential database relation issues if client is referenced elsewhere.
			
			$sql_query_del_1u = "DELETE FROM $this->tbl WHERE nro_id_u=$this->nro_id_u";
			$r = mysqli_query($this->conn, $sql_query_del_1u);
			
			return $r;
		}
		
		// Function required to find an admin, used to check the credentials the user is inputting are valid.
		public function ADM_login(){
			$sql_find_admin ="SELECT * FROM $this->tbl WHERE nombre_usuario='$this->nombre_usuario' AND clave='$this->clave' AND cargo_en_sitio=1;";
			$r_adm_find = mysqli_query($this->conn, $sql_find_admin);
			
			$res = mysqli_fetch_assoc($r_adm_find);
			
			// If admin was found and all info is valid, the database should be returning a single record, otherwise returns nothing, the error is handled in the log-in screen and the message shown client-side.
			if($res){
				$o = new Users();
				
				$o->nro_id_u = $res["nro_id_u"];
				$r_adm_tk = $o;
			}
			else{
				$r_adm_tk = null;
			}
			return $r_adm_tk;
		}
	}
?>