<div class="container">
    <h2 class="text-warning">Benvenuto nella tua area riservata!</h2>
    <div class="d-flex justify-content-between">
    <p>Qui puoi visualizzare il contenuto riservato al tuo utente. </p>
    <div>
    <a class="btn btn-warning text-white" href="admin/index.php">ADMIN</a>
    <a class="btn btn-danger" href="logout.php">LOGOUT</a>
    </div>

    </div>
    <?php echo "Benvenuto, <span class='text-uppercase font-weight-bold text-primary'>" . $email_utente . "</span>!"; ?>


    <!-- Mostra i dati dell'utente dalla tabella -->
    <div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Codice Fiscale</th>
                <th>Indirizzo</th>
                <th>Città</th>
                <th>CAP</th>
                <th>Provincia</th>
                <th>Ruolo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['cognome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['codice_fiscale']; ?></td>
                    <td><?php echo $row['indirizzo']; ?></td>
                    <td><?php echo $row['città']; ?></td>
                    <td><?php echo $row['cap']; ?></td>
                    <td><?php echo $row['provincia']; ?></td>
                    <td><?php echo $row['ruolo']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>