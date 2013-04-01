<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBss.php');
	class UsuarioCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Usuario
		function __construct(){
			$this->modelo = new UsuarioBss();
		}

		function ejecutar(){
			include('view/View.php');
			
			
		}

	}




?>
