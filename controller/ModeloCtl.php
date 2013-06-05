<?php
	class ModeloCtl {
		/**
		*funciones que comprueban la valides de las cadenas
		*$string si cumple, false sino
		**/
		function EsNombre($string){
			$expresion='/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/';
			if (preg_match($expresion, $string)) {
				return $string;
			}else
				return false;
		}
		
			function EsFecha($string){
			$expresion='/^(19|20)[0-9]{2}(-|\/)(0[1-9]{1}|1[0-2])(-|\/)[0-2]{1}[0-9]{1}$/';
			if (preg_match($expresion, $string)) {
				return $string;
			}else
				return false;
		}
		
		function EsHora($string){
			$expresion='/([0-1][0-9])(:[1-5][0-9]){2,3}$/';
			if (preg_match($expresion, $string)) {
				return $string;
			}else
				return false;
		}
		
		function EsCalle($string){
			$expresion='/[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)* (((#|[nN][oO]\.?) ?)?\d{1,4}(( ?[a-zA-Z0-9\-]+)+)?)/';
			if (preg_match($expresion, $string)) {
				return $string;
			}else
				return false;
		}
		
		function EsTelefono($string){
			$expresion='/0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?/';
			if (preg_match($expresion, $string)) {
				return $string;
			}else
				return false;
		}
		
		function EsMail($string){
			$expresion='/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
			if (preg_match($expresion, $string)) {
				return $string;
			}else
				return false;
		}
		
		function EsId($string){
			if(is_int($tring))
				return $string;
			else
				return false;
		
		}
			
		function EsNo($string){
			if(is_numeric($tring))
				return $string;
			else
				return false;
		
		}
		
		function mostrar($file){
		if(@session_start() == false){session_destroy();session_start();}
			if(isset($_SESSION['usuario'])){
				$file = str_ireplace('{Username}',$_SESSION['nombre'], $file); 
				$file = str_ireplace('>Login<','>Log out<' , $file); 
				$file = str_ireplace('>Registro<','>Modificar<' , $file); 
			}else{
				$file = str_ireplace('>{Username}<','><' , $file); 
				$file = str_ireplace('>Citas<','><' , $file);
			}
			echo $file;	
		}

	}
?>