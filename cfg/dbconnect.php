<?php
// Basic DB connection (mysqli) with small improvements

$server = "localhost";
$userid = "root";
$pwd = "";
$dbname = "login_form";

$conn = mysqli_connect($server, $userid, $pwd, $dbname);

// Check connection
if (!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}

// Optional small improvement: set charset to avoid encoding issues
mysqli_set_charset($conn, "utf8");
?>
