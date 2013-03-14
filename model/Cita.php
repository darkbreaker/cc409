<?php
  class Cita{
		public $id;
		public $fecha;
		public $cliente;
		public $estado;
		public $detalles;
		public $hora_reserva;		
		public $hora_termino;		
		
			function __construct($id, $fecha, $cliente, $estado, $detalles,$hora_reserva, $hora_termino){
			$this-> id = $id;
			$this -> fecha = $fecha;
			$this -> cliente = $cliente;
			$this -> estado = $estado;			
			$this -> detalles = $detalles;				
			$this -> hora_reserva = $dhora_reserva;	
			$this -> hora_termino = $hora_termino;	                   
		}

	}
?>
