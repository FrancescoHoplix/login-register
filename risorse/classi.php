<?php
// Funzione per le operazioni CRUD sul database
function query($sql){
    global $connessione;
    return mysqli_query($connessione, $sql);
}

// Funzione per la gestione degli errori di connessione
function conferma($risultato){
    global $connessione;
    if(!$risultato){
        die('Richiesta fallita' . mysqli_error($connessione));
    }
}
function creaAvviso($msg) {
    if (!empty($msg)) {
        $_SESSION["messaggio"] = $msg;
    } else {
        $msg = "";
    }
}

function mostraAvviso() {
    if (isset($_SESSION["messaggio"])) {
        echo $_SESSION["messaggio"];
        unset($_SESSION["messaggio"]);
    }
}

class DatabaseConnection {
    public function connect() {
        $connessione = new mysqli(DB_HOST, DB_UTENTE, DB_PASSWORD, DB_NOME);
        if ($connessione->connect_error) {
            die("Connessione al database fallita: " . $connessione->connect_error);
        }
        return $connessione;
    }
}
class Utente {
    private $connessione;

    public function __construct() {
        $dbConnection = new DatabaseConnection();
        $this->connessione = $dbConnection->connect();
    }
    public function __destruct() {
        $this->connessione->close();
    }

    public function registraUtente($nome, $cognome, $codiceFiscale, $email, $confermaEmail, $indirizzo, $citta, $cap, $provincia, $password) {
        // Verifica se l'email e la conferma dell'email sono diverse
        if ($email !== $confermaEmail) {
            header("Location: error.php");
        } else {
            // Verifica se l'email esiste già nel database
            $sql_verifica_email = "SELECT id FROM utenti WHERE email = '$email'";
            $result_verifica_email = $this->query($sql_verifica_email);
    
            // Verifica se il codice fiscale esiste già nel database
            $sql_verifica_cf = "SELECT id FROM utenti WHERE codice_fiscale = '$codiceFiscale'";
            $result_verifica_cf = $this->query($sql_verifica_cf);
    
            if ($result_verifica_email->num_rows > 0 || $result_verifica_cf->num_rows > 0) {
                // Email o codice fiscale già esistenti
                header("Location: ./public/error.php");
            } else {
                // Email e codice fiscale non presenti, procedi con la registrazione
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO utenti (nome, cognome, codice_fiscale, email, conferma_email, indirizzo, città, cap, provincia, password) 
                        VALUES ('$nome', '$cognome', '$codiceFiscale', '$email', '$confermaEmail' , '$indirizzo', '$citta', '$cap', '$provincia', '$hashedPassword')";
                $risultato = $this->query($sql);
                $this->conferma($risultato);
                echo "Registrazione completata con successo!";
            }
        }
    }
    function processRegistration() {
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
    }
    

    private function query($sql){
        return mysqli_query($this->connessione, $sql);
        echo $sql;
    }

    private function conferma($risultato){
        if(!$risultato){
            die('Richiesta fallita' . mysqli_error($this->connessione));
        }
    }

    public function effettuaLogin($email, $password){
        $sql = "SELECT * FROM utenti WHERE email = ?";
        $stmt = $this->connessione->prepare($sql);
        
        if (!$stmt) {
            die('Errore nella preparazione della query: ' . $this->connessione->error);
        }
    
        $stmt->bind_param("s", $email);
    
        if (!$stmt->execute()) {
            die('Errore nell\'esecuzione della query: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $utente = $result->fetch_assoc();
    
            if (password_verify($password, $utente['password'])) {
                // Login riuscito
                session_start();
                $_SESSION['utente_loggato'] = true;
                $_SESSION['email_utente'] = $email;
                header("Location: myarea.php");
                exit();
            } else {
                // Password non valida
                echo "Nome utente o password non validi.";
            }
        } else {
            // Utente non trovato
            echo "Nome utente o password non validi.";
        }
    
        $stmt->close();
        // Verifica se l'utente è già loggato, in tal caso reindirizza a myarea.php
if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) {
    header("Location: myarea.php");
    exit();
}

// Se il modulo di login è stato inviato
if (isset($_POST['login'])) {
    // Recupera le credenziali inviate tramite il modulo
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Crea un'istanza della classe Utente
    $utente = new Utente();

    // Esegui la funzione effettuaLogin
    $utente->effettuaLogin($email, $password);
}
    }
    public function gestisciAccesso() {
        // Verifica se l'utente è già loggato, in tal caso reindirizza a myarea.php
        if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) {
            header("Location: myarea.php");
            exit();
        }

        // Se il modulo di login è stato inviato
        if (isset($_POST['login'])) {
            // Recupera le credenziali inviate tramite il modulo
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Esegui la funzione effettuaLogin
            $this->effettuaLogin($email, $password);
        }
    }
    public function recuperaDatiUtente() {
        // Verifica se l'utente è loggato
        if (!isset($_SESSION['utente_loggato'])) {
            // L'utente non è loggato, reindirizza alla pagina di login
            header("Location: login.php");
            exit();
        }

        // Recupera l'email dell'utente dalla sessione
        $email_utente = $_SESSION['email_utente'];

        // Seleziona i dati dell'utente corrente dalla tabella "utenti"
        $sql = "SELECT * FROM utenti WHERE email = ?";
        $stmt = $this->connessione->prepare($sql);

        if (!$stmt) {
            die('Errore nella preparazione della query: ' . $this->connessione->error);
        }

        $stmt->bind_param("s", $email_utente);

        if (!$stmt->execute()) {
            die('Errore nell\'esecuzione della query: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        // Restituisci i dati dell'utente
        return $result->fetch_assoc();
    }
    public function eliminaUtente($id_utente) {
        // Esegui la query di eliminazione
        $sql_elimina = "DELETE FROM utenti WHERE id = $id_utente";
        $result_elimina = $this->query($sql_elimina);

        if ($result_elimina) {
            // Utente eliminato con successo
            return true;
        } else {
            // Errore nell'eliminazione dell'utente
            return false;
        }
    }
    public function aggiornaUtente($id_utente, $nuovi_dati) {
        // Creare la stringa di aggiornamento con i dati forniti
        $set_clause = '';
        foreach ($nuovi_dati as $campo => $valore) {
            $set_clause .= "$campo = '$valore', ";
        }
        $set_clause = rtrim($set_clause, ', ');

        // Eseguire la query di aggiornamento
        $sql_aggiorna = "UPDATE utenti SET $set_clause WHERE id = $id_utente";
        $result_aggiorna = $this->query($sql_aggiorna);

        if ($result_aggiorna) {
            // Utente aggiornato con successo
            return true;
        } else {
            // Errore nell'aggiornamento dell'utente
            return false;
        }
    }

    public function inserisciUtente($nome, $cognome, $codiceFiscale, $email, $confermaEmail, $indirizzo, $citta, $cap, $provincia, $password, $ruolo) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = $sql = "INSERT INTO utenti (nome, cognome, codice_fiscale, email, indirizzo, città, cap, provincia, password, conferma_email, ruolo) 
        VALUES ('$nome', '$cognome', '$codiceFiscale', '$email', '$indirizzo', '$città', '$cap', '$provincia', '$hashedPassword', '$confermaEmail', '$ruolo')";
        
        $risultato = $this->query($sql);
        $this->conferma($risultato);
        // Puoi anche gestire l'output o le notifiche qui
        echo "Inserimento utente completato con successo!";
    }
    public function gestisciInserimentoUtente() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
            // Recupera i dati dal modulo
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
            $ruolo = $_POST['ruolo'];

            // Esegui la funzione per inserire l'utente
            $this->inserisciUtente($nome, $cognome, $codiceFiscale, $email, $confermaEmail, $indirizzo, $citta, $cap, $provincia, $password, $ruolo);

            // Crea un avviso
            creaAvviso('Hai inserito correttamente utente');

            // Reindirizza a una pagina specifica dopo l'inserimento
            header("Location: index.php");
            exit();
        }
    }
    
}


