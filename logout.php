<?php
session_start();
session_unset();

session_destroy();
// Logged out, return home.
Header("Location: Login.php");
?>