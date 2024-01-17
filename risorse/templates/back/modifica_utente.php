<?php
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
    creaAvviso('Hai modificato correttamente utente');

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

<div class="container py-5">
    <h2 class="mt-4 mb-4">Modifica Utente</h2>
    <form action="modifica_utente.php" method="POST" >
        <input type="hidden" name="id_utente" value="<?php echo $dati_utente['id']; ?>">

        <div class="mb-3">
            <label for="nuovo_nome" class="form-label">Nuovo Nome:</label>
            <input type="text" class="form-control" name="nuovo_nome" value="<?php echo $dati_utente['nome']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nuovo_cognome" class="form-label">Nuovo Cognome:</label>
            <input type="text" class="form-control" name="nuovo_cognome" value="<?php echo $dati_utente['cognome']; ?>" required>
        </div>       
        <div class="mb-3">
            <label for="nuovo_email" class="form-label">Nuova Email:</label>
            <input type="email" class="form-control" name="nuovo_email" value="<?php echo $dati_utente['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nuovo_codice_fiscale" class="form-label">Nuovo Codice Fiscale:</label>
            <input type="text" class="form-control" name="nuovo_codice_fiscale" value="<?php echo $dati_utente['codice_fiscale']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nuovo_indirizzo" class="form-label">Nuovo Indirizzo:</label>
            <input type="text" class="form-control" name="nuovo_indirizzo" value="<?php echo $dati_utente['indirizzo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nuovo_città" class="form-label">Nuova Città:</label>
            <input type="text" class="form-control" name="nuovo_città" value="<?php echo $dati_utente['città']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nuovo_cap" class="form-label">Nuovo CAP:</label>
            <input type="text" class="form-control" name="nuovo_cap" value="<?php echo $dati_utente['cap']; ?>" required>
        </div>
        <div class="mb-3">
    <label for="nuovo_provincia" class="form-label">Nuova Provincia:</label>
    <select class="form-select" name="nuovo_provincia" required>
        <?php
        // Array delle province (puoi sostituire questo array con i dati provenienti dal tuo database)
        $province = array("NA", "MI", "RM", "FI");

        // Scorrere l'array e generare le opzioni
        foreach ($province as $provincia) {
            $selected = ($dati_utente['provincia'] == $provincia) ? 'selected' : '';
            echo "<option value=\"$provincia\" $selected>$provincia</option>";
        }
        ?>
    </select>
</div>

        <div class="mb-3">
    <label for="nuovo_ruolo" class="form-label">Nuovo Ruolo:</label>
    <select class="form-select" name="nuovo_ruolo" required>
        <option value="utente" <?php echo ($dati_utente['ruolo'] === 'utente') ? 'selected' : ''; ?>>Utente</option>
        <option value="admin" <?php echo ($dati_utente['ruolo'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
    </select>
</div>



        <button type="submit" name="aggiorna" class="btn btn-warning text-white">Aggiorna Utente</button>
    </form>
</div>
