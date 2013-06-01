<?php
//controlador requiere tener acceso al modelo
include_once('model/PedidoBSS.php');
include_once('ModeloCtl.php');
	class PedidoCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Pedido
		function __construct(){
		
			$this->modelo = new PedidoBSS();
		}
		
		
		function ejecutar(){ 
			session_start();
			 
				if(isset($_SESSION['usuario'])){ //se valida que una sesion este iniciada para poder usar los pedidos
					
						switch($_REQUEST['hacer']){
						case 'agregar':
							
								$Pedido=$this->modelo->agregar($_REQUEST['id'],$_SESSION['usuario']);
								$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
									$file = str_ireplace('<h5>Hola</h5>','Pedido hecho',$file);
									echo $file;
							
							break;
						
						case 'listar':
							$Pedido=$this->modelo->listar();
							echo json_encode($Pedido);
							break;
						case 'buscar':
							
							$Pedido=$this->modelo->buscarReservacion($_SESSION['usuario']);
							echo json_encode($Pedido);
					
							break;
							
						case 'eliminarReservacion':
							$idReservacion=$this->EsId($_REQUEST['idReservacion']);
							if($_SESSION['privilegio']>0){
								if(!$idReservacion){
									$file = file_get_contents('view/Index.html');
									$file = str_ireplace('>{Username}<','><',$file);
									$file = str_ireplace('<h5>Hola</h5>','Error',$file); 
									echo $file;
								}else{
									
									$Pedido=$this->modelo->eliminarReservacion($idReservacion);
									$file = file_get_contents('view/Index.html'); 
									$file = str_ireplace('>{Username}<','><',$file); 
									$file = str_ireplace('<h5>Hola</h5>','hecho',$file); 
									echo $file;
									}
							}else{
									$file = file_get_contents('view/Index.html'); 
									$file = str_ireplace('>{Username}<','><',$file); 
									$file = str_ireplace('<h5>Hola</h5>','Error',$file); 
									echo $file;
								}break;
						case 'actualizar':
								$idReservacion=$this->EsId($_REQUEST['idReservacion']);
								if($idReservacion!=false){
								$Pedido=$this->modelo-> ActualizarReservacion($idReservacion);
								$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
									$file = str_ireplace('<h5>Hola</h5>','Reservacion Actulizada',$file); 
									echo $file;
									}else{
									$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
									echo $file;
								
									}
							
								break;
							break;
						Default:
							$file = file_get_contents('view/Index.html');
							$file = str_ireplace('>{Username}<','><',$file); 
							echo $file;
							
					}//fin del switch
				} 	
				else {
					$file = file_get_contents('view/Index.html');
					$file = str_ireplace('>{Username}<','><',$file); 
					echo $file;}
					
		}	
	}



?>
