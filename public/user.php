<?php
require_once __DIR__ . '/../app/helpers/session.php';
require_once __DIR__ . '/../app/helpers/not_logged_in.php';
require_once __DIR__ . '/../app/action/files.php';
// löschen der anmeldedaten
unset($_SESSION['login']);
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/parts/head.php' ?>

<body>
  <?php require_once __DIR__ . '/parts/navbar.php' ?>
  <form action="/app/action/logout.php" method="POST">
    <input type="submit" value="Ausloggen">
  </form>
  <div class="text-center">
    <?php require_once __DIR__ . '/../app/helpers/flash_message.php' ?>
    <h2>Benutzer eingeloggt</h2>

    <p>Downloads:</p>
    <?php show_allowed_downloads() ?>
  </div>
</body>

</html>