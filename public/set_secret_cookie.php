<?php
require_once('../private/initialize.php');
?>

<?php $page_title = 'Set Secret Cookie'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="main-content">

  <?php
    $name = 'scrt';
    $value = encrypt_and_sign("I have a secret to tell.");
    $expire = time() + 60*60*24*10; // 10 days from now
    $path = '/';
    $domain = 'localhost';
    $secure = isset($_SERVER['HTTPS']);
    $httponly = true;
    setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
  ?>
  <h1>Secret cookie set</h1>
  <a href="get_secret_cookie.php">Get secret cookie</a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
