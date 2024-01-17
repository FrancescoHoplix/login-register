<?php require_once("../risorse/config.php"); ?>
<?php
session_start(); // Avvia la sessione

// Verifica se l'utente è già loggato, in tal caso reindirizza a myarea.php
if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) {
    header("Location: myarea.php");
    exit();
}

// Se il modulo di login è stato inviato
if (isset($_POST['login'])) {
    // Recupera le credenziali inviate tramite il modulo
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Crea un'istanza della classe Utente
    $utente = new Utente();

    // Esegui la funzione effettuaLogin
    $utente->effettuaLogin($email, $password);
}

?>
<?php  include(FRONT_END . DS . 'header.php'); ?>
<?php  include(FRONT_END . DS . 'login.php'); ?>
   
          <!-- Footer -->
    <?php  include(FRONT_END . DS . 'footer.php'); ?>