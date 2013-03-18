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
				include('view/PedidoView.php');
			} else switch($_REQUEST['accion']){
				case 'listar':
					$Pedido=$this->modelo->Listar();
					include('view/PedidoView.php');
					break;
				case 'buscarReservacion':
					$Pedido=$this->modelo->;
					include('view/PedidoView.php');
					break;
				case 'eliminarReservacion':
				$Pedido=$this->modelo->;
					include('view/PedidoView.php');
					break;
				case 'ActualizarReservacion':
					$Pedido=$this->modelo-> ;
					include('view/PedidoView.php');
					break;
				case 'filtrarPedido':
					$Pedido=$this->modelo-> ;
					include('view/PedidoView.php');
					break;
			}
			
		}

	}




?>