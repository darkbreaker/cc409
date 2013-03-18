<?php
//controlador requiere tener acceso al modelo
include_once('model/PedidoBss.php');
	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Pedido
		function __construct(){
			$this->modelo = new PedidoBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Pedidos
			if(!isset($_REQUEST['accion']) ){
				$Pedido = $this->modelo-> Listar();
				//vista del resultado
				include('view/ListarPedidoView.php');
			} else switch($_REQUEST['accion']){
				case 'listar':
					$Pedido=$this->modelo->Listar();
					include('view/ListarPedidoView.php');
					break;
				case 'buscarReservacion':
					$Pedido=$this->modelo->buscarReservacion($_REQUEST['idReservacion'],$_REQUEST['idUsuario']);
					include('view/buscarReservacionView.php');
					break;
				case 'eliminarReservacion':
				$Pedido=$this->modelo->eliminarReservacion($_REQUEST['idReservacion']);
					include('view/eliminarPedidoView.php');
					break;
				case 'ActualizarReservacion':
					$Pedido=$this->modelo-> ActualizarReservacion($_REQUEST['idReservacion'],$_REQUEST['estado']);
					include('view/ActulizarReservacionView.php');
					break;
				case 'filtrarPedido':
					$Pedido=$this->modelo->filtrarPedido($_REQUEST['descripcion']) ;
					include('view/filtrarPedidoView.php');
					break;
			}
			
		}

	}




?>
