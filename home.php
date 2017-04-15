<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
  $dbname = "acessibilidade_escolas";

	include("home.html");

	try
	{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";

   	$sql = "SELECT DISTINCT municipio FROM escola_geral ORDER BY municipio ASC";

		$result = $conn->prepare($sql);
    try { $result->execute();}
    catch(PDOException $e){echo $e->getMessage();}

		if ($result->rowCount() > 0) {
			// output data of each row
			while($row = $result->fetch(PDO::FETCH_ASSOC)) {
				//echo "Bairro: " . $row["bairro"]. "<br>";
				?><script>
					$( ".form-control" )
						.append( "<option> <?php echo $row["municipio"]; ?> </option>" );
				</script><?php
			}
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
