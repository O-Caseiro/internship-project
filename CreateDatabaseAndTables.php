<html>
	<head>
	</head>
	<body>
		<?php
			$link = mysqli_connect("localhost", "root", "");
 
			if(!$link){
				echo "Error Connecting";
				die("ERROR: Could not connect. " . mysqli_connect_error());
			} else {
				echo "Successfully connected!";
			}

			if(mysqli_query($link, "CREATE DATABASE style DEFAULT COLLATE utf8_general_ci")){
				echo "Database successfully created!\n";
			} else {
				echo "Error creating db.";
			}

			if (mysqli_select_db($link, "style")){
				echo "Database selected successfully.";
			} else {
				echo "Não foi possivel escolher uma db.";
				die("Não foi possivel escolher uma db.\n");
			}

			$query = "CREATE TABLE client (
			ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			nome VARCHAR(255) NOT NULL
			)";
			
			if(mysqli_query($link, $query)){
					echo "Table successfully created.\n";
				} else {
					echo "Error creating table.";
				}

			$query = "CREATE TABLE style (
			ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			flexFlow VARCHAR(255) NOT NULL,
			height VARCHAR(255) NOT NULL,
			width VARCHAR(255) NOT NULL,
			fontFamily VARCHAR(255) NOT NULL,
			fontSize VARCHAR(255) NOT NULL,
			color VARCHAR(255) NOT NULL,
			border VARCHAR(255) NOT NULL,
			borderRadius VARCHAR(255) NOT NULL,
			fontWeight VARCHAR(255) NOT NULL,
			background VARCHAR(255) NOT NULL,
			IDClient INT(255) NOT NULL,
			descricao VARCHAR(255) NOT NULL
			)";
			
			if(mysqli_query($link, $query)){
					echo "Table successfully created.\n";
				} else {
					echo "Error creating table.";
				}

			mysqli_close($link);
		?>
	</body>
</html>