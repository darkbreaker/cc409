<?php
//controlador requiere tener acceso al modelo
include_once('model/NotaVentaBss.php');
	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo NotaVenta
		function __construct(){
			$this->modelo = new NotaVentaBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los NotaVentas
			if(!isset($_REQUEST['accion']) ){
				$NotaVenta = $this->modelo-> listar();
				//vista del resultado
				include('view/NotaVentaView.php');
			} else switch($_REQUEST['accion']){
				case 'insertar':
					$NotaVenta=$this->modelo->agregarNotaVenta($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/NotaVentaView.php');
					break;
				case 'buscar':
					$NotaVenta=$this->modelo->consultarNotaVenta($_REQUEST['id']);
					include('view/NotaVentaView.php');
					break;
				case 'filtro':
				$NotaVenta=$this->modelo->filtrarNotaVenta($_REQUEST['descripcion']);
					include('view/NotaVentaView.php');
					break;
				case 'modificar':
					$NotaVenta=$this->modelo->modificar($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['calle'],$_REQUEST['password'],$_REQUEST['email'],$_REQUEST['idPersona']) ;
					include('view/NotaVentaView.php');
					break;
				
			}
			
		}

	}




?>