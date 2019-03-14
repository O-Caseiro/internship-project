<?php
	//Connecting to sql db.
	$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");

	mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

	$formID = mysqli_real_escape_string($connect,$_POST["elIDDelete"]);

	mysqli_query($connect,"DELETE FROM style WHERE ID=$formID");

	mysqli_close($connect);
?>