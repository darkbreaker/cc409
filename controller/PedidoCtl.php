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
					
				  	$hacer=$_REQUEST['hacer'];
					$idReservacion=$this->EsId($_REQUEST['idReservacion']);
					$estado=$_REQUEST['estado'];
					$descripcion=$_REQUEST['descripcion'];

						switch($hacer){
						case 'agregar':
							
								$Pedido=$this->modelo->agregar($_REQUEST['id'],$_SESSION['usuario']);
								$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
									echo $file;
							
							break;
						
						case 'listar':
							if($_SESSION['privilegio']>0){
								$Pedido=$this->modelo->Listar();
								include('view/ListarPedidoView.php');
							}else
								include('view/Index.html');
							break;
						case 'buscarReservacion':
							
							$Pedido=$this->modelo->buscarReservacion($_SESSION['usuario']);
							include('view/buscarReservacionView.php');
					
							break;
							
						case 'eliminarReservacion':
							if($_SESSION['privilegio']>0){
								if(!$idReservacion)
									include('view/Index.html');
								else{
									$Pedido=$this->modelo->eliminarReservacion($idReservacion);
									include('view/eliminarPedidoView.php');}
							}else
									include('view/Index.html');
								break;
						case 'ActualizarReservacion':
							
								$Pedido=$this->modelo-> ActualizarReservacion($idReservacion, 'terminado');
								include('view/ActulizarReservacionView.php');
							
								break;
							break;
						Default:
							include('view/Index.html');
							
					}//fin del switch
				} 	
				else 
					include('view/Index.html');
					
		}	
	}



?>
