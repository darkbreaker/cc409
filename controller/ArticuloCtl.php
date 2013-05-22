<?php
//controlador requiere tener acceso al modelo
include_once('model/ArticuloBSS.php');
include_once('ModeloCtl.php');
	class ArticuloCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Articulo
		function __construct(){
			$this->modelo = new ArticuloBSS();
		}

		function ejecutar(){
			//si no tengo parametros se listan los Articulos
			$hacer=$_REQUEST['hacer'];
			$id=$this->EsId($_REQUEST['id']);
			$nombre=$this->EsNombre($_REQUEST['nombre']);
			$descripcion=$_REQUEST['descripcion'];
			$precio_venta=$this->EsNo($_REQUEST['precio_venta']);
			$idUsuario=$this->EsId($_REQUEST['idUsuario']);
		
		     if(!isset($hacer) ){
				session_start();
				
				if(isset($_SESSION['usuario'])){
				$file = file_get_contents('view/BuscarProducto.html'); //cargo el archivo
				$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); //tomo {titulo} y lo reemplazo por lo que quiera
				echo $file;
				} else{
					
					include_once('view/BuscarProducto.html');
					
					}
				
			} else switch($hacer){
				case 'agregar':
					if(!$nombre||!$descripcion||!$precio_venta)
						include_once('view/Index.html');
						else{
					$Articulo=$this->modelo->agregarArticulo($nombre, $descripcion, $precio_venta) ;
					include('view/agregarArticuloView.php');}
					break;
				case 'consultar':
					if(!$id)
						include_once('view/Index.html');
						else{
					$Articulo=$this->modelo->consultarArticulo($id);
					include('view/consultarArticuloView.php');}
					break;
				case 'eliminar':
					if(!$idUsuario)
						include_once('view/Index.html');
						else{
					$Articulo=$this->modelo->eliminarArticulo($idUsuario);
					include('view/eliminarArticuloView.php');}
					break;
				case 'modificar':
					if(!$nombre||!$descripcion||!$precio_venta)
						include_once('view/Index.html');
						else{
					$Articulo=$this->modelo->modificarArticulo($nombre, $descripcion, $precio_venta) ;
					include('view/modificarArticuloView.php');}
					break;
				case 'filtrar':
					if(!isset($descripcion)){
						$Articulo=$this->modelo->listar();
						echo json_encode($Articulo);
						
						}
						else{
							$Articulo=$this->modelo->filtrarArticulo($descripcion);
							echo json_encode($Articulo);
						}
					break;
				Default:
					
					include('view/BuscarProducto.html');
					break;
			}
			
		}

	}




?>
