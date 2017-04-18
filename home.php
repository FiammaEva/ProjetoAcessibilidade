<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
  $dbname = "acessibilidade_escolas";
	$municipio = "";

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
				?><script>
					$( "#dropdown-municipio" )
						.append( "<option value='<?php echo $row["municipio"]; ?>'> <?php echo $row["municipio"]; ?> </option>" );
				</script><?php
			}
		} else {
			echo "0 results";
		}

		if(!empty($_GET['municipio'])){ // If you are using same page, then it'll help you to detect ajax request.

			$municipio =  $_GET['municipio'];
			$sql = "SELECT DISTINCT bairro FROM escola_geral WHERE municipio='$municipio' ORDER BY bairro ASC";

			$result = $conn->prepare($sql);
	    try { $result->execute();}
	    catch(PDOException $e){echo $e->getMessage();}

			if ($result->rowCount() > 0) {
				// output data of each row
				while($row = $result->fetch(PDO::FETCH_ASSOC)) {
					?><script>
						$( "#dropdown-bairro" )
							.append( "<option value='<?php echo $row["bairro"]; ?>'> <?php echo $row["bairro"]; ?> </option>" );
					</script><?php
				}
			} else {
				echo "0 results";
			}
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
