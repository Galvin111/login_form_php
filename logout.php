<?php
session_start();

/* Clear remember-me cookies */
setcookie("remember_email", "", time() - 3600, "/");
setcookie("remember", "", time() - 3600, "/");

/* Clear session */
session_unset();
session_destroy();

/* Redirect to login page */
header("Location: login.php");
exit();
?>
