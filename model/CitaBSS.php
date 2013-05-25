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
			$sql="INSERT INTO cita(id_cliente,fecha,detalles,hora_reserva) VALUES ('$id',CURRENT_DATE(),'$detalles',CURTIME()) ";
	
			$resultado=$con->consulta($sql);
			
			$sql="INSERT INTO detalle_cita(id_cita,id_servicio) VALUES ('$resultado','$servicio') ";
	
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
		
        function buscarCita($idCita){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
			if($con->conecta()==false)
				die('error de conexion');
			$sql='SELECT * FROM cita WHERE id= '.$id;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar');
				$con->cerrar();
				return FALSE;
				}
				
			if($fila[0][id]==$id){
			$con->cerrar();
			$clase= new Cita ($fila[0][id],$fila[0][fecha],$fila[0][idPersona],$fila[0][estado],$fila[0][detalles],$fila[0][inicio],$fila[0][fin]);

			return $clase;
			}
			return false;
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

			$sql="UPDATE cita SET hora_termino = CURTIME( ) ,estado =  'fin'  WHERE id_cita =  '$idCita'";

			$resultado=$con->consulta($sql);
			if($resultado==false){
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
		$sql="SELECT id_cita as Cita,fecha,hora_reserva as Reservacion,detalles,id_cliente as Cliente FROM cita WHERE CONCAT(fecha,detalles,hora_reserva) LIKE '%".$descripcion."%'";
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
			$resultado = $conexion->consulta('select id_cita as Cita,fecha,hora_reserva as Reservacion,detalles,id_cliente as Cliente from cita');	
			if($resultado==FALSE){
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
