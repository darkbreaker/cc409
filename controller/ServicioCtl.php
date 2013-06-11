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
				
					if(!isset($_SESSION['usuario'])){
						$this->mostrar(file_get_contents('view/Index.html'));
					}else{
						if($_SESSION['privilegio']!=0)
						$Servicio=$this->modelo->agregar($_REQUEST['precio'], $_REQUEST['tiempo'], $_REQUEST['descripcion']);
						$this->mostrar(file_get_contents('view/PerfilAdmin.html'));
					}
					break;
				case 'eliminar':
					$idServicio=$this->EsId($_REQUEST['idServicio']);
					if($_SESSION['privilegio']>0 && $idServicio!=false)
						$Servicio=$this->modelo->eliminar($idServicio) ;
						$this->mostrar(file_get_contents('view/Login.html'));	
						break;
				case 'alta':
					if($_SESSION['privilegio']>0)
						$this->mostrar(file_get_contents('view/RegistroServicio.html'));
					else
						$this->mostrar(file_get_contents('view/Login.html'));
					break;
				Default:
					
					$this->mostrar(file_get_contents('view/Login.html'));
			}	// fin del switch
			
		}

	}	//fin de la clase


?>