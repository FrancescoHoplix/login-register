<!-- Header -->
<?php include(FRONT_END . DS . 'header.php'); ?>
<div class="container">
    <div class="body d-md-flex align-items-center justify-content-between h-75">
        <div class="box-1 mt-md-0 mt-5">
            <img src="https://images.pexels.com/photos/2033997/pexels-photo-2033997.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                class="w-75" alt="">
        </div>
        <div class="container mt-5 text-warning">
            <form action="register.php" method="POST" class="login-form">
                <h2 class="mb-4 ">Registrati</h2>

                <div class="d-flex">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="cognome" class="form-label">Cognome:</label>
                        <input type="text" name="cognome" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="codice_fiscale" class="form-label">Codice Fiscale:</label>
                    <input type="text" name="codice_fiscale" class="form-control text-uppercase" minlength="16"
                        maxlength="16" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="d-flex">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="conferma_email" class="form-label">Conferma Email:</label>
                        <input type="email" name="conferma_email" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="indirizzo" class="form-label">Indirizzo:</label>
                    <input type="text" name="indirizzo" class="form-control" required>
                </div>

                <div class="d-flex">
                    <div class="mb-3">
                        <label for="citta" class="form-label">Città:</label>
                        <input type="text" name="citta" class="form-control" list="elencoCitta" required>
                        <datalist id="elencoCitta">
                            <?php
                            $cittaArray = array("Roma", "Milano", "Napoli", "Firenze");

                            foreach ($cittaArray as $citta) {
                                echo "<option value='" . $citta . "'>";
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="cap" class="form-label">CAP:</label>
                        <input type="number" name="cap" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="provincia" class="form-label ">Provincia:</label>
                        <input type="text" name="provincia" class="form-control text-uppercase" maxlength="2"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Invio</button>
            </form>
        </div>
        <div class="mt-5 w-25">
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
