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
					if(isset($_SESSION['usuario'])){
						session_unset();
						session_destroy();
						setcookie(session_name(),'',time()-1);
						}
						$this->mostrar(file_get_contents('view/Login.html'));
					}
				else switch ($_REQUEST['hacer']){
					case 'in':
						if(!isset($_SESSION['usuario'])){
								
								$id=$_REQUEST['usuario'];
								$pass=$_REQUEST['pass'];
								$usuario=$this->modelo->login($id,$pass);
														
								if(isset($usuario)){
					
									$_SESSION['usuario']=$usuario['idPersona'];
									$_SESSION['nombre']=$usuario['email'];
									$_SESSION['privilegio']=$usuario['privilegios'];				
									$this->mostrar(file_get_contents('view/Index.html'));
									
								}else{
								$this->mostrar(file_get_contents('view/Login.html'));
										}
						}else
							{
								$this->mostrar(file_get_contents('view/Index.html'));
							}
								
						break;

					default:
						$this->mostrar(file_get_contents('view/Index.html'));
				}	// fin del switch

		}// fin de la funcion

	}// fin de la clase



?>