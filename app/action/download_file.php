<?php

// umleitung auf die loginseite wenn nicht mit POST aufgerufen wird
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
  header('Location: ' . '/public/login.php');
  exit();
}

$filename = filter_input(INPUT_POST, 'filename', FILTER_SANITIZE_SPECIAL_CHARS);

// root verzeichnis des servers holen
$doc_root = $_SERVER['DOCUMENT_ROOT'];

// dateinamen mit dem root verzeichnis verbinden
$filename = $doc_root . $filename;

// wenn datei existiert, informationen für den download angeben
if(file_exists($filename)) {

  // header informationen für download
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: 0");
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Content-Length: ' . filesize($filename));
  header('Pragma: public');

  // buffer löschen
  flush();

  readfile($filename);

  exit();
  
  } else {
    $_SESSION['error']['file-dont-exist'] = 'Datei existiert nicht mehr';
    header('Location: ' . '/public/user.php');
    exit();
}