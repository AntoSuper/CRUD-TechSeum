<?php

require_once(__DIR__.'/../protected/headers.php');
require_once(__DIR__.'/../protected/functions.php');
require_once(__DIR__.'/../protected/check_session.php');
require_once(__DIR__.'/../protected/connessioneDB.php');


// Per richieste tramite JSON e non tramite FORM utilizzare, in seguito al decommento della seguente riga, $credenziali["username"] $credenziali["password"] $credenziali["nome"] $credenziali["cognome"] $credenziali["amministratore]
// $credenziali = json_decode(file_get_contents('php://input'), true);

if(!isset($_POST['username']) or !isset($_POST['password']) or !isset($_POST['nome']) or !isset($_POST['cognome'])) {
    err('Username o password mancanti', __LINE__);
}


// Utilizzo del try - catch per eventuali errori nella query, BIND per evitare SQL INJECTION
try{
    $query = $db -> prepare('INSERT INTO techseum.utenti(username, password, nome, cognome, amministratore) VALUES (:username, :password, :nome, :cognome, :amministratore);'); // PDO
    $query -> bindValue(':username', $_POST['username']); 
    $query -> bindValue(':password', $_POST['password']);
    $query -> bindValue(':nome', $_POST['nome']); 
    $query -> bindValue(':cognome', $_POST['cognome']); 
    $query -> bindValue(':amministratore', $_POST['amministratore']); 
    $query -> execute();
  
    echo '{"status":1, "data":"Utenza creata"}';
    exit();

} catch(PDOException $ex) {
    err("Errore nell'esecuzione della query", __LINE__);
}