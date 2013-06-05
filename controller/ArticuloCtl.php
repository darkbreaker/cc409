<?php
//controlador requiere tener acceso al modelo
include_once('model/ArticuloBSS.php');
include_once('ModeloCtl.php');
include_once('pdfCtl.php');
include_once('excelCtl.php');
	class ArticuloCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Articulo
		function __construct(){
			$this->modelo = new ArticuloBSS();
		}

		function ejecutar(){ 
			session_start();
		     if(!isset($_REQUEST['hacer']) ){
				 
				$this->mostrar(file_get_contents('view/BuscarProducto.html'));
				
			} else switch($_REQUEST['hacer']){
				case 'agregar':
						
						$nombre=$this->EsNombre($_REQUEST['nombre']);
						$precio_venta=$this->EsNo($_REQUEST['precio_venta']);
						$idUsuario=$this->EsId($_REQUEST['idUsuario']);
					if(!$nombre||!$descripcion||!$precio_venta){
						$this->mostrar(file_get_contents('view/BuscarProducto.html'));
						}
					else{
						$Articulo=$this->modelo->agregarArticulo($nombre, $descripcion, $precio_venta) ;
						$this->mostrar(file_get_contents('view/BuscarProducto.html'));
					}
					break;
				case 'consultar':
					$id=$this->EsId($_REQUEST['id']);
					if(!$id){
						$this->mostrar(file_get_contents('view/Index.html'));
						}else{
					$Articulo=$this->modelo->consultarArticulo($id);
					echo $Articulo;}
					break;
				case 'eliminar':

					$idUsuario=$this->EsId($_REQUEST['idUsuario']);
					if(!$idUsuario){
						$this->mostrar(file_get_contents('view/Index.html'));
						}else{
					$Articulo=$this->modelo->eliminarArticulo($idUsuario);
					$this->mostrar(file_get_contents('view/BuscarProducto.html'));
					}
					break;
				case 'modificar':
						$nombre=$this->EsNombre($_REQUEST['nombre']);
						$precio_venta=$this->EsNo($_REQUEST['precio_venta']);
					if(!$nombre||!$precio_venta){
						$this->mostrar(file_get_contents('view/Index.html'));
						}else{
						$Articulo=$this->modelo->modificarArticulo($nombre, $descripcion, $precio_venta) ;
						$this->mostrar(file_get_contents('view/BuscarProducto.html'));
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
					break;
					
				case 'excel':
					$excel= new Excel();
					$Articulo=$this->modelo->listar();
					$excel->run($Articulo);
					break;
				case 'alta':
					if(isset($_SESSION['nombre']))
						$this->mostrar(file_get_contents('view/RegistroProducto.html'));
					else
						$this->mostrar(file_get_contents('view/BuscarProducto.html'));
						
						break;
				Default:
					$this->mostrar(file_get_contents('view/Login.html'));
				}
				
		}
			

	}


?>
