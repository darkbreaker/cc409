<?php
  class Usuario{
		public $id;
		public $nombre;
		public $telefono;
		public $direccion;
		public $password;
		public $tipo;
		public $email;
		
			function __construct($id, $nombre, $telefono, $direccion, $password, $tipo, $mail){
			$this-> id = $id;
			$this -> nombre = $nombre;
			$this -> telefono = $telefono;
			$this -> direccion = $direccion;
			$this -> password = $password;
			$this -> tipo= $tipo;	
			$this -> email= $email;	
                   
		}

	}
?>
