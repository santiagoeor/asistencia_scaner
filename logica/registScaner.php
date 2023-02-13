<?php

require("../models/models_admin.php");
date_default_timezone_set("America/Bogota");
include "../controllers/controllers_consultas_scaner.php";

function fecha (){
    $fechaVenta = date('Y/m/d');
   // echo date(DATE_RFC2822);
   $f = explode('/', $fechaVenta);
    return $fecha_sql = $f[0]."-".$f[1]."-".$f[2];
  }

$fecha = fecha();
$horaActual = date('h:i:s');

$q = $_REQUEST["q"];

// echo $q;

$objDB = new ExtraerDatos();

  $prods = array();
  $prods = $objDB->personasPorId($q, $fecha);

$objDBO = new DBConfig();
$objDBO->config();
$objDBO->conexion();

    if($prods == 0){

      $ejecucion = $objDBO->Operaciones("INSERT INTO registros(nombre,fecha, hora) VALUES ('$q','$fecha','$horaActual')");

      if($ejecucion){
          echo 'Registrado';
      }else{
          echo "Fallo del server";
      }
      
    }else{
      
      echo 'ya esta registrado';
   

    

  }

  $objDBO->close();
?>