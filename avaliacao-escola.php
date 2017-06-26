<?php

  $servername="localhost";
  $username="root";
  $password="";
  $dbname = "acessibilidade_escolas";

  include("avaliacao-escola.html");

  try
  {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
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
