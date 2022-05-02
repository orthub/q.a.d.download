<?php

function get_db()
{
  static $db;
  if ($db instanceof PDO) {
    return $db;
  }

  require_once __DIR__ .'/../config/db_conf.php';

  try {
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
    $user = DB_USER;
    $password = DB_PASS;
    $db = new PDO($dsn, $user, $password);
  } catch (\Throwable $th) {
    $_SESSION['error']['db-connection'] = 'Keine Verbindung zur Datenbank';
    exit();
  }
  return $db;
}