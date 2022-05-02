<?php
if (isset($_SESSION['error'])) {
  foreach ($_SESSION['error'] as $error) {
    echo '<p class="flash-error">' . $error . '</p><br />';
  }
}

if (isset($_SESSION['success'])) {
  foreach ($_SESSION['success'] as $success) {
    echo '<p class="flash-success">' . $success . '</p><br />';
  }
}

unset($error);
unset($success);
unset($_SESSION['error']);
unset($_SESSION['success']);