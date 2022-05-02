<?php
require_once __DIR__ . '/../helpers/session.php';

// umleitung auf die registrierungsseite wenn nicht mit POST aufgerufen wird
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
  header('Location: ' . '/public/login.php');
  exit();
}