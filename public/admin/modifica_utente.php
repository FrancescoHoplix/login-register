<?php
require_once("../../risorse/config.php");

// Verifica se l'utente è loggato
session_start();
if (!isset($_SESSION['utente_loggato']) || $_SESSION['utente_loggato'] !== true) {
    header("Location: login.php");
    exit();
}

// Recupera l'email dell'utente dalla sessione
$email_utente = $_SESSION['email_utente'];

// Seleziona il ruolo dell'utente dalla tabella "utenti"
$sql = "SELECT ruolo FROM utenti WHERE email = '$email_utente'";
$result = query($sql);

// Recupera l'ID dell'utente da modificare dalla richiesta GET o POST
$id_utente = $_REQUEST['id_utente'];

// Recupera i dati dell'utente da modificare
$sql_utente = "SELECT * FROM utenti WHERE id = $id_utente";
$result_utente = query($sql_utente);
$dati_utente = $result_utente->fetch_assoc();

// Se il modulo di aggiornamento è stato inviato
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['aggiorna'])) {
    // Recupera i nuovi dati dall'utente
    $nuovi_dati = [
        'nome' => $_POST['nuovo_nome'],
        'cognome' => $_POST['nuovo_cognome'],
        'email' => $_POST['nuovo_email'],
        'codice_fiscale' => $_POST['nuovo_codice_fiscale'],
        'indirizzo' => $_POST['nuovo_indirizzo'],
        'città' => $_POST['nuovo_città'],
        'cap' => $_POST['nuovo_cap'],
        'provincia' => $_POST['nuovo_provincia'],
        'ruolo' => $_POST['nuovo_ruolo'],
    ];

    // Crea un'istanza della classe Utente
    $utente = new Utente();

    // Esegui la funzione aggiornaUtente
    $aggiornamento_successo = $utente->aggiornaUtente($id_utente, $nuovi_dati);

    if ($aggiornamento_successo) {
        // Utente aggiornato con successo, gestisci di conseguenza
        header("Location: index.php"); // Reindirizza alla pagina admin
        exit();
    } else {
        // Errore nell'aggiornamento dell'utente, gestisci di conseguenza
        echo "Errore nell'aggiornamento dell'utente.";
    }
}
?>


<!-- Header -->
<?php include(FRONT_END . DS . 'header.php'); ?>

<!-- Main -->
<?php include(BACK_END . DS . 'inserisci_utente.php'); ?>

<!-- Footer -->
 <?php  include(FRONT_END . DS . 'footer.php'); ?>

