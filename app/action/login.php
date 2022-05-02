<?php
require_once __DIR__ . '/../helpers/session.php';

// umleitung auf die registrierungsseite wenn nicht mit POST aufgerufen wird
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
  header('Location: ' . '/public/login.php');
  exit();
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
  require_once __DIR__ . '/../helpers/session.php';

  // fehler variable
  $error = [];

  // formulardaten in eine variable speichern zur weiterverarbeitung
  $login_email = trim(filter_input(INPUT_POST, 'login-email', FILTER_SANITIZE_EMAIL));
  $login_password = trim(filter_input(INPUT_POST, 'login-password'));

  $_SESSION['login']['login-email'] = $login_email;
  $_SESSION['login']['login-password'] = $login_password;



  if ((bool)$login_email === false) {
    $_SESSION['error']['login-email'] = 'Bitte Email eingeben';
    $error[] = 1;
  }
  if ((bool)$login_password === false) {
    $_SESSION['error']['login-password'] = 'Bitte Passwort eingeben';
    $error[] = 1;
  }
  
  // bei fehlern zurück zum login und die meldungen ausgeben
  if (count($error) > 0){
    header('Location: ' . '/');
    exit();
  }

  if (count($error) === 0) {
    require_once __DIR__ . '/../function/login.php';
    
    $search_email = search_email($login_email);

    if ($search_email !== $login_email) {
      $_SESSION['error']['login'] = 'Email nicht gefunden';
      header('Location: ' . '/public/login.php');
      exit();
    }
    
    $password_hash = get_password_for_email($login_email);
    $validate = password_verify($login_password, $password_hash);
    
    if ($validate === false) {
      $_SESSION['error']['login-failed'] = 'Passwort stimmt nicht';
      header('Location: ' . '/public/login.php');
      exit();
    }

    if ($validate) {
      $user_id = get_user_id_by_email($login_email);
      $_SESSION['user'] = $user_id;

      header('Location: ' . '/public/user.php');
      exit();
    }
  }
}