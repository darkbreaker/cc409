<?php
//controlador requiere tener acceso al modelo
include_once('model/ArticuloBss.php');
include_once('ModeloCtl.php');
	class ArticuloCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Articulo
		function __construct(){
			$this->modelo = new ArticuloBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Articulos
			$hacer=$_REQUEST['hacer'];
			$id=$_REQUEST['id'];
			$nombre=$_REQUEST['nombre'];
			$descripcion=$_REQUEST['descripcion'];
			$precio_venta=$_REQUEST['precio_venta'];
			$idUsuario=$_REQUEST['idUsuario'];
		
		         	if(!isset($hacer) ){
				$Articulo = $this->modelo-> listar();
				//vista del resultado
				include('view/listarArticuloView.php');
			} else switch($hacer){
				case 'agregar':
					$Articulo=$this->modelo->agregarArticulo($nombre, $descripcion, $precio_venta) ;
					include('view/agregarArticuloView.php');
					break;
				case 'consultar':
					$Articulo=$this->modelo->consultarArticulo($id);
					include('view/consultarArticuloView.php');
					break;
				case 'eliminar':
				$Articulo=$this->modelo->eliminarArticulo($idUsuario);
					include('view/eliminarArticuloView.php');
					break;
				case 'modificar':
					$Articulo=$this->modelo->modificarArticulo($nombre, $descripcion, $precio_venta) ;
					include('view/modificarArticuloView.php');
					break;
				case 'filtrar':
			$Articulo=$this->modelo->filtrarArticulo($descripcion);
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
