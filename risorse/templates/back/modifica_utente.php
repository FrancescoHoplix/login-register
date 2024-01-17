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
            <input type="text" class="form-control" name="nuovo_provincia" value="<?php echo $dati_utente['provincia']; ?>" required>
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
