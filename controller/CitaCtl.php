<?php
//controlador requiere tener acceso al modelo
include_once('model/CitaBSS.php');
include_once('ModeloCtl.php');
class CitaCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Cita
		function __construct(){
			$this->modelo = new CitaBSS();
		}

		function ejecutar(){ session_start();
			//si no tengo parametros se regresa al menu principal

			 if(!isset($_REQUEST['hacer'])){
				if(!isset($_SESSION['usuario'])){
					$file = file_get_contents('view/Index.html');
					
					$file = str_ireplace('{Username}','sin sesion',$file); 
					$file = str_ireplace('<h5>Hola</h5>','Requiere Iniciar sesion',$file);
					echo $file;
					
				
				}else
				if($_SESSION['privilegio']==0){
				$file = file_get_contents('view/RegistroCita.html'); //cargo el archivo
				$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
				echo $file;
				}else{
					$file = file_get_contents('view/BuscarCita.html'); //cargo el archivo
					$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
					echo $file;
				
				}
				
			}else  
			switch($_REQUEST['hacer']){
				case 'agregarCita':
					
					$Cita=$this->modelo->agregarCita($_SESSION['usuario'],$detalles, $_REQUEST['opccion']) ;
					$file = file_get_contents('view/Index.html'); //cargo el archivo
					$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
					echo $file;
			
					break;
					
				case 'buscarCita':
					if(isset($_SESSION['usuario'])){
					$Cita=$this->modelo->buscarCita($_SESSION['usuario']);
					echo json_encode($Cita);}
					break;
				case 'eliminarCita':
						$idCita=$this->EsId($_REQUEST['idCita']);
			
					if(!$idCita){
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					}else{
							$Cita=$this->modelo->eliminarCita($idCita);
							}
					break;
				case 'listar':
						if(isset($_SESSION['usuario'])){
						$Cita=$this->modelo->listar() ;
						echo json_encode($Cita);
						}
					break;
				
		        case 'ActualizarCita':
					if(isset($_SESSION['usuario'])){
					
			        $Cita=$this->modelo->ActualizarCita($_REQUEST['idCita']) ;
					$file = file_get_contents('view/Index.html'); //cargo el archivo
					$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
					echo $file;
					}
					break;

				case 'filtrarCita':
					if(isset($_SESSION['usuario'])){
					$descripcion=$_REQUEST['descripcion'];
					$Cita=$this->modelo->filtrarCita($descripcion) ;
					echo json_encode($Cita);}
					break;
				
			}
			
		}

	}




?>
