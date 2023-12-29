<?php
// logout.php
session_start();
session_destroy();
header('Location: indexv1.php');
?>