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
			 
			 
			$idServicio=$this->EsId($_REQUEST['idServicio']);
			$precio=$this->EsNo($_REQUEST['precio']);
			$tiempo=$this->EsNo($_REQUEST['tiempo']);
			$descripcion=$_REQUEST['descripcion'];

			if(!isset($_REQUEST['hacer']) ){
				$Servicio = $this->modelo-> listar();

				echo json_encode($Servicio);
			} else switch($_REQUEST['hacer']){
				case 'buscarServicio':
					if(!$idServicio)
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					else{
						$Servicio=$this->modelo->buscarServicio($idServicio);
						include('view/buscarServicioView.php');}
					break;
				case 'agregar':
					if(!isset($_SESSION['usuario'])||!$precio||!$tiempo||!$descripcion){
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					}else{
						if($_SESSION['privilegio']==2){
						$Servicio=$this->modelo->agregar($precio, $tiempo, $descripcion);
						include('view/agregarServicioView.php');
						}else
							$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					}
					break;
				case 'eliminar':
					if(!isset($_SESSION['usuario'])||!$idServicio){
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					}else{
						if($_SESSION['privilegio']==2){
							$Servicio=$this->modelo->eliminar($idServicio) ;
							include('view/eliminarServicioView.php');
						}else
							$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
						
					}
						break;
				Default:
					$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
			}
			
		}

	}	//fin de la clase




?>
