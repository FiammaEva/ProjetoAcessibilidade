<?php

  $servername="localhost";
  $username="root";
  $password="";
  $dbname = "acessibilidade_escolas";

  include("escola.html");

  try
  {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

    $escola=$_GET['escola'];
    $administracao=$_GET['administracao'];
    $bairro=$_GET['bairro'];
    $endereco=$_GET['endereco'];
    $telefone=$_GET['telefone'];

    ?><script>
        //$( "#dropdown-municipio" ).append( "<option value='ola'> ola </option>" );

        $( "#escola-titulo" ).append( "<h2> <?php echo $escola ?> </h2>" );

        //$( "#form-buscar" ).append( "<p> <?php echo $escola ?> </p>" );
        $( "#escola-info-geral" ).append( '<p align="left"> Administração: <?php echo $administracao ?> </p>' );
        $( "#escola-info-geral" ).append( '<p align="left"> Bairro: <?php echo $bairro ?> </p>' );
        $( "#escola-info-geral" ).append( '<p align="left"> Endereço: <?php echo $endereco ?> </p>' );
        $( "#escola-info-geral" ).append( '<p align="left"> Telefone: <?php echo $telefone ?> </p>' );

    </script><?php
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
