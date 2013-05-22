<?php
  class Pedido{
		public $idReservacion;
		public $idArticulo;
		public $idUsuario;
		public $fechaReservacion;
		public $estado;
		
		
		
			function __construct($idReservacion, $idArticulo, $idUsuario, $fechaReservacion, $estado){
			$this-> idReservacion = $idReservacion;
			$this -> idArticulo = $idArticulo;
			$this -> idUsuario = $idUsuario;
			$this -> fechaReservacion = $fechaReservacion;			
			$this -> estado = $estado;				
                   
		}

	}
?>
