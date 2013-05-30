<?php
include_once('Conexion.php');
include_once('Cita.php');
  class CitaBSS{
		public $id;
		public $fecha;
		public $cliente;
		public $estado;
		public $detalles;
		public $hora_reserva;		
		public $hora_termino;		
        
		function agregarCita($id,  $detalles, $servicio){
			
			//conectarse a la base de datos
			$con= new Conexion (  );
			
			if(!$con->conecta())
				die('error conexion');
			//crear el query
			$sql="INSERT INTO cita(idPersona,fecha,detalles,inicio,estado) VALUES ('$id',CURRENT_DATE(),'$detalles',CURTIME(),'reservado') ";
	
			$resultado=$con->consulta($sql);
			
			$sql="INSERT INTO detalle_cita(idcita,idservicio) VALUES ('$resultado','$servicio') ";
	
			$resultado=$con->consulta($sql);
			
			if($resultado===false){
				die('error insercion');
				$con->cerrar();
				return FALSE;
				}
			$this -> id =$resultado;
			$con->cerrar();
			return $this->id;
			  
        }
		
        function buscarCita($id){
			$conexion= new Conexion (  );
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta("select fecha,inicio as Reservacion,detalles from cita WHERE idPersona = '$id'");	
			if($resultado===false){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
				$conexion-> cerrar();
			while($row = $resultado->fetch_array(MYSQLI_ASSOC))		{
		$obj[] = $row;		}		
			return $obj;
				
         }
		 
         function eliminarCita($idCita){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
			if($con->conecta()==false)
				die('error de conexion');
			$sql='DELETE FROM cita WHERE id= '.$id;
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
        function SerciviosCita($idCita){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
			if($con->conecta()==false)
				die('error de conexion');
			$sql='SELECT descripcion FROM detalle_cita as D,cita AS C,servicio as S WHERE D.idservicio=S.idServicio and D.idcita=C.idPersona and  C.id= '.$id;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar');
				$con->cerrar();
				return FALSE;
				}
			
			return $fila;
         }

        function ActualizarCita($idCita){
			$con= new Conexion (  );
			if(!$con->conecta())
				die('error conexion'.$conexion->errno);

			$sql="UPDATE cita SET fin = CURTIME( ) ,estado =  'fin'  WHERE idcita =  '$idCita'";

			$resultado=$con->consulta($sql);
			if($resultado===false){
				die('error actualizar cita');
				$con->cerrar();
				return FALSE;
				}

			return true;
		}
			
       function filtrarCita($descripcion){
		$con= new Conexion (  );
	
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT a.idcita as Cita,a.fecha,a.inicio as Reservacion,a.detalles,b.email as Cliente FROM cita as a,usuario as b WHERE b.idPersona=a.idPersona and CONCAT(fecha,detalles, inicio) LIKE '%".$descripcion."%'";
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
			$con-> cerrar();
			while($row = $fila->fetch_array(MYSQLI_ASSOC))		{
		$obj[] = $row;		}		
			return $obj;
				
			
			
         }
		 
		 
         function listar(){
			$conexion= new Conexion (  );
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta('select  a.idcita as Cita,a.fecha, a.inicio as Reservacion,a.detalles,b.email as Cliente from cita as a,usuario as b where a.idPersona=b.idPersona');	
			if($resultado===false){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
				$conexion-> cerrar();
			while($row = $resultado->fetch_array(MYSQLI_ASSOC))		{
		$obj[] = $row;		}		
			return $obj;
				
			
         }
			

	}
?>
