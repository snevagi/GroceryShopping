<?php
 include 'secure.php';
 session_start();
 // remove all session variables
session_unset(); 

// destroy the session 
session_destroy();


/* 
 * Redirect to a different page in the current directory that was requested 
 */
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
$protocol = isSecure() ? 'https' : 'http'; 

header("Location: $protocol://$host$uri/$extra");
exit;

?>