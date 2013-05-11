<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBSS.php');
include_once('ModeloCtl.php');
	class UsuarioCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Usuario
		function __construct(){
			$this->modelo = new UsuarioBSS();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Usuarios
			session_start();
			$hacer=$_REQUEST['hacer'];
			$id=$_REQUEST['id'];
			$nombre=$_REQUEST['nombre'];
			$descripcion=$_REQUEST['descripcion'];
			$email=$_REQUEST['email'];
			$password=$_REQUEST['password'];
            $calle=$_REQUEST['calle'];
			$telefono=$_REQUEST['telefono'];
			
			switch($hacer){
				case 'agregarUsuario':
				if(!isset($_SESSION['usuario'])){
					$Usuario=$this->modelo->agregarUsuario($nombre, $email, $password, $calle, $telefono) ;
					include('view/agregarUsuarioView.php');
					}else{
						include('view/View.php');
					}
					break;
				case 'buscarUsuario':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']>0){
					$Usuario=$this->modelo->buscarUsuario($id);
					include('view/buscarUsuarioView.php');
					}
					}
					break;
				case 'filtrar':
					if(isset($_SESSION['usuario'])){
							if($_SESSION['privilegio']>0){
							$Usuario=$this->modelo->filtrarUsuario($descripcion);
							include('view/filtrarUsuarioView.php');
							}
					}
					break;
				
				case 'modificar':
					if(isset($_SESSION['usuario'])){
			
							$Usuario=$this->modelo->modificar($nombre, $telefono, $calle, $password, $mail, $_SESSION['usuario'])) ;
							include('view/modificarUsuarioView.php');
					}
					break;
				case 'listar':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']>0){
							$Usuario=$this->modelo->listar() ;
							echo $_SESSION['nombre'];
							include('view/listarUsuarioView.php');
						}
					}
					else
						echo 'sin sesion';
					break;
			}
			
		}

		
		
	}




?>
