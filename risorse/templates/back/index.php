<?php


// Ottieni il numero totale di utenti
$sql_n = "SELECT COUNT(*) as totalUtenti FROM utenti";
$result = query($sql_n);
$row_n = $result->fetch_assoc();
$totalUtenti = $row_n['totalUtenti'];

// Verifica se l'utente è loggato
if (!isset($_SESSION['utente_loggato'])) {
    // L'utente non è loggato, reindirizza alla pagina di login
    header("Location: ../login.php");
    exit();
}

// Recupera l'email dell'utente dalla sessione
$email_utente = $_SESSION['email_utente'];

// Seleziona il ruolo dell'utente dalla tabella "utenti"
$sql = "SELECT ruolo FROM utenti WHERE email = '$email_utente'";
$result = query($sql);
// Seleziona tutti i dati dalla tabella "utenti"

// Verifica se l'utente ha il ruolo "admin"
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $ruolo_utente = $row['ruolo'];

    if ($ruolo_utente !== 'admin') {
        // L'utente non ha il ruolo "admin", reindirizza a una pagina di errore o altrove
        header("Location: errore.php"); 
        exit();
    }
} 
?>

<!--Sidebar-->



<div class="container mt-2 py-5 d-flex justify-content-around ">
    <div>
    <?php 
    //  include(BACK_END . DS . 'sidebar.php'); 
     ?>

    </div>
    <div>
    <h2 class="text-warning">Benvenuto ADMIN!</h2>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
        <p>Qui puoi visualizzare e gestire gli utenti. Oppure <span class="text-primary font-weight-bold"> -> </span>   </p>
         <a class="btn btn-info text-white p-1" href="inserisci_utente.php">Inseriscilo manualmente.</a>
        </div>

    </div>
    <?php echo "Benvenuto, <span class='text-uppercase font-weight-bold text-primary'>" . $email_utente . "</span>"; ?>
    <p>
    Numero totale di utenti: 
    <span class="badge bg-warning rounded text-white">
        <?php echo $totalUtenti; ?>
    </span>
    <?php mostraAvviso();?>
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
</div>