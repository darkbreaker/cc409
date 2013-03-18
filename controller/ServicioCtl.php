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
				include('view/ServicioView.php');
			} else switch($_REQUEST['accion']){
				case 'buscarServicio':
					$Servicio=$this->modelo->buscarServicio($_REQUEST['idServicio']);
					include('view/ServicioView.php');
					break;
				case 'listar':
					$Servicio=$this->modelo->listar();
					include('view/ServicioView.php');
					break;
				case 'agregar':
				$Servicio=$this->modelo->agregar($_REQUEST['precio'],$_REQUEST['tiempo'],$_REQUEST['descripcion']);
					include('view/ServicioView.php');
					break;
				case 'eliminar':
					$Servicio=$this->modelo->eliminar($_REQUEST['idServicio']) ;
					include('view/ServicioView.php');
					break;
				
			}
			
		}

	}




?>
