<?php require_once("../risorse/config.php");?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utente = new Utente();
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

    if ($email !== $confermaEmail) {
        // Se le email non coincidono, reindirizza a error.php
        header("Location: error.php");
        exit();  // Assicurati di chiamare exit() dopo header()
    }

    // Altrimenti, se le email coincidono, registra l'utente
    $utente->registraUtente($nome, $cognome, $codiceFiscale, $email, $confermaEmail, $indirizzo, $citta, $cap, $provincia, $password);

    // Dopo aver registrato l'utente, reindirizza a myarea.php
    header("Location: myarea.php");
    exit();
}
?>


    <!-- Header -->
    <?php  include(FRONT_END . DS . 'header.php'); ?>
    <!-- Main -->
    <?php  include(FRONT_END . DS . 'register.php'); ?>
    <!-- Footer -->
    <?php  include(FRONT_END . DS . 'footer.php'); ?>