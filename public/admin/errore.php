<?php 
echo "Credenziali sbagliate";
// Distruggi la sessione
session_destroy();

// Reindirizza l'utente alla pagina di login o a un'altra pagina dopo il logout
header("Location: ../login.php");
exit();