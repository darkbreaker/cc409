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
		if(@session_start() == false){session_destroy();session_start();}
			//si no tengo parametros se regresa al menu principal

			 if(!isset($_REQUEST['hacer'])){
				if(!isset($_SESSION['usuario'])){
					$this->mostrar(file_get_contents('view/Index.html'));
				}else{
					if($_SESSION['privilegio']==0)
						$this->mostrar(file_get_contents('view/RegistroCita.html'));
					else
						$this->mostrar(file_get_contents('view/BuscarCita.html'));
				}
				
			}else  
			switch($_REQUEST['hacer']){
				case 'agregarCita':
					if(isset($_SESSION['usuario']))
					{
					$Cita=$this->modelo->agregarCita($_SESSION['usuario'],$_REQUEST['detalles'], $_REQUEST['opccion']) ;
					$file = file_get_contents('view/Index.html'); //cargo el archivo
					$file = str_ireplace('>Hola<','>Se ha registrado su cita<' , $file);  
					$this->mostrar($file);
					} else
						$this->mostrar(file_get_contents('view/Index.html'));
					
					break;
					
				case 'buscarCita':
					if(isset($_SESSION['usuario'])){
					$Cita=$this->modelo->buscarCita($_SESSION['usuario']);
					echo json_encode($Cita);}
					break;
				case 'eliminarCita':
						$idCita=$this->EsId($_REQUEST['idCita']);
			
					if($idCita!=false)
							$Cita=$this->modelo->eliminarCita($idCita);
						$this->mostrar(file_get_contents('view/Index.html'));
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
					$this->mostrar(file_get_contents('view/Index.html'));
					}
					break;

				case 'filtrarCita':
					if(isset($_SESSION['usuario'])){
					$descripcion=$_REQUEST['descripcion'];
					$Cita=$this->modelo->filtrarCita($descripcion) ;
					echo json_encode($Cita);}
					break;
				default:
					$this->mostrar(file_get_contents('view/Index.html'));
			}
			
		}

	}


?>