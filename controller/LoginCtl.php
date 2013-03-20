<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBss.php');
	class LoginCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo usuario
		function __construct(){
			$this->modelo = new usuarioBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los usuarios
			$usuario=$this->modelo->login($_REQUEST['usuario'],$_REQUEST['password']);
			
			
		}

	}




?>