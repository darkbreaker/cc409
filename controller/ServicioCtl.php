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
			if(@session_start() == false){session_destroy();session_start();} 

			if(!isset($_REQUEST['hacer']) ){
				$Servicio = $this->modelo-> listar();
				echo json_encode($Servicio);
			} else switch($_REQUEST['hacer']){
				case 'buscarServicio':
					$idServicio=$this->EsId($_REQUEST['idServicio']);
					if(!$idServicio){
						$this->mostrar(file_get_contents('view/Login.html'));
					}else{
						$Servicio=$this->modelo->buscarServicio($idServicio);
						echo json_encode($Servicio);
						}
					break;
				case 'agregar':
					$precio=$this->EsNo($_REQUEST['precio']);
					$tiempo=$this->EsNo($_REQUEST['tiempo']);
					$descripcion=$_REQUEST['descripcion'];
				
					if(!isset($_SESSION['usuario'])||!$precio||!$tiempo||!$descripcion){
						$this->mostrar(file_get_contents('view/Login.html'));
					}else{
						if($_SESSION['privilegio']==2)
						$Servicio=$this->modelo->agregar($precio, $tiempo, $descripcion);
						$this->mostrar(file_get_contents('view/Login.html'));
					}
					break;
				case 'eliminar':
					$idServicio=$this->EsId($_REQUEST['idServicio']);
					if($_SESSION['privilegio']>0 && $idServicio!=false)
						$Servicio=$this->modelo->eliminar($idServicio) ;
						$this->mostrar(file_get_contents('view/Login.html'));	
						break;
				Default:
					$this->mostrar(file_get_contents('view/Login.html'));
			}	// fin del switch
			
		}

	}	//fin de la clase




?>
