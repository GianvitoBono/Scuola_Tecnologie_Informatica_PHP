<?php

	/* La funzione get_connection ritorna una connessione ad un database se riesce con *
	 * successo oppure null se la connessione non va a buon fine. 					   */	

	function get_connection($senvername, $username, $password, $db_name) {
		// Creazione della connessione.
		$conn = mysqli_connect($servername, $username, $password, $db_name);
		
		// Verifica della connessione
		if (!$conn) {
			die("[-] Connessione fallita: " . mysqli_connect_error());
			return null;
		}
		
		return $conn;
	}
	
	//---------------------------------------------------------------------------------------------//
	
	/* Funzione per effettuare l'escaping del testo per non generare falle di *
	 * sicurezza nel sito e problemi di XSS o problemi col database.		  */
	
	function test_input($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	//---------------------------------------------------------------------------------------------//
	
	/* Esempio di una query per mandare correttamente ed in sicurezza dati presi da *
	 * un form usando i Prepared Statement.											*/
	
	function esempio_query_con_prepared_statement() {
		/* Queste espressioni qui sotto sono delle if compatte che essegnano il valore del 	  *
		 * $_POST se è settato (quindi se l'isset da vero) se no assegnano null.			  *
		 * Funzionamento if compatto:														  *			
		 * Condizione ? VERO : FALSO; Questo si può usare anche per assegnare dei valori come *
		 * in questo caso.																	  */
		
		$nome = isset($_POST['nome']) ? test_input($_POST['nome']) : null;
		$cognome = isset($_POST['cognome']) ? test_input($_POST['cognome']) : null;
		$email = isset($_POST['email']) ? test_input($_POST['email']) : null;
		
		$conn = get_connection("localhost", "mysql_uname", "mysql_password", "db_persone");
		
		//Creazione dello Statement stmd
		
		$stmt = $conn->prepare("INSERT INTO persone (nome, cognome, email) VALUES (?, ?, ?)"); //I punti di domanda nella query sevono per il successivo inserimento di parametri.
		$stmt->bind_param("sss", $nome, $cognome, $email);     
		
		/* La funzione bind_param serve, come da nome, ad assegnare i valori alla query dello statement. *
		 * Il primo parametro della bind_param rappresenta il tipo del parametro: s = Stringa, i = Integer, b = BLOB, d = Double;   *
		 * Per ogni parametro (? nello statement) deve essere inserito il tipo nella bind_param per esempio se i parametri sono tre *
		 * stringhe come nell'esempio qui sopre bisognerà inserire "sss" come parametro iniziale 								    */
		
		 $stmt->execute(); //Con questa funzione la query viene eseguita
		 
		 //Chiusura statment e connessione
		 $stmt->close();
		 $conn->close();
		
	}
	
	//---------------------------------------------------------------------------------------------//
	
	/* Esempio SELECT tramite PHP e messa in una tabella con HTML */
	
	function esempio_select() {
		$conn = get_connection("localhost", "mysql_uname", "mysql_password", "db_persone");
		
		$sql = "SELECT nome, cognome, email FROM persone";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) { //Controllo numero di risultati della SELECT
			// Con questo ciclo estraggo una riga per volta messa nell'array associativa $row, gli indici sono le intestazzioni della table nel database
			echo "<table>";
			echo "		<tr><td>Nome</td><td>Cognome</td><td>Email</td></tr>"; //Apro il tag table e creo la prima riga per l'intestazione delle colonne
			while($row = $result->fetch_assoc()) {
				echo "		<tr><td>".$row['nome']."</td><td>".$row['cognome']."</td><td>".$row['email']."</td></tr>"; //Per ogni riga scaricata dal database creo una riga nella table in HTML.
			}
			echo "</table>"; //Chiudo la tabella.
		} else {
			echo "Nessun risultato"; //Se il numero dei risultati è 0 stampa questo
		}
	}
	
?>