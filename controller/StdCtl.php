<?php
//controlador requiere tener acceso al modelo

	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo usuario
		function __construct(){
			//$this->modelo = new usuarioBss();
		}

		function ejecutar(){
			//si no tengo parametros se listan los usuarios
			if(!isset($_REQUEST['accion']) ){
				
			}
			
		}

	}




?>