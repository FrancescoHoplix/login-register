<?php
require_once("../../risorse/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['elimina'])) {
    // Recupera l'ID dell'utente da eliminare dalla richiesta POST
    $id_utente = $_POST['id_utente'];

    // Crea un'istanza della classe Utente
    $utente = new Utente();

    // Esegui la funzione eliminaUtente
    $eliminazione_successo = $utente->eliminaUtente($id_utente);

    if ($eliminazione_successo) {
        // Utente eliminato con successo, gestisci di conseguenza
        header("Location: index.php"); // Reindirizza alla pagina admin
        exit();
    } else {
        // Errore nell'eliminazione dell'utente, gestisci di conseguenza
        echo "Errore nell'eliminazione dell'utente.";
    }
}

?>
