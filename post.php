<html>
	<head>
		<title>Metodo POST</title>
	</head>
	<body style="text-align: center;">
		<h1>Prove metodo POST e gestione dati in ingresso da un form</h1><br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
			<label>Nome utente	:		<input type="text" name="user"></label>
			<label>Password		:		<input type="password" name="pass"></label><br>
			<input type="submit" name="send" value="INVIA"><br>
		</form>
		<?php 
			isset($_POST["user"])? $user = $_POST["user"] : $user = null;
			isset($_POST["pass"])? $pass = $_POST["pass"] : $pass = null;
			
			if($user != null && $pass != null)	
				if($user == "user" && $pass == "pass")
					echo "<h1>Accesso Consentito!!!</h1>";
				else
					echo "<h1>Accesso Negato!!!</h1>";
		?>
	</body>
</html>