<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBss.php');
include_once('ModeloCtl.php');
	class ModeloCtl extends ModeloCtl{
		/**
		*funciones que comprueban la valides de las cadenas
		*true si cumple, false sino
		**/
		function EsNombre($string){
			$expresion='/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/';
			if (preg_match($expresion, $string)) {
				return true;
			}else
				return false
		}
		
		function EsCalle($string){
			$expresion='/[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)* (((#|[nN][oO]\.?) ?)?\d{1,4}(( ?[a-zA-Z0-9\-]+)+)?)/';
			if (preg_match($expresion, $string)) {
				return true;
			}else
				return false
		}
		
		function EsTelefono($string){
			$expresion='/0{0,2}([\+]?[\d]{1,3} ?)?([\(]([\d]{2,3})[)] ?)?[0-9][0-9 \-]{6,}( ?([xX]|([eE]xt[\.]?)) ?([\d]{1,5}))?/';
			if (preg_match($expresion, $string)) {
				return true;
			}else
				return false
		}
		
		function EsMail($string){
			$expresion='/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
			if (preg_match($expresion, $string)) {
				return true;
			}else
				return false
		}
		
		function EsId($string){
			if(is_int($tring))
				return true;
			else
				return false;
		
		}
			
		
		
	}




?>
