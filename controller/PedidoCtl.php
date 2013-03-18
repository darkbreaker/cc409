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
				$Pedido = $this->modelo-> listar();
				//vista del resultado
				include('view/PedidoView.php');
			} else switch($_REQUEST['accion']){
				case 'insertar':
					$Pedido=$this->modelo->agregarPedido($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/PedidoView.php');
					break;
				case 'buscar':
					$Pedido=$this->modelo->consultarPedido($_REQUEST['id']);
					include('view/PedidoView.php');
					break;
				case 'filtro':
				$Pedido=$this->modelo->filtrarPedido($_REQUEST['descripcion']);
					include('view/PedidoView.php');
					break;
				case 'modificar':
					$Pedido=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/PedidoView.php');
					break;
				
			}
			
		}

	}




?>