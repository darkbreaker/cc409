<?php
	class DefaultCtl{
		function ejecutar(){
			 
			if(isset($_SESSION['usuario'])){
						$file = file_get_contents('view/Index.html'); 						
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); $file = str_ireplace('>Login<','>Log out<' , $file); 
						echo $file;}
					else
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion'); echo $file;
						
		}

	}


?>
