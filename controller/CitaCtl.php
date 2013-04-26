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
			$hacer=$_REQUEST['hacer'];
			$idCita=$_REQUEST['idCita'];
			$fecha=$_REQUEST['fecha'];
			$detalles=$_REQUEST['detalles'];
			$hora_reserva=$_REQUEST['hora_reserva'];
			$hora_termino=$_REQUEST['hora_termino'];
			$idUsuario=$_REQUEST['idUsuario'];
                        $estado=$_REQUEST['estado'];
			$descripcion=$_REQUEST['descripcion'];
			if(!isset($hacer) ){
				
				include('view/View.php');
			} else switch($hacer){
				case 'agregarCita':
					$Cita=$this->modelo->agregarCita($idUsuario, $fecha ,$detalles, $hora_reserva) ;
					include('view/agregarCitaView.php');
					break;
				case 'buscarCita':
					$Cita=$this->modelo->buscarCita($idCita);
					include('view/buscarCitaView.php');
					break;
				case 'eliminarCita':
				$Cita=$this->modelo->eliminarCita($idCita);
					include('eliminarview/CitaView.php');
					break;
				case 'listar':
					$Cita=$this->modelo->listar() ;
					include('view/listarCitaView.php');
					break;
				case 'servicioCita':
			               $Cita=$this->modelo->servicioCita($idCita) ;
					include('view/serviciosCitaView.php');
					break;
		        case 'ActualizarCita':
			               $Cita=$this->modelo->ActualizarCita($idCita, $hora_termino ,$estado) ;
					include('view/ActulizarCitaView.php');
					break;

				case 'filtrarCita':
					$Cita=$this->modelo->filtrarCita($descripcion) ;
					include('view/filtrarCitaView.php');
					break;
				
			}
			
		}

	}




?>
