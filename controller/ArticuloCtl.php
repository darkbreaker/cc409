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
			if(!isset($_REQUEST['accion']) ){
				$Articulo = $this->modelo-> listar();
				//vista del resultado
				include('view/ArticuloView.php');
			} else switch($_REQUEST['accion']){
				case 'agregarUsuario':
					$Articulo=$this->modelo->agregarArticulo($_REQUEST['nombre'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['calle'],$_REQUEST['telefono']) ;
					include('view/ArticuloView.php');
					break;
				case 'buscarUsuario':
					$Articulo=$this->modelo->consultarArticulo($_REQUEST['id']);
					include('view/ArticuloView.php');
					break;
				case 'eliminarUsuario':
				$Articulo=$this->modelo->filtrarArticulo($_REQUEST['descripcion']);
					include('view/ArticuloView.php');
					break;
				case 'modificarUsuario':
					
					break;
				case 'filtrarUsuario':
					
					break;
			}
			
		}

	}




?>