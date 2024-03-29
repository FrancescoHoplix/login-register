<?php
session_start(); // Avvia la sessione

$utente = new Utente();
$utente->gestisciAccesso();

?>

<div class="container">
        <div class="body d-md-flex align-items-center justify-content-between ">
            <div class="container mt-5 text-warning">
   
        <h2 class="mb-4 ">Accedi</h2>
        <form action="login.php" method="POST" class="mt-3">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <input type="submit" class="btn btn-success" name="login" value="Effettua Login">
        </form>
        
</div>
            <div class="mt-5 ">
                    <p class="mb-1">Crea il tuo Account</p>
                    <p class="text-muted mb-2">Collegati con</p>
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <a href="#" class="box me-2 selectio">
                                <span class="fab fa-facebook-f mb-2 text-primary"></span>
                                <p class="mb-0 text-primary">Facebook</p>
                            </a>
                            <a href="#" class="box me-2">
                                <span class="fab fa-google mb-2 text-danger"></span>
                                <p class="mb-0 text-danger">Google</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>