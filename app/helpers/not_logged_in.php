<?php 
require_once __DIR__ . '/session.php';
// falls der benutzer nicht eingeloggt ist, wird auf die login seite umgeleitet
if (!isset($_SESSION['user'])) {
  header('Location: ' . '/public/login.php');
  exit();
}