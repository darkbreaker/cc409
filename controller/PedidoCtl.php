<?php
//controlador requiere tener acceso al modelo
include_once('model/PedidoBss.php');
	class PedidoCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Pedido
		function __construct(){
			$this->modelo = new PedidoBss();
		}

		function ejecutar(){
				session_start();
				if(isset($_SESSION['usuario'])){ //se valida que una sesion este iniciada para poder usar los pedidos
						switch($_REQUEST['hacer']){
						case 'listar':
							if($_SESSION['privilegio']>0){
							$Pedido=$this->modelo->Listar();
							include('view/ListarPedidoView.php');
							}else
							include('view/View.php');
							break;
						case 'buscarReservacion':
					
							$Pedido=$this->modelo->buscarReservacion($_SESSION['usuario']);
							include('view/buscarReservacionView.php');
					
							break;
							
						case 'eliminarReservacion':
						if($_SESSION['privilegio']>0){
						$Pedido=$this->modelo->eliminarReservacion($_REQUEST['idReservacion']);
							include('view/eliminarPedidoView.php');
							}else
							include('view/View.php');
							break;
						case 'ActualizarReservacion':
						if($_SESSION['privilegio']>0){
							$Pedido=$this->modelo-> ActualizarReservacion($_REQUEST['idReservacion'],$_REQUEST['estado']);
							include('view/ActulizarReservacionView.php');
							}else
							include('view/View.php');
							break;
						case 'filtrarPedido':
							if($_SESSION['privilegio']>0){
							$Pedido=$this->modelo->filtrarPedido($_REQUEST['descripcion']) ;
							include('view/filtrarPedidoView.php');
							include('view/ActulizarReservacionView.php');
							}else
							include('view/View.php');
							break;
					}//fin del switch
					} else {
						include('view/View.php');
					}
				}
			}

	}




?>
