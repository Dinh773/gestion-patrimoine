<?php
session_start();
$_SESSION = array(); 
session_destroy(); 
header('Location: app/router/router1.php?action=truc'); 
?>
