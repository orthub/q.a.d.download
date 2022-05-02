<?php
require_once __DIR__ . '/../helpers/session.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
  header('Location: ' . '/public/login.php');
  exit();
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  session_destroy();
  header('Location: ' . '/public/login.php');
  exit();
}