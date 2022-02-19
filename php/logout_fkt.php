<?php
    session_start();
    // Löschen Session Daten
    $_SESSION = array();
    // Löschen Session Cookie
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
              $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();
	//GoTo Start
	header('Location: ../start.php?msg=' . urlencode(base64_encode("Logout erfolgreich!")));
	exit;
?>