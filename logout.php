<?php
session_start(); // mulai session
session_destroy(); // Destroy session data
header("Location: login.php"); // Redirect to login page
exit;
?>