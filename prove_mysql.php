<?php
  $servername = 'localhost';
  $uname = 'root';
  $password = '';
  $db_name = 'db_prove';

  $conn = mysqli_connect($servername, $uname, $password, $db_name);

  if(!$conn)
    die('Connessione fallita: ' . mysqli_connect_error());

  $sql = "INSERT INTO tab1 VALUES('Lol', 'Lol1', 'Lol2')";
  if(mysqli_query($conn, $sql))
    echo 'Nuovo record inserito con successo <br/>';
  else
    echo 'Errore: ' . mysqli_error($conn);

?>
