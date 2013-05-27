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
			$id=$this->EsId($_REQUEST['id']);
	
			$nombre=$this->EsNombre($_REQUEST['nombre']);
			$descripcion=$_REQUEST['descripcion'];
			$email=$this->EsMail($_REQUEST['email']);
			$password=$_REQUEST['password'];
            $calle=$this->EsCalle($_REQUEST['calle']);
			$telefono=$this->EsTelefono($_REQUEST['telefono']);
			
			if(!isset($hacer)){
				if(!isset($_SESSION['usuario'])){
						
						include('view/Registro.html');
					}
				else{
						$file = file_get_contents('view/Modificar.html'); //cargo el archivo
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file);
						$file = str_ireplace('>Login<','>Log out<' , $file);
						echo $file;
						}
			
			}
			else
			switch($hacer){
				case 'agregarUsuario':
			
					
					if(!isset($_SESSION['usuario'])){
							$Usuario=$this->modelo->agregarUsuario($nombre, $email, $password, $calle, $telefono);
						if($Usuario==true)
							include_once('view/Login.html');
						else
							include_once('view/Registro.html');
					}
					else{
						$Usuario=$this->modelo->buscarUsuario($_SESSION['usuario']);
						include('view/Login.html');
						}
				
					
					break;
				case 'buscarUsuario':
					if(isset($_SESSION['usuario'])){
					$Usuario=$this->modelo->buscarUsuario($_SESSION['usuario']);
					echo json_encode($Usuario);
					}
					else
						include_once('view/Index.html');
					break;
				case 'filtrar':
					if(isset($_SESSION['usuario'])){
							if($_SESSION['privilegio']>0){
							$Usuario=$this->modelo->filtrarUsuario($descripcion);
							include('view/BuscarUsuario.html');
							}else
								include('view/Index.html');
					}else
						include('view/Index.html');
					break;
				
				case 'modificar':
					/*if(!$nombre||!$telefono||!$calle||!$password||!$mail){
					
						$file = file_get_contents('view/Index.html'); //cargo el archivo
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); //tomo {titulo} y lo reemplazo por lo que quiera
						echo $file;
					}
						
					else{*/
							$Usuario=$this->modelo->modificar($nombre, $telefono, $calle, $password, $mail, $_SESSION['usuario']) ;
							
							$file = file_get_contents('view/Index.html'); //cargo el archivo
							$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
							$file = str_ireplace('>Buscar<','>Cambios hechos<' , $file); 
							echo $file;
				//	}
					
					break;
				case 'listar':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']>0){
							$Usuario=$this->modelo->listar() ;
							echo $_SESSION['nombre'];
							include('view/Consultas.html');
						}else
							include('view/Index.html');
					}
					else
						include('view/Index.html');
					break;
				case 'perfil':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']==0){
							$file = file_get_contents('view/PerfilUsuario.html'); //cargo el archivo
							$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
							$file = str_ireplace('>Buscar<','>Cambios hechos<' , $file); 
							echo $file;
						}else
							{
							$file = file_get_contents('view/PerfilAdmin.html'); //cargo el archivo
							$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
							$file = str_ireplace('>Buscar<','>Cambios hechos<' , $file); 
							echo $file;
							
							}
					}
					else
						include('view/Index.html');
					break;
				default:
					if(isset($_SESSION['usuario'])){
						$file = file_get_contents('view/Index.html'); //cargo el archivo
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); //tomo {titulo} y lo reemplazo por lo que quiera
						echo $file;}
					else
						include('view/Index.html');
			} //fin del switch
			
		} //fin de la funcion

		
		
	}	//fin de la clase




?>
