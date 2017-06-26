<?php

  $servername="localhost";
  $username="root";
  $password="";
  $dbname = "acessibilidade_escolas";
  $guia=0;

  include("avaliacao-escola.html");

  try
  {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

    $codigo=$_GET['escola_id'];
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

    $sql = "SELECT COUNT(*) AS guia_total FROM escola_resultado WHERE guia='SIM' AND escola_id='1'";

		$result = $conn->prepare($sql);
    try { $result->execute();}
    catch(PDOException $e){echo $e->getMessage();}

		if ($result->rowCount() > 0) {
			// output data of each row
		    $row = $result->fetch(PDO::FETCH_ASSOC);
        $guia=$row["guia_total"];
				?><script>
			     //alert("Ola: " + <?php echo $guia; ?>);
				</script><?php

    }
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
