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
  $register_first_name = trim(filter_input(INPUT_POST, 'register-first-name', FILTER_SANITIZE_SPECIAL_CHARS));
  $register_last_name = trim(filter_input(INPUT_POST, 'register-last-name', FILTER_SANITIZE_SPECIAL_CHARS));
  $register_email = trim(filter_input(INPUT_POST, 'register-email', FILTER_SANITIZE_EMAIL));
  $register_password = trim(filter_input(INPUT_POST, 'register-password'));
  $register_password_confirm = trim(filter_input(INPUT_POST, 'register-password-confirm'));

  // prüfen ob die felder leer sind
  if ((bool)$register_email === false) {
    $_SESSION['error']['register-first-name'] = 'Bitte Vornamen eingeben';
    $error[] = 1;
  }
  if ((bool)$register_email === false) {
    $_SESSION['error']['register-last-name'] = 'Bitte Nachnamen eingeben';
    $error[] = 1;
  }
  if ((bool)$register_email === false) {
    $_SESSION['error']['register-email'] = 'Bitte Email eingeben';
    $error[] = 1;
  }
  if ((bool)$register_password === false) {
    $_SESSION['error']['register-password'] = 'Bitte Passwort eingeben';
    $error[] = 1;
  }
  if ((bool)$register_password === false) {
    $_SESSION['error']['register-password-confirm'] = 'Bitte Passwort bestätigen';
    $error[] = 1;
  }
  
  // übergebene formulardaten in eine session speichern, 
  // damit die daten nicht neu eingegeben werden müssen bei fehlern
  if ((bool)$register_first_name) {
    $_SESSION['register']['first-name'] = $register_first_name;
    unset($_SESSION['error']['register-first-name']);
  }
  if ((bool)$register_last_name) {
    $_SESSION['register']['last-name'] = $register_last_name;
    unset($_SESSION['error']['register-last-name']);
  }
  if ((bool)$register_email) {
    $_SESSION['register']['email'] = $register_email;
    unset($_SESSION['error']['register-email']);
  }
  if ((bool)$register_password) {
    $_SESSION['register']['password'] = $register_password;
    unset($_SESSION['error']['register-password']);
  }
  if ((bool)$register_password_confirm) {
    $_SESSION['register']['password-confirm'] = $register_password_confirm;
    unset($_SESSION['error']['register-password-confirm']);
  }
  

  // bei fehlern zurück zur registrierung und die meldungen ausgeben
  if (count($error) > 0){
    header('Location: ' . '/public/register.php');
    exit();
  }

  if (count($error) === 0) {

  // email adresse wird auf die richtigkeit überprüft (@)
    if ((bool)$register_email) {
      $validate_register_email = filter_var($register_email, FILTER_VALIDATE_EMAIL);
      if ((bool)$validate_register_email === false) {
        $_SESSION['error']['register-email'] = 'Bitte eine gültige email eingeben';
        $error[] = 1;
      }
    }

    // passwort länge überprüfen (min 8 zeichen)
    if (mb_strlen($register_password) < 8) {
      $_SESSION['error']['register-password'] = 'Passwort muss aus mindestens 8 Zeichen bestehen';
      $error[] = 1;
    }

    // passwort bestätigen
    if ($register_password !== $register_password_confirm) {
      $_SESSION['error']['register-password-confirm'] = 'Passwörter stimmen nicht überein';
      $error[] = 1;
    }

    // bei fehlern zurück zur registrierung und die meldungen ausgeben
    if (count($error) > 0){
      header('Location: ' . '/public/register.php');
      exit();
    }

    if (count($error) === 0) {
      require_once __DIR__ . '/../function/register.php';
      
      // alle emails von der datenbank holen
      $emails_in_database = get_all_emails();
      
      // prüfen ob die email schon in der datenbank existiert
      foreach ($emails_in_database as $email_in_database) {
        if ($register_email === $email_in_database) {
          $_SESSION['error']['register-email'] = 'Email kann nicht verwendet werden';
          $error[] = 1;
        }
      }

      // bei fehlern zurück zur registrierung und die meldungen ausgeben
      if (count($error) > 0) {
        header('Location: ' . '/public/register.php');
        exit();
      }

      // neuen benutzer registrieren
      if (count($error) === 0) {
        $register_new_user = register_new_user($register_first_name, $register_last_name, $register_email, $register_password);

        // unerwarteter fehler bei der erstellung abfangen
        if ($register_new_user === false) {
          $_SESSION['error']['register'] = 'Konto konnte nicht erstellt werden, versuchen sie es später noch einmal';
          header('Location: ' . '/public/register.php');
          exit();
        }

        // umleitung zum login nach erfolgreichem erstellen
        $_SESSION['success']['new-user-created'] = 'Neues Konto angelegt. Sie können sich nun einloggen';
        header('Location: ' . '/public/login.php');
        exit();
      }
    }
  }
}