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
			//si no tengo parametros se listan los Usuarios
			session_start();
			
			switch($_REQUEST['hacer']){
				case 'agregarUsuario':
				if(!isset($_SESSION['usuario'])){
					$Usuario=$this->modelo->agregarUsuario($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/agregarUsuarioView.php');
					}else{
						include('view/View.php');
					}
					break;
				case 'buscarUsuario':
					if(isset($_SESSION['usuario'])){
					$Usuario=$this->modelo->buscarUsuario($_REQUEST['id']);
					include('view/buscarUsuarioView.php');
					}
					break;
				case 'filtrar':
					if(isset($_SESSION['usuario'])){
					$Usuario=$this->modelo->filtrarUsuario($_REQUEST['descripcion']);
					include('view/filtrarUsuarioView.php');
					}
					break;
				
				case 'modificar':
					if(isset($_SESSION['usuario'])){
					$Usuario=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/modificarUsuarioView.php');
					}
					break;
				case 'listar':
					if(isset($_SESSION['usuario'])){
						$Usuario=$this->modelo->listar() ;
						echo $_SESSION['nombre'];
						include('view/listarUsuarioView.php');
					}
					else
						echo 'sin sesion';
					break;
			}
			
		}

	}




?>
