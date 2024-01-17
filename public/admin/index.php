<?php require_once("../../risorse/config.php"); ?>
<?php
session_start();

// Ottieni il numero totale di utenti
$sql_n = "SELECT COUNT(*) as totalUtenti FROM utenti";
$result = query($sql_n);
$row_n = $result->fetch_assoc();
$totalUtenti = $row_n['totalUtenti'];

// Verifica se l'utente è loggato
if (!isset($_SESSION['utente_loggato'])) {
    // L'utente non è loggato, reindirizza alla pagina di login
    header("Location: ../login.php");
    exit();
}

// Recupera l'email dell'utente dalla sessione
$email_utente = $_SESSION['email_utente'];

// Seleziona il ruolo dell'utente dalla tabella "utenti"
$sql = "SELECT ruolo FROM utenti WHERE email = '$email_utente'";
$result = query($sql);
// Seleziona tutti i dati dalla tabella "utenti"

// Verifica se l'utente ha il ruolo "admin"
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $ruolo_utente = $row['ruolo'];

    if ($ruolo_utente !== 'admin') {
        // L'utente non ha il ruolo "admin", reindirizza a una pagina di errore o altrove
        header("Location: errore.php"); 
        exit();
    }
} 
?>

    <!-- Header -->
    <?php include(FRONT_END . DS . 'header.php'); ?>

     <!-- Main -->
    <?php include(BACK_END . DS . 'index.php'); ?>

    <!-- Footer -->
    <?php  include(FRONT_END . DS . 'footer.php'); ?>