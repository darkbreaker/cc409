<?php
//controlador requiere tener acceso al modelo
include_once('model/ArticuloBss.php');
	class ArticuloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Articulo
		function __construct(){
			$this->modelo = new ArticuloBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Articulos
			$hacer=$_REQUEST['hacer'];
			
			if(!isset($hacer) ){
				$Articulo = $this->modelo-> listar();
				//vista del resultado
				include('view/listarArticuloView.php');
			} else switch($hacer){
				case 'agregar':
					$Articulo=$this->modelo->agregarArticulo($_REQUEST['nombre'],$_REQUEST['descripcion'],$_REQUEST['precio_venta']) ;
					include('view/agregarArticuloView.php');
					break;
				case 'consultar':
					$Articulo=$this->modelo->consultarArticulo($_REQUEST['id']);
					include('view/consultarArticuloView.php');
					break;
				case 'eliminar':
				$Articulo=$this->modelo->eliminarArticulo($_REQUEST['idUsuario']);
					include('view/eliminarArticuloView.php');
					break;
				case 'modificar':
					$Articulo=$this->modelo->modificarArticulo($_REQUEST['nombre'],$_REQUEST['descripcion'],$_REQUEST['precio_venta']) ;
					include('view/modificarArticuloView.php');
					break;
				case 'filtrar':
			$Articulo=$this->modelo->filtrarArticulo($_REQUEST['descripcion']);
					include('view/filtrarArticuloView.php');
					break;
				case 'listar':
			$Articulo=$this->modelo->listar();
					include('view/listarArticuloView.php');
					break;
			}
			
		}

	}




?>
