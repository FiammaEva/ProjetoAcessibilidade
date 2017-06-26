<?php

  $servername="localhost";
  $username="root";
  $password="";
  $dbname = "acessibilidade_escolas";
  $codigo=100;

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

		// Check if Questionario already answered
		if(!empty($_GET['guia'])){

      // Get codigo da escola
      $sql = "SELECT codigo_escola FROM escola_geral WHERE nome_escola = '$escola'";

      $result = $conn->prepare($sql);
      try { $result->execute();}
      catch(PDOException $e){echo $e->getMessage();}

      if ($result->rowCount() > 0) {
        // output data of each row
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $codigo=$row["codigo_escola"];
          ?><script>
            //alert("1 result: " + <?php echo $codigo; ?>);
          </script><?php
        }
      }
      else {
        echo "0 results";
      }
      // Insere questionario da escola
      $escola_id=$codigo;
      $guia = $_GET['guia'];
      $escada = $_GET['escada'];
      $rampa = $_GET['rampa'];
      $elevador = $_GET['elevador'];
      $surdo = $_GET['surdo'];
      $cego = $_GET['cego'];
      $mudo = $_GET['mudo'];
      $banheiro = $_GET['banheiro'];
      $bebedouro = $_GET['bebedouro'];
      $biblioteca = $_GET['biblioteca'];
      $sinalizacao = $_GET['sinalizacao'];
      $laboratorio = $_GET['laboratorio'];

      $sql = "INSERT INTO escola_resultado (escola_id, usuario_id, guia, escada, rampa, elevador, surdo, cego, mudo, banheiro, bebedouro, biblioteca, sinalizacao, laboratorio) VALUES ('$escola_id', 1, '$guia', '$escada', '$rampa', '$elevador', '$surdo', '$cego', '$mudo', '$banheiro', '$bebedouro', '$biblioteca', '$sinalizacao', '$laboratorio')";

      $result = $conn->prepare($sql);
      try { $result->execute();}
      catch(PDOException $e){echo $e->getMessage();}

      ?><script>
        alert("A sua avaliação foi armazenada com sucesso. Obrigado!");

        window.location.href = "avaliacao-escola.php?escola_id=" + <?php echo $escola_id; ?> +
          "&escola=" + "<?php echo $_GET['escola']; ?>" +
          "&administracao=" + "<?php echo $_GET['administracao']; ?>" +
          "&bairro=" + "<?php echo $_GET['bairro']; ?>" +
          "&endereco=" + "<?php echo $_GET['endereco']; ?>" +
          "&telefone=" + "<?php echo $_GET['telefone']; ?>";
      </script><?php

		} else {
				echo "0 results";
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
