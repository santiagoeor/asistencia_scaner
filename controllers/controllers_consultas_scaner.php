<?php
session_start();
require_once( "../models/models_admin.php");

class ConsultasDB extends DBConfig {
    					
	function consulta_generales($sql){
		$this->config();
		$this->conexion(); 
		  
  		$records = $this->Consultas($sql);		 		  		  		  

  		$this->close();		
		return $records;				
	}
}


/**
* IMPLEMENTACION DE ACCESO A CONSULTAS PARA PROTEGER MAS LA VISTA
*/
class ExtraerDatos extends ConsultasDB
{
	//Detalle de personas
	function personasPorId($nombre, $fecha, $start = 0, $regsCant = 0){
		$sql = "SELECT * from registros where nombre='$nombre' AND fecha='$fecha'";
		if ($regsCant > 0)
			  $sql = "SELECT * from registros where nombre='$nombre' AND fecha='$fecha' $start, $regsCant";
		$lista = $this->consulta_generales($sql);	
		return $lista;
	}

	//MUESTRA LISTADO DE Personas
	function listadopersonas($start=0, $regsCant = 0){
		$sql = "SELECT * FROM registros";
		if ($regsCant > 0 )
			 $sql = "SELECT * from registros $start,$regsCant";
		$lista = $this->consulta_generales($sql);	
		return $lista;
	}
	
	//listado usuarios

	function listadoUsuarios($start=0, $regsCant = 0){
		$sql = "SELECT * FROM info_usuarios";
		if ($regsCant > 0 )
			 $sql = "SELECT * from info_usuarios $start,$regsCant";
		$lista = $this->consulta_generales($sql);	
		return $lista;
	}

		//Detalle de usuarios
		function usuariosPorId($idFilter, $start = 0, $regsCant = 0){
			$sql = "SELECT * from info_usuarios where id=$idFilter";
			if ($regsCant > 0)
				  $sql = "SELECT * from info_usuarios where id=$idFilter $start, $regsCant";
			$lista = $this->consulta_generales($sql);	
			return $lista;
		}


	// ****************************************************************************
	// Agregue aqui debajo el resto de Funciones - Se ha dejado  Listado y detalle
	// ****************************************************************************

	

	
}//fin CLASE

// $objDB = new ExtraerDatos();

// $q = 'santiago';
// $fech = '2023-02-13';
//   $prods = array();
//   $prods = $objDB->personasPorId($q, $fech);

//     if($prods== 0){
// 	echo 'no hay';
//   }else{
// 	echo 'si hay';
//   }

?>