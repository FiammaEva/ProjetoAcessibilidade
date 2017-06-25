<?php

$servername="localhost";
$username="root";
$password="";
$dbname = "acessibilidade_escolas";

include("showresult.html");

try
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

  $municipio=$_GET['municipio'];
  $bairro=$_GET['bairro'];
  //echo $municipio;
  //echo $bairro;

  $sql = "SELECT nome_escola,dependencia_administrativa,bairro,endereco,telefone FROM escola_geral WHERE municipio='$municipio' AND bairro='$bairro' ORDER BY nome_escola ASC";

  $result = $conn->prepare($sql);
  try { $result->execute();}
  catch(PDOException $e){echo $e->getMessage();}

  if ($result->rowCount() > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $escola = $row["nome_escola"];
      $administracao = $row["dependencia_administrativa"];
      $bairro = $row["bairro"];
      $endereco = $row["endereco"];
      $telefone = $row["telefone"];
      ?>
      <script>
        var objPush = {};
        objPush.Escola = "<?php echo $escola; ?>";
        objPush.Administracao = "<?php echo $administracao; ?>";
        objPush.Bairro = "<?php echo $bairro; ?>";
        objPush.Endereco = "<?php echo $endereco; ?>";
        objPush.Telefone = "<?php echo $telefone; ?>";
        escolas.push(objPush);
      </script>
      <?php
    }
    ?>
    <script>
      $("#jsGrid").jsGrid({
        align: "center",
        width: "100%",
        height: "100%",

        inserting: false,
        editing: false,
        sorting: false,
        paging: false,

        data: escolas,

        rowClick: function(args) {
          window.location.href = "escola.php?escola=" + args.item.Escola +
            "&administracao=" + args.item.Administracao +
            "&bairro=" + args.item. Bairro +
            "&endereco=" + args.item.Endereco +
            "&telefone=" + args.item.Telefone;
        },

        fields: [
          { name: "Escola", type: "text", width: 150 },
          { name: "Administracao", type: "text", width: 60 },
          { name: "Bairro", type: "text", width: 100 },
          { name: "Endereco", type: "text", width: 180 },
          { name: "Telefone", type: "text", width:60 },
          { type: "textarea"}
        ]
      });
    </script>
    <?php
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
