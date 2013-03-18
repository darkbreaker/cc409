<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBss.php');
	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Usuario
		function __construct(){
			$this->modelo = new UsuarioBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Usuarios
			if(!isset($_REQUEST['accion']) ){
				$Usuario = $this->modelo-> listar();
				//vista del resultado
				include('view/listarUsuarioView.php');
			} else switch($_REQUEST['accion']){
				case 'agregarUsuario':
					$Usuario=$this->modelo->agregarUsuario($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/agregarUsuarioView.php');
					break;
				case 'consultarUsuario':
					$Usuario=$this->modelo->consultarUsuario($_REQUEST['id']);
					include('view/consultarUsuarioView.php');
					break;
				case 'filtrar':
				$Usuario=$this->modelo->filtrarUsuario($_REQUEST['descripcion']);
					include('view/filtrarUsuarioView.php');
					break;
				case 'modificar':
					$Usuario=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/modificarUsuarioView.php');
					break;
				case 'listar':
					$Usuario=$this->modelo->listar() ;
					include('view/listarUsuarioView.php');
					break;
			}
			
		}

	}




?>
