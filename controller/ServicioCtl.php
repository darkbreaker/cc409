<?php
//controlador requiere tener acceso al modelo
include_once('model/ServicioBss.php');
	class ServicioCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Servicio
		function __construct(){
			$this->modelo = new ServicioBss();
		}

		function ejecutar(){
		session_start();
			
			if(!isset($_REQUEST['hacer']) ){
				$Servicio = $this->modelo-> listar();
				//vista del resultado
				include('view/listarServicioView.php');
			} else switch($_REQUEST['hacer']){
				case 'buscarServicio':
					$Servicio=$this->modelo->buscarServicio($_REQUEST['idServicio']);
					include('view/buscarServicioView.php');
					break;
				case 'agregar':
				if(!isset($_SESSION['usuario'])){
					if($_SESSION['privilegio']==2){
					$Servicio=$this->modelo->agregar($_REQUEST['precio'],$_REQUEST['tiempo'],$_REQUEST['descripcion']);
					include('view/agregarServicioView.php');
					}else
						include('view/View.php');
				}else{
					include('view/View.php');
				}
					break;
				case 'eliminar':
				if(!isset($_SESSION['usuario'])){
					if($_SESSION['privilegio']==2){
					$Servicio=$this->modelo->eliminar($_REQUEST['idServicio']) ;
					include('view/eliminarServicioView.php');
					}else
						include('view/View.php');
				}else{
					include('view/View.php');
				}
					break;
				
			}
			
		}

	}




?>
