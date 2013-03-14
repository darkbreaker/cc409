<?php
/**
*@package
*@sunpackge
*autor
*/

	class Conexion{
		public $host;
		public $user;
		public $pass;
		public $db;
		public $cn;
		
		function __construct($dbhost,$dbuser,$dbpass,$db){
			$this-> host = $dbhost;
			$this -> user = $dbuser;
			$this -> pass = $dbpass;
			$this -> db =$db;
		
		}
	
	/**
	*@return mixed objeto mysqli en caso de exito, False en caso de error
	*/
		function conecta(){
			$this -> cn = new mysqli($this->host,$this->user,$this->pass,$this->db);
			if($this->cn->connect_errno){
				return false;
			}
			else{
				return true;
			}
			
		}
		/**
		*@return mixed en caso de resultado regrese arreglo
		*/
		function consulta($query){
			$resultado = $this->cn ->query($query);
			if($this->cn->errno)
				return FALSE;
			if(is_object($resultado)){
				if($resultado->num_rows>0){
				while($fila=$resultado->fetch_assoc())
					$resultado_array[] =$fila;
				return $resultado_array;}
				
			}
			$pos = strpos($query,'INSERT');
			
			if($pos===0)
				return $this->cn -> insert_id;
			return $this->cn -> affected_rows;

		}
	
		function escapar($cn,$query){
			return $this->cn->real_scape_string($query);
	
		}
	
		function cerrar($cn){
			return $this->cn-> close();
		}
	}
	
	//web database 3 - cadenas
?>