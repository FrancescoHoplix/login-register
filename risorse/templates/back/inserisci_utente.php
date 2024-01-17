<div class="container mt-2 py-5 text-warning">
    <h2>Inserisci Utente Manualmente</h2>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
        <p>Qui puoi visualizzare e aggiungere nuovi utenti. Oppure <span class="text-primary font-weight-bold"> -> </span>   </p>
         <a class="btn btn-info text-white p-1" href="index.php">Torna alla tua Dash.</a>
        </div>
    <a class="btn btn-danger p-1 text-end" href="logout.php">LOGOUT</a>

    </div>
    <form action="inserisci_utente.php" method="POST">

    <div class="mb-3">
            <label for="nome" class="form-label">Nuovo Nome:</label>
            <input type="text" class="form-control" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="cognome" class="form-label">Nuovo Cognome:</label>
            <input type="text" class="form-control" name="cognome" required>
        </div>       
        <div class="d-flex">

        <div class="mb-3">
            <label for="email" class="form-label">Nuova Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="conferma_email" class="form-label">Conferma Email:</label>
            <input type="email" name="conferma_email" class="form-control" required>
        </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="codice_fiscale" class="form-label">Nuovo Codice Fiscale:</label>
            <input type="text" class="form-control  text-uppercase" minlength="16" maxlength="16" name="codice_fiscale"  required>
        </div>
        <div class="mb-3">
            <label for="indirizzo" class="form-label">Nuovo Indirizzo:</label>
            <input type="text" class="form-control" name="indirizzo" required>
        </div>
        <div class="mb-3">
    <label for="citta" class="form-label">Nuova Città:</label>
    <select class="form-select" name="citta" required>
        <?php
            // Array di città
            $cittaArray = array("Roma", "Milano", "Napoli", "Firenze");

            // Ciclo foreach per generare le opzioni
            foreach ($cittaArray as $citta) {
                echo "<option value='" . strtolower($citta) . "'>" . $citta . "</option>";
            }
        ?>
    </select>
</div>
        <div class="mb-3">
            <label for="cap" class="form-label">Nuovo CAP:</label>
            <input type="number" class="form-control" name="cap"  required>
        </div>
        <div class="mb-3">
            <label for="provincia" class="form-label">Nuova Provincia:</label>
            <input type="text" class="form-control text-uppercase" minlength="16" maxlength="2" name="provincia"  required>
        </div>
        <div class="mb-3">
    <label for="ruolo" class="form-label">Nuovo Ruolo:</label>
    <select class="form-select" name="ruolo" required>
        <option value="utente">Utente</option>
        <option value="admin">Admin</option>
    </select>
</div>

        <input class="btn btn-primary" type="submit" name="submit" value="Inserisci Utente">
    </form>
</div>
