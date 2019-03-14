<?php
	//Connecting to sql db.
	$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");

	mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

	$clientID = mysqli_real_escape_string($connect,$_POST["varClientID"]);

	mysqli_query($connect,"DELETE FROM style WHERE IDClient=$clientID");
	mysqli_query($connect,"DELETE FROM client WHERE ID=$clientID");

	$query = "SELECT * FROM client ORDER BY nome ASC";
	$result=mysqli_query($connect,$query);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
		echo "<option value='".$row['ID']."'>".$row['nome']."</option>";
	};

	mysqli_close($connect);
?>