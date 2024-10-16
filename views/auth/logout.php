<?php





$root = $_SESSION['root'];

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();
// Optionally, clear the session cookie (if applicable)
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
}


// Redirect to the login page or home page after logout
header("Location: /$root/");
exit;
