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
				include('view/UsuarioView.php');
			} else switch($_REQUEST['accion']){
				case 'insertar':
					$Usuario=$this->modelo->agregarUsuario($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/UsuarioView.php');
					break;
				case 'buscar':
					$Usuario=$this->modelo->consultarUsuario($_REQUEST['id']);
					include('view/UsuarioView.php');
					break;
				case 'filtro':
				$Usuario=$this->modelo->filtrarUsuario($_REQUEST['descripcion']);
					include('view/UsuarioView.php');
					break;
				case 'modificar':
					$Usuario=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/UsuarioView.php');
					break;
				case 'listar':
					$Usuario=$this->modelo->listar($_REQUEST['id']$_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['tipo'],$_REQUEST['email']) ;
					include('view/UsuarioView.php');
					break;
			}
			
		}

	}




?>
