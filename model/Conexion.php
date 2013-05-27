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
		
		function __construct(){
		
		/*	$this-> host = 'localhost';
			$this -> user = 'cc409_perros';
			$this -> pass = '1owYjeJy8a';
			$this -> db ='cc409_perros';*/
		
			$this-> host = 'localhost';
			$this -> user = 'root';
			$this -> pass = 'root';
			$this -> db = 'cc409_perros';
		
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
		function consulta($con){
			$resultado = $this->cn ->query($con);
			if($this->cn->errno){
				return FALSE;}
			if(is_object($resultado)){
				return $resultado;
				if($resultado->num_rows>0){
					while($fila=$resultado->fetch_assoc())
						$resultado_array[] =$fila;
					return $resultado_array;
				}else
					return FALSE;
				
			}
			
				return $this->cn -> insert_id;
			

		}
	
		function escapar($query){
			
			return $this->cn->real_escape_string($query);
	
		}
	
		function cerrar(){
			return $this->cn->close();
		}
	}
	
	//web database 3 - cadenas
?>