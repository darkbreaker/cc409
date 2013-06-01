<?php
//controlador requiere tener acceso al modelo
include_once('model/ArticuloBSS.php');
include_once('ModeloCtl.php');
include_once('pdfCtl.php');
	class ArticuloCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Articulo
		function __construct(){
			$this->modelo = new ArticuloBSS();
		}

		function ejecutar(){ session_start();


		
		     if(!isset($_REQUEST['hacer']) ){
				 
				
				if(isset($_SESSION['usuario'])){
				$file = file_get_contents('view/BuscarProducto.html'); //cargo el archivo
				$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); 
				$file = str_ireplace('>Login<','>Log out<' , $file); 
				echo $file;
				} else{
					$file = file_get_contents('view/BuscarProducto.html');
						$file = str_ireplace('>{Username}<','><' , $file); 
						$file = str_ireplace('>Citas<','><' , $file);
						echo $file;
					}
				
			} else switch($_REQUEST['hacer']){
				case 'agregar':
						
						$nombre=$this->EsNombre($_REQUEST['nombre']);
			
						$precio_venta=$this->EsNo($_REQUEST['precio_venta']);
						$idUsuario=$this->EsId($_REQUEST['idUsuario']);
					if(!$nombre||!$descripcion||!$precio_venta){
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('>{Username}<','><',$file);
						echo $file;}
						else{
					$Articulo=$this->modelo->agregarArticulo($nombre, $descripcion, $precio_venta) ;
						
					}
					break;
				case 'consultar':
								$id=$this->EsId($_REQUEST['id']);
					if(!$id){
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('>{Username}<','><',$file); echo $file;
						}else{
					$Articulo=$this->modelo->consultarArticulo($id);
					include('view/consultarArticuloView.php');}
					break;
				case 'eliminar':

			$idUsuario=$this->EsId($_REQUEST['idUsuario']);
					if(!$idUsuario){
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('>{Username}<','><',$file); echo $file;
						}else{
					$Articulo=$this->modelo->eliminarArticulo($idUsuario);
					include('view/eliminarArticuloView.php');}
					break;
				case 'modificar':
						$nombre=$this->EsNombre($_REQUEST['nombre']);
						$precio_venta=$this->EsNo($_REQUEST['precio_venta']);
					if(!$nombre||!$precio_venta){
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('>{Username}<','><',$file); 
						echo $file;
						}else{
						$Articulo=$this->modelo->modificarArticulo($nombre, $descripcion, $precio_venta) ;
					}
					break;
				case 'filtrar':
					if(!isset($_REQUEST['descripcion'])){
						$Articulo=$this->modelo->listar();
						echo json_encode($Articulo);
						
						}
						else{
							$Articulo=$this->modelo->filtrarArticulo($_REQUEST['descripcion']);
							echo json_encode($Articulo);
						}
					break;
				case 'pdf':
					$pdf= new PDF();
					
					$Articulo=$this->modelo->listar();
					$pdf->run($Articulo);
				Default:
					if(isset($_SESSION['usuario'])){
				$file = file_get_contents('view/BuscarProducto.html'); //cargo el archivo
				$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); 
				$file = str_ireplace('>Login<','>Log out<' , $file); 
				echo $file;
				} else{
					$file = file_get_contents('view/BuscarProducto.html');
						$file = str_ireplace('>{Username}<','><' , $file); 
						$file = str_ireplace('>Citas<','><' , $file);
						echo $file;
					}
					
					break;
			}
			
		}

	}




?>
