<?php
//controlador requiere tener acceso al modelo
include_once('model/ServicioBSS.php');
include_once('ModeloCtl.php');
	class ServicioCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Servicio
		function __construct(){
			$this->modelo = new ServicioBSS();
		}

		function ejecutar(){
		session_start();
			$hacer=$_REQUEST['hacer'];
			$idServicio=esId($_REQUEST['idServicio']);
			$precio=EsNo($_REQUEST['precio']);
			$tiempo=$_REQUEST['tiempo'];
			$descripcion=$_REQUEST['descripcion'];

			if(!isset($hacer) ){
				$Servicio = $this->modelo-> listar();
				//vista del resultado
				include('view/listarServicioView.php');
			} else switch($hacer){
				case 'buscarServicio':
					$Servicio=$this->modelo->buscarServicio($idServicio);
					include('view/buscarServicioView.php');
					break;
				case 'agregar':
				if(isset($_SESSION['usuario'])){
					if($_SESSION['privilegio']==2){
					$Servicio=$this->modelo->agregar($precio, $tiempo, $descripcion);
					include('view/agregarServicioView.php');
					}else
						include('view/View.php');
				}else{
					include('view/View.php');
				}
					break;
				case 'eliminar':
				if(isset($_SESSION['usuario'])){
					if($_SESSION['privilegio']==2){
					$Servicio=$this->modelo->eliminar($idServicio) ;
					include('view/eliminarServicioView.php');
					}else
						include('view/View.php');
				}else{
					include('view/View.php');
				}
					break;
				
			}
			
		}

	}	//fin de la clase




?>
