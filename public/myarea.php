<?php require_once("../risorse/config.php"); ?>
<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['utente_loggato'])) {
    // L'utente non è loggato, reindirizza alla pagina di login
    header("Location: login.php");
    exit();
}

// Recupera l'email dell'utente dalla sessione
$email_utente = $_SESSION['email_utente'];

// Seleziona i dati dell'utente corrente dalla tabella "utenti"
$sql = "SELECT * FROM utenti WHERE email = ?";
$stmt = $connessione->prepare($sql);

if (!$stmt) {
    die('Errore nella preparazione della query: ' . $connessione->error);
}

$stmt->bind_param("s", $email_utente);

if (!$stmt->execute()) {
    die('Errore nell\'esecuzione della query: ' . $stmt->error);
}

$result = $stmt->get_result();
?>

<!-- Header -->
<?php include(FRONT_END . DS . 'header.php'); ?>
<!-- Main -->
<?php include(FRONT_END . DS . 'myarea.php'); ?>
<!-- Footer -->
<?php include(FRONT_END . DS . 'footer.php'); ?>
