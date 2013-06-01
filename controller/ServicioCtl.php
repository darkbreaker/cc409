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

			if(!isset($_REQUEST['hacer']) ){
				$Servicio = $this->modelo-> listar();
				echo json_encode($Servicio);
			} else switch($_REQUEST['hacer']){
				case 'buscarServicio':
					$idServicio=$this->EsId($_REQUEST['idServicio']);
					if(!$idServicio){
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('>{Username}<','><',$file);
						echo $file;
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
						$file = file_get_contents('view/Index.html'); 
						$file = str_ireplace('>{Username}<','><',$file); 
						echo $file;
					}else{
						if($_SESSION['privilegio']==2){
						$Servicio=$this->modelo->agregar($precio, $tiempo, $descripcion);
						include('view/agregarServicioView.php');
						}else
							$file = file_get_contents('view/Index.html'); 
							$file = str_ireplace('>{Username}<','><',$file); 
							echo $file;
					}
					break;
				case 'eliminar':
					$idServicio=$this->EsId($_REQUEST['idServicio']);
					if(!isset($_SESSION['nombre']) ){
							$file = file_get_contents('view/Index.html'); 
							$file = str_ireplace('>{Username}<','><',$file); 
							echo $file;}
					ELSE if(!$idServicio){
								$file = file_get_contents('view/Index.html'); //cargo el archivo
								$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
								$file = str_ireplace('>Login<','>Log out<' , $file);
								echo $file;
							
							} else {
							if($_SESSION['privilegio']>0){
								$Servicio=$this->modelo->eliminar($idServicio) ;
								$file = file_get_contents('view/Index.html'); //cargo el archivo
								$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
								$file = str_ireplace('>Login<','>Log out<' , $file);
								echo $file;
							}else{
								$file = file_get_contents('view/Index.html'); //cargo el archivo
								$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
								$file = str_ireplace('>Login<','>Log out<' , $file);
								echo $file;}
							}
						break;
				Default:
					if(!isset($_SESSION['nombre']) ){
								$file = file_get_contents('view/Index.html'); 
								$file = str_ireplace('>{Username}<','><',$file); 
							echo $file;
							} else {
								$file = file_get_contents('view/Index.html'); //cargo el archivo
								$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
								$file = str_ireplace('>Login<','>Log out<' , $file);
								echo $file;
							}
			}	// fin del switch
			
		}

	}	//fin de la clase




?>
