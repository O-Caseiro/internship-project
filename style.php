<?php
	//Connecting to sql db.
	$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");
	mysqli_set_charset($connect, "utf8");

	mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

	if ( ! empty(mysqli_real_escape_string($connect,$_POST['descricao']))){			
    	$flexFlow = mysqli_real_escape_string($connect,$_POST['flexFlow']);
		$height = mysqli_real_escape_string($connect,$_POST['height']);
		$width = mysqli_real_escape_string($connect,$_POST['width']);
		$fontFamily = mysqli_real_escape_string($connect,$_POST['fontFamily']);
		$fontSize = mysqli_real_escape_string($connect,$_POST['fontSize']);
		$color = mysqli_real_escape_string($connect,$_POST['color']);
		$border = mysqli_real_escape_string($connect,$_POST['border']);
		$borderRadius = mysqli_real_escape_string($connect,$_POST['borderRadius']);
		$fontWeight = mysqli_real_escape_string($connect,$_POST['fontWeight']);
		$background = mysqli_real_escape_string($connect,$_POST['background']);
		$IDClient = mysqli_real_escape_string($connect,$_POST['IDClient']);
		$descricao = mysqli_real_escape_string($connect,$_POST['descricao']);
    	//Sending form data to sql db.
		mysqli_query($connect,"INSERT INTO style(
			flexFlow,
			height,
			width,
			fontFamily,
			fontSize,
			color,
			border,
			borderRadius,
			fontWeight,
			background,
			IDClient,
			descricao
		) VALUES(
			'$flexFlow',
			'$height',
			'$width',
			'$fontFamily',
			'$fontSize',
			'$color',
			'$border',
			'$borderRadius',
			'$fontWeight',
			'$background',
			'$IDClient',
			'$descricao'
		)");
	}

	$query = "SELECT * FROM client ORDER BY nome ASC";
	$result=mysqli_query($connect,$query);
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
		echo "<option value='".$row['ID']."'>".$row['nome']."</option>";
	};
	mysqli_close($connect);
?>