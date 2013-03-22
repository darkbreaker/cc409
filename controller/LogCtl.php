<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBSS.php');
	class LogCtl{
		public $modelo;
		//cuando se crea el contrador crea el modelo usuario
		function __construct(){
			$this->modelo = new UsuarioBSS();
		}

		function ejecutar(){
		//cargando sesion
			$accion=$_REQUEST['hacer'];
			session_start();
			
			switch ($accion){
				case 'in':
				
					if(!isset($_SESSION['usuario'])){
						//si no tengo parametros se listan los usuarios
							$id=$_REQUEST['usuario'];
							$pass=$_REQUEST['pass'];
							$usuario=$this->modelo->login($id,$pass);
						
						if(is_object($usuario)){
						//si existe
							$_SESSION['usuario']=$usuario->id;
							$_SESSION['nombre']=$usuario->nombre;
							$_SESSION['privilegio']=$usuario->tipo;				
					
							include('view/View.php');}
					}
					break;
				case 'out':
					//limpiar session
					session_unset();
					//destruye sesion
					session_destroy();
					setcookie(session_name(),'',time()-1);
					var_dump ($_SESSION);
				
					break;
				
			}
		}

	}



?>