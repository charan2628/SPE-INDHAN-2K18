<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['email']);
unset($_SESSION['regID']);
session_unset();
session_destroy();
header("Location: ../");
exit;
?>