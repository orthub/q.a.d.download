<?php
require_once __DIR__ . '/database.php';

// email in der datenbank suchen
function search_email(string $email)
{
  try {
    $sql = 'SELECT `email`
            FROM `users`
            WHERE `email` = :email';
    $stmt = get_db()->prepare($sql);
    $stmt->execute([':email' => $email]);
    $res = $stmt->fetchColumn();
  } catch (\Throwable $th) {
    
    return false;
  }

  return $res;
}

// passwort anhand der email auslesen
function get_password_for_email(string $email)
{
  try {
    $sql = 'SELECT `password`
            FROM `users`
            WHERE `email` = :email';
    $stmt = get_db()->prepare($sql);
    $stmt->execute([':email' => $email]);
    $res = $stmt->fetchColumn();
  } catch (\Throwable $th) {

    return false;
  }

  return $res;
}

// id des benutzers anhand der email auslesen
function get_user_id_by_email(string $email)
{
  $sql = 'SELECT `id`
          FROM `users`
          WHERE `email` = :email';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':email' => $email]);
  $res = $stmt->fetchColumn();

  return $res;
}