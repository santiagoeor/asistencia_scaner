<?php
date_default_timezone_set("America/Bogota");
function fecha (){
  $fechaVenta = date('Y/m/d');
 // echo date(DATE_RFC2822);
 $f = explode('/', $fechaVenta);
  return $fecha_sql = $f[0]."-".$f[1]."-".$f[2];
}
// get the q parameter from URL
$fecha = fecha();
$horaActual = date('h:i:s');
$q = $_REQUEST["q"];

//$hint = "";
//servidor local
$con = mysqli_connect('localhost','root','123456789','db_scaner');
//Servidor web

if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// lookup all hints from array if $q is different from ""
if ($q !="") {
  /*$q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }*/
$result=mysqli_query($con,"SELECT * FROM registros WHERE nombre='$q' AND fecha='2023-02-13'");
$rowcount=mysqli_num_rows($result);
if($rowcount==0){
$ret=mysqli_query($con,"INSERT INTO `registros`(nombre,fecha, hora) VALUES ('$q','$fecha','$horaActual')");
if($ret)
{
echo '<div class="alert alert-success"><strong>Success!</strong>Persona registrada</div> '+date('l jS \of F Y h:i:s A'); 
?>
<?php }
else
{

}
}else{
//echo 'employee is already registered';  
echo '<div class="alert alert-success"><strong>Success!</strong>Ya se registro</div>';


  }

}else{
  echo 'Envia algo';
}

// Output "no suggestion" if no hint was found or output correct values
//echo $hint === "" ? "no suggestion" : $hint;
?>
