<?php
require_once __DIR__ . '/database.php';

// alle emails der datenbank auslesen um email nicht doppelt verwenden zu können
function get_all_emails()
{
  $sql = 'SELECT `email` FROM `users`';
  $stmt = get_db()->query($sql);
  $res = $stmt->fetchAll();

  return $res;
}

// neuen benutzer registrieren und password hashen
function register_new_user(string $first_name, string $last_name, string $email, string $password)
{
  $hash_password = password_hash($password, PASSWORD_DEFAULT);
  
  $sql = 'INSERT INTO `users` 
          SET `first_name` = :first_name,
              `last_name` = :last_name,
              `email` = :email,
              `password` = :password_hash';
  $stmt = get_db()->prepare($sql);

  try {
    $stmt->execute([
      ':first_name' => $first_name,
      ':last_name' => $last_name,
      ':email' => $email,
      ':password_hash' => $hash_password,
    ]);
  } catch (\Throwable $th) {
    
    return false;
  }
  
  return true;
}