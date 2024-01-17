<?php
session_start();

// Distruggi tutte le variabili di sessione
$_SESSION = array();

// Cancella il cookie di sessione, se presente
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Distruggi la sessione
session_destroy();

// Reindirizza l'utente alla pagina di login o a un'altra pagina dopo il logout
header("Location: login.php");
exit();
?>
