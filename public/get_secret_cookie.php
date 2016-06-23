<?php
require_once('../private/initialize.php');
?>

<?php $page_title = 'Get Secret Cookie'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="main-content">

  <br>
  <a href="set_secret_cookie.php">Go back to set secret cookie</a>
  <p>The value of the secret cookie is: </p>
  <p>
  <?php
    if (!isset($_COOKIE['scrt'])) {
      echo "The secret cookie has expired";
    }
    else if (signed_string_is_valid($_COOKIE['scrt'])) {
      $encrypted = explode('--', $_COOKIE['scrt'])[0];
      echo decrypt($encrypted);
    }
    else {
      echo "The signature of this cookie is invalid. Its contents may have been tampered with.";
    }
  ?>
  <p/>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
