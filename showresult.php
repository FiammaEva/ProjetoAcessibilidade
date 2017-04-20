<?php

$servername="localhost";
$username="root";
$password="";

//include("home.html");

try
{
   $conn = new PDO("mysql:host=$servername;dbname=acessibilidade_escolas", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connected successfully";
   echo $_GET['municipio'];
   echo $_GET['bairro'];
}
catch(PDOException $e)
{
   echo "Connection failed: " . $e->getMessage();
}
finally
{
  //$conn->close();
  $sql = null;
  $result = null;
  $conn = null;
}
?>
