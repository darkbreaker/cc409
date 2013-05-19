<?php

	class DefaultCtl{
		function ejecutar(){
			session_start();
			if(isset($_SESSION['usuario'])){
						$file = file_get_contents('view/Index.html'); //cargo el archivo
						$file = str_ireplace('{Username}',$_SESSION['nombre'] , $file); //tomo {titulo} y lo reemplazo por lo que quiera
						echo $file;}
					else
						include('view/Index.html');
						
		}

	}


?>
