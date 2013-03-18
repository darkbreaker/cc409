<?php
//controlador requiere tener acceso al modelo
include_once('model/CitaBss.php');
	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Cita
		function __construct(){
			$this->modelo = new CitaBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Citas
			if(!isset($_REQUEST['accion']) ){
				$Cita = $this->modelo-> listar();
				//vista del resultado
				include('view/CitaView.php');
			} else switch($_REQUEST['accion']){
				case 'insertar':
					$Cita=$this->modelo->agregarCita($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/CitaView.php');
					break;
				case 'buscar':
					$Cita=$this->modelo->consultarCita($_REQUEST['id']);
					include('view/CitaView.php');
					break;
				case 'filtro':
				$Cita=$this->modelo->filtrarCita($_REQUEST['descripcion']);
					include('view/CitaView.php');
					break;
				case 'modificar':
					$Cita=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/CitaView.php');
					break;
				
			}
			
		}

	}




?>