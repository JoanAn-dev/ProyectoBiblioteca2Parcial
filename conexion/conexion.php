<?php
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "Miguel.1";
   $dbname = "biblioteca";
   
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   
   if (!$conn) {
    die("Error al conectar la base de datos ERROR: ".mysqli_connect_error());
   }/*else {
    echo("Conexion exitosa");
   }*/
?>

