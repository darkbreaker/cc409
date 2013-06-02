<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBSS.php');
include_once('ModeloCtl.php');
	class LogCtl extends ModeloCtl{
		public $modelo;
		//cuando se crea el contrador crea el modelo usuario
		function __construct(){
			$this->modelo = new UsuarioBSS();
		}

		function ejecutar(){
				session_start();
				if(!isset($_REQUEST['hacer'])){
					if(!isset($_SESSION['usuario'])){
						$file = file_get_contents('view/Login.html');
						$file = str_ireplace('>{Username}<','><' , $file); 
						$file = str_ireplace('>Citas<','><' , $file);
						echo $file;
						}
					else{
						session_unset();
						//destruye sesion
						session_destroy();
						setcookie(session_name(),'',time()-1);
						
						$file = file_get_contents('view/Login.html');
						$file = str_ireplace('>{Username}<','><' , $file); 
						$file = str_ireplace('>Citas<','><' , $file);
						echo $file;
						}
					}
				else

				switch ($_REQUEST['hacer']){
					case 'in':
						if(!isset($_SESSION['usuario'])){
								
								$id=$_REQUEST['usuario'];
								$pass=$_REQUEST['pass'];
								$usuario=$this->modelo->login($id,$pass);
														
								if(isset($usuario)){
					
									$_SESSION['usuario']=$usuario['idPersona'];
									$_SESSION['nombre']=$usuario['email'];
									$_SESSION['privilegio']=$usuario['privilegios'];				
									$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
									$file = str_ireplace('>Login<','>Log out<' , $file);
									echo $file;
									
								}else{
								$file = file_get_contents('view/Login.html');
								$file = str_ireplace('>{Username}<','><' , $file); $file = str_ireplace('>Citas<','><' , $file);
								echo $file;
										}
						}else
							{
								$file = file_get_contents('view/Index.html'); 
								$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file);
								$file = str_ireplace('>Login<','>Log out<' , $file); 
								echo $file;
							}
								
						break;
					case 'out':
						if(isset($_SESSION['usuario'])){
							//limpiar session
							session_unset();
							//destruye sesion
							session_destroy();
							setcookie(session_name(),'',time()-1);
							var_dump ($_SESSION);
						}
						
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('>{Username}<','><' , $file); $file = str_ireplace('>Citas<','><' , $file);
						echo $file;
						break;
					default:
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('>{Username}<','><' , $file); $file = str_ireplace('>Citas<','><' , $file);
						echo $file;
				}	// fin del switch

		}// fin de la funcion

	}// fin de la clase



?>