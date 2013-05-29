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

		function ejecutar(){
			//si no tengo parametros se regresa al menu principal
			 
			 
			$idCita=$this->EsId($_REQUEST['idCita']);
			$fecha=$this->EsFecha($_REQUEST['fecha']);
			$detalles=$_REQUEST['detalles'];

			$idUsuario=$this->EsId($_REQUEST['idUsuario']);
            $estado=$_REQUEST['estado'];
			$descripcion=$_REQUEST['descripcion'];
			
			
			 if(!isset($_REQUEST['hacer'])){
				if(!isset($_SESSION['usuario'])){
					$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					
				
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
					
					$Cita=$this->modelo->buscarCita($_SESSION['usuario']);
					echo json_encode($Cita);
					break;
				case 'eliminarCita':
					if(!$idCita)
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					else{
							$Cita=$this->modelo->eliminarCita($idCita);
							include('eliminarview/CitaView.php');}
					break;
				case 'listar':
						$Cita=$this->modelo->listar() ;
						echo json_encode($Cita);
					
					break;
				
		        case 'ActualizarCita':
					
			        $Cita=$this->modelo->ActualizarCita($_REQUEST['idCita']) ;
					$file = file_get_contents('view/Index.html'); //cargo el archivo
					$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
					echo $file;

					break;

				case 'filtrarCita':
					$Cita=$this->modelo->filtrarCita($descripcion) ;
					echo json_encode($Cita);
					break;
				
			}
			
		}

	}




?>
