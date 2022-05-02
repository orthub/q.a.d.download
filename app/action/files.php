<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/not_logged_in.php';
require_once __DIR__ . '/../function/files.php';

// renderd die verfügbaren und erlaubten downloads in die (public/user.php) datei inklusive download button
function show_allowed_downloads()
{
  $user_id = $_SESSION['user'];
  $user_role = get_user_role_by_id($user_id);
  $files = get_files_from_db_for_user_role($user_role);
  
  foreach ($files as $file) {
    echo '<form action="/app/action/download_file.php" method="POST">';
      echo '<input type="hidden" name="filename" value="' . $file['path'] . '" />';
      echo '<p>' . str_replace("/public/storage/", "", $file['path']) . '</p>';
      echo '<input type="submit" value="Download" />';
    echo '<form>';
    echo '<hr />';
  }
}