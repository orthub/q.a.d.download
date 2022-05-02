<?php require_once __DIR__ . '/../app/helpers/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/parts/head.php' ?>
<?php unset($_SESSION['register'])?>

<body>
  <?php require_once __DIR__ . '/parts/navbar.php' ?>
  <div class="text-center">
    <?php require_once __DIR__  . '/../app/helpers/flash_message.php' ?>
    <form action="/app/action/login.php" method="POST">
      <label for="email">Email:</label><br />
      <input id="email" name="login-email" type="email" value="<?php echo (isset($_SESSION['login']['login-email'])) ? $_SESSION['login']['login-email'] : '' ?>" />
      <br /><br />
      <label for="password">Passwort:</label><br />
      <input id="passwortd" name="login-password" type="password" value="<?php echo (isset($_SESSION['login']['login-password'])) ? $_SESSION['login']['login-password'] : '' ?>" />
      <br /><br />
      <input type="submit" value="Einloggen" />
    </form>
    <br />
    <a href="/public/register.php">Neuen Account Registrieren</a><br />
</body>

</html>