<?php  require_once __DIR__ . '/../app/helpers/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/parts/head.php' ?>

<body>
  <?php require_once __DIR__ . '/parts/navbar.php' ?>
  <div class="text-center">
    <?php require_once __DIR__ . '/../app/helpers/flash_message.php' ?>
    <form action="/app/action/register.php" method="POST">
      <label for="first_name">Vorname</label><br />
      <input id="first_name" name="register-first-name" type="text" value="<?php echo isset(($_SESSION['register']['first-name'])) ? $_SESSION['register']['first-name'] : '' ?>" />
      <br /><br />
      <label for="last_name">Nachname</label><br />
      <input id="last_name" name="register-last-name" type="text" value="<?php echo isset(($_SESSION['register']['last-name'])) ? $_SESSION['register']['last-name'] : '' ?>" />
      <br /><br />
      <label for="email">Email</label><br />
      <input id="email" name="register-email" type="email" value="<?php echo isset(($_SESSION['register']['email'])) ? $_SESSION['register']['email'] : '' ?>" />
      <br /><br />
      <label for="password">Passwort</label><br />
      <input id="password" name="register-password" type="password" value="<?php echo isset(($_SESSION['register']['password'])) ? $_SESSION['register']['password'] : '' ?>" />
      <br /><br />
      <label for="password_confirm">Paswort wiederholen</label><br />
      <input id="password_confirm" name="register-password-confirm" type="password" value="<?php echo isset(($_SESSION['register']['password-confirm'])) ? $_SESSION['register']['password-confirm'] : '' ?>" /><br /><br />
      <input type="submit" value="Registrieren" />
    </form>
  </div>

</body>

</html>