<?php
	//Connecting to sql db.
	$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");
	mysqli_set_charset($connect, "utf8");

	mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

	if ( ! empty(mysqli_real_escape_string($connect,$_POST['name']))){			
    	$name = mysqli_real_escape_string($connect,$_POST['name']);
    	//Sending form data to sql db.
		mysqli_query($connect,"INSERT INTO client(nome) VALUES('$name')");
	}

	$query = "SELECT * FROM client ORDER BY nome ASC";
	$result=mysqli_query($connect,$query);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
		echo "<option value='".$row['ID']."'>".$row['nome']."</option>";
	};
	mysqli_close($connect);
?>