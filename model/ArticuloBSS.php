<?php

include_once('Conexion.php');
include_once('Articulo.php');
  class ArticuloBSS{
		public $id;
		public $nombre;
		public $descripcion;
		public $precio_venta;
		
         agregarArticulo($nombre, $descripcion, $precio_venta){
			$this->nombre=$nombre;
			$this->descripcion=$descripcion;
			$this->precio_venta=$precio_venta;
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if(!$con->conecta())
				die('error conexion');
			$sql="INSERT INTO articulo(nombre,descripcion,precio) VALUES ('$this->nombre','$this->descripcion','$this->precio_venta') ";
			$resultado=$con->consulta($sql);
			if($resultado==false){
				die('error insercion');
				$con->cerrar();
				return FALSE;
				}
			$this -> id =$resultado;
			$con->cerrar();
			return $this->id;
        }
		
         buscarArticulo($idArticulo){
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if($con->conecta()==false)
				die('error de conexion');
			$sql='SELECT * FROM articulo WHERE idarticulo= '.$id;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar');
				$con->cerrar();
				return FALSE;
			}
				
			if($fila[0][idarticulo]==$id){
			$con->cerrar();
			$clase= new Usuario ($fila[0][idarticulo],$fila[0][nombre],$fila[0][descripcion],$fila[0][precio]);

			return $clase;
			}	
         }
		 
         eliminarArticulo($idArticulo){
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if($con->conecta()==false)
				die('error de conexion');
			$sql='DELETE FROM servicio WHERE idarticulo= '.$id;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar');
				$con->cerrar();
				return FALSE;
				}
				
			$con->cerrar();
			return TRUE;
		 
         }
		 
         ReservarArticulo($idArticulo, $idUsuario){
		
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if(!$con->conecta())
				die('error conexion');
			$sql="INSERT INTO pedido(idArticulo,idUSuario,fechaReservacion,estado) VALUES ('$idArticulo','$idUsuario',CURDATE(),'pendiente') ";
			$resultado=$con->consulta($sql);
			if($resultado==false){
				die('error insercion');
				$con->cerrar();
				return FALSE;
				}
			$con->cerrar();
			return $this->id;
		 
         }
	
	filtrarArticulo($descripcion){
		$con= new Conexion ('localhost', 'root', 'root','maskota');
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM usuario WHERE CONCAT(nombre,descripcion,precio_venta) LIKE '%".$descripcion."%'";
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
	
         listar(){
			$conexion= new Conexion ('localhost', 'root', 'root','maskota');
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta('select * from articulo');	
			if($resultado==FALSE){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
			$conexion-> cerrar();
			return $resultado;
         }
         
	}
?>
