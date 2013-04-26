<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBSS.php');
	class UsuarioCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Usuario
		function __construct(){
			$this->modelo = new UsuarioBSS();
		}

		function ejecutar(){
			include('view/View.php');
			
			
		}

	}




?>
