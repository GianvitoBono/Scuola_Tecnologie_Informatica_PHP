<html>
	<head>
		<title>Controllo Form</title>
	</head>
	<body style="text-align: center;">
		<h1>Controllo Form</h1><br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
			<label>Nome utente	:		<input type="text" name="user"></label>
			<label>Password		:		<input type="password" name="pass"></label><br>
			<input type="submit" name="send" value="INVIA"><br>
		</form>
		<?php 
			isset($_POST["user"])? $user = test_input($_POST["user"]) : $user = null;
			isset($_POST["pass"])? $pass = test_input($_POST["pass"]) : $pass = null;
			
			if($user != null && $pass != null)	
				if($user == "user" && $pass == "pass")
					echo "<h1>Accesso Consentito!!!</h1>";
				else
					echo "<h1>Accesso Negato!!!</h1>";
				
			function test_input($data) {
				$data = trim($data);
				$data = stripcslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
	</body>
</html>