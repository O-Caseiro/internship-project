<?php
	//Connecting to sql db.
	$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");

	mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

	$formID = mysqli_real_escape_string($connect,$_POST["elIDRestore"]);

	$query = "SELECT flexFlow,height,width,fontFamily,fontSize,color,border,borderRadius,fontWeight,background FROM style WHERE ID=$formID";
	$result=mysqli_query($connect,$query);

	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	echo json_encode($row);

	mysqli_close($connect);
?>