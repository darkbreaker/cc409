<?php
//controlador requiere tener acceso al modelo
include_once('model/ServicioBss.php');
	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Servicio
		function __construct(){
			$this->modelo = new ServicioBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Servicios
			if(!isset($_REQUEST['accion']) ){
				$Servicio = $this->modelo-> listar();
				//vista del resultado
				include('view/ServicioListaView.php');
			} else switch($_REQUEST['accion']){
				case 'insertar':
					$Servicio=$this->modelo->agregarServicio($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/ServicioInsertadoView.php');
					break;
				case 'buscar':
					$Servicio=$this->modelo->consultarServicio($_REQUEST['id']);
					include('view/ServicioInsertadoView.php');
					break;
				case 'filtro':
				$Servicio=$this->modelo->filtrarServicio($_REQUEST['descripcion']);
					include('view/ServicioInsertadoView.php');
					break;
				case 'modificar':
					$Servicio=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/ServicioInsertadoView.php');
					break;
				
			}
			
		}

	}




?>