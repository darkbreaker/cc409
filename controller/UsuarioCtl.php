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

		function ejecutar(){ session_start();
			
			if(!isset($_REQUEST['hacer'])){
				if(!isset($_SESSION['usuario'])){
						$file = file_get_contents('view/Registro.html');
						$file = str_ireplace('{Username}','Sin sesion' , $file); $file = str_ireplace('>Citas<','><' , $file);
						echo $file;
					}
				else{
						$file = file_get_contents('view/Modificar.html'); //cargo el archivo
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file);
						$file = str_ireplace('>Login<','>Log out<' , $file);
						echo $file;
						}
			
			}
			else
			switch($_REQUEST['hacer']){
				case 'agregarUsuario':
					$nombre=$this->EsNombre($_REQUEST['nombre']);
					$email=$this->EsMail($_REQUEST['email']);
					$password=$_REQUEST['password'];
					$calle=$this->EsCalle($_REQUEST['calle']);
					$telefono=$this->EsTelefono($_REQUEST['telefono']);
					if(!$nombre||!$telefono||!$calle||!$mail){
						$file = file_get_contents('view/Index.html'); 
						$file = str_ireplace('{Username}','Sin sesion' , $file); $file = str_ireplace('>Citas<','><' , $file); 
						echo $file;
					}else if(!isset($_SESSION['usuario'])){
							$Usuario=$this->modelo->agregarUsuario($nombre, $email, $password, $calle, $telefono);
							$file = file_get_contents('view/Login.html'); 
							$file = str_ireplace('{Username}','Sin sesion' , $file); $file = str_ireplace('>Citas<','><' , $file);
							echo $file;
					}
					break;
				case 'buscarUsuario':
					if(isset($_SESSION['usuario'])){
						$Usuario=$this->modelo->buscarUsuario($_SESSION['usuario']);
						echo json_encode($Usuario);
					}
	
					break;
				case 'filtrar':
					$descripcion=$_REQUEST['descripcion'];
					if(isset($_SESSION['usuario'])){
							if($_SESSION['privilegio']>0){
								$Usuario=$this->modelo->filtrarUsuario($descripcion);
								echo $Usuario;
							}
					}
					break;
				
				case 'modificar':
					if(isset($_SESSION['usuario'])){
							$nombre=$this->EsNombre($_REQUEST['nombre']);
							$email=$this->EsMail($_REQUEST['email']);
							$password=$_REQUEST['password'];
							$calle=$this->EsCalle($_REQUEST['calle']);
							$telefono=$this->EsTelefono($_REQUEST['telefono']);
							if(!$nombre||!$telefono||!$calle||!$mail){
							
								$file = file_get_contents('view/Index.html'); 
								$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); 
								$file = str_ireplace('>Login<','>Log out<' , $file); 
								echo $file;
							}else{
									$Usuario=$this->modelo->modificar($nombre, $telefono, $calle, $password, $mail, $_SESSION['usuario']) ;
									$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file);
									$file = str_ireplace('>Login<','>Log out<' , $file); 
									$file = str_ireplace('>Hola<','>Cambios hechos<' , $file); 
									echo $file;
							} 
					}else{
						$file = file_get_contents('view/Login.html');
						$file = str_ireplace('{Username}','Sin sesion' , $file); $file = str_ireplace('>Citas<','><' , $file);
						echo $file;
						}
					break;
				case 'listar':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']>0){
							$Usuario=$this->modelo->listar() ;
							echo $Usuario;
						}
						}
					break;
				case 'perfil':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']==0){
							$file = file_get_contents('view/PerfilUsuario.html'); 
							$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); 
							$file = str_ireplace('>Login<','>Log out<' , $file); 
							echo $file;
						}else
							{
							$file = file_get_contents('view/PerfilAdmin.html'); //cargo el archivo
							$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file);
							$file = str_ireplace('>Login<','>Log out<' , $file); 
							echo $file;
							
							}
					}
					else{
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('{Username}','sin sesion',$file); 
						$file = str_ireplace('<h5>Hola</h5>','Requiere Iniciar sesion',$file);
						echo $file;
					}
					break;
				default:
					if(isset($_SESSION['usuario'])){
						$file = file_get_contents('view/Index.html'); //cargo el archivo
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); 
						$file = str_ireplace('>Login<','>Log out<' , $file); 
						echo $file;}
					else{
						$file = file_get_contents('view/Index.html'); 
						$file = str_ireplace('{Username}','sin sesion',$file); 
						echo $file;}
			} //fin del switch
			
		} //fin de la funcion

		
		
	}	//fin de la clase




?>
