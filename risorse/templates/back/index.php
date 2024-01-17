<div class="container mt-2 py-5 ">
    <h2 class="text-warning">Benvenuto ADMIN!</h2>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
        <p>Qui puoi visualizzare e gestire gli utenti. Oppure <span class="text-primary font-weight-bold"> -> </span>   </p>
         <a class="btn btn-info text-white p-1" href="inserisci_utente.php">Inseriscilo manualmente.</a>
        </div>
    <a class="btn btn-danger p-1 text-end" href="logout.php">LOGOUT</a>

    </div>
    <?php echo "Benvenuto, <span class='text-uppercase font-weight-bold text-primary'>" . $email_utente . "</span>"; ?>
    <p>
    Numero totale di utenti: 
    <span class="badge bg-warning rounded text-white">
        <?php echo $totalUtenti; ?>
    </span>
</p>

    <table class="table table-bordered mt-3">
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
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM utenti";
        $result = query($sql);
        while ($row = $result->fetch_assoc()) : ?>
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
                <td class="p-3">
                    <form action="elimina_utente.php" method="POST">
                        <input type="hidden" name="id_utente" value="<?php echo $row['id']; ?>">
                        <button class="btn btn-danger p-1" type="submit" name="elimina">
                            Elimina <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    <form action="modifica_utente.php" method="POST">
                        <input type="hidden" name="id_utente" value="<?php echo $row['id']; ?>">
                        <button class="btn btn-primary p-1" type="submit" name="modifica">
                            Modifica  <i class="fa fa-pen"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>