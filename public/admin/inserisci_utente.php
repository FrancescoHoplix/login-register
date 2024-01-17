<?php
require_once("../../risorse/config.php");


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    // Recupera i dati dal modulo
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $codiceFiscale = $_POST['codice_fiscale'];
    $email = $_POST['email'];
    $confermaEmail = $_POST['conferma_email'];
    $indirizzo = $_POST['indirizzo'];
    $citta = $_POST['citta'];
    $cap = $_POST['cap'];
    $provincia = $_POST['provincia'];
    $password = $_POST['password'];
    $ruolo = $_POST['ruolo'];

    // Crea un'istanza della classe Utente
    $utente = new Utente();

    // Esegui la funzione per inserire l'utente
    $utente->inserisciUtente($nome, $cognome, $codiceFiscale, $email, $confermaEmail, $indirizzo, $citta, $cap, $provincia, $password, $ruolo);

    // Puoi reindirizzare a una pagina specifica dopo l'inserimento
    header("Location: ../index.php");
    exit();
}
?>

<!--Header-->
<?php include(FRONT_END . DS . 'header.php'); ?>

<!--Main-->
<?php include(BACK_END . DS . 'inserisci_utente.php'); ?>

<!-- Footer -->
<?php  include(FRONT_END . DS . 'footer.php'); ?>

