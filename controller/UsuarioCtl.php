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
			$id=EsId($_REQUEST['id']);
			$nombre=EsNombre($_REQUEST['nombre']);
			$descripcion=$_REQUEST['descripcion'];
			$email=EsMail($_REQUEST['email']);
			$password=$_REQUEST['password'];
            $calle=EsCalle($_REQUEST['calle']);
			$telefono=EsTelefono($_REQUEST['telefono']);
			
			switch($hacer){
				case 'agregarUsuario':
				if(!isset($_SESSION['usuario'])||!$nombre||!$email||!$password||!$calle||!$telefono){
					$Usuario=$this->modelo->agregarUsuario($nombre, $email, $password, $calle, $telefono) ;
					include('view/agregarUsuarioView.php');
					}else{
						include('view/Index.html');
					}
					break;
				case 'buscarUsuario':
					if(isset($_SESSION['usuario'])&&$id!=false){
						if($_SESSION['privilegio']>0){
					$Usuario=$this->modelo->buscarUsuario($id);
					include('view/buscarUsuarioView.php');
					}else
						include('view/Index.html');
					}else
						include('view/Index.html');
					break;
				case 'filtrar':
					if(isset($_SESSION['usuario'])){
							if($_SESSION['privilegio']>0){
							$Usuario=$this->modelo->filtrarUsuario($descripcion);
							include('view/filtrarUsuarioView.php');
							}else
								include('view/Index.html');
					}else
						include('view/Index.html');
					break;
				
				case 'modificar':
					if(!isset($_SESSION['usuario'])||!$nombre||!$telefono||!$calle||!$password||!$mail)
						include('view/Index.html');
					else{
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
						}else
							include('view/Index.html');
					}
					else
						include('view/Index.html');
					break;
				
				default:
					include('view/Index.html');
			} //fin del switch
			
		} //fin de la funcion

		
		
	}	//fin de la clase




?>
