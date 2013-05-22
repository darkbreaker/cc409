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
		//cargando sesion

				$hacer=$_REQUEST['hacer'];
				session_start();
				
				if(!isset($hacer)){
					if(!isset($_SESSION['usuario'])){
						include_once('view/Login.html');
						
						}
					else{
						session_unset();
						//destruye sesion
						session_destroy();
						setcookie(session_name(),'',time()-1);
						echo 'sesion cerrada';
						include_once('view/Login.html');
						}
					}
				else

				switch ($hacer){
					case 'in':
						if(!isset($_SESSION['usuario'])){
								$id=$_REQUEST['usuario'];
								$pass=$_REQUEST['pass'];
								$usuario=$this->modelo->login($id,$pass);
														
								if(is_object($usuario)){
							//si existe
									$_SESSION['usuario']=$usuario->id;
									$_SESSION['nombre']=$usuario->nombre;
									$_SESSION['privilegio']=$usuario->tipo;				
									$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$usuario->nombre , $file); //tomo {titulo} y lo reemplazo por lo que quiera
									echo $file;
									
								}else
										
										include('view/Login.html');
						}else
							{
							
								$file = file_get_contents('view/Index.html'); //cargo el archivo
								$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); //tomo {titulo} y lo reemplazo por lo que quiera
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
						include_once('view/Index.html');
						break;
					default:
						include_once('view/Index.html');
				}	// fin del switch

		}// fin de la funcion

	}// fin de la clase



?>