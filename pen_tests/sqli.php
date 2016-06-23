<?php
require_once('../private/initialize.php');

$string = "sqli' OR (1=1 AND SLEEP(5)=0) --'";

$tested = isset($_GET['tested']) ? true : false;

$msg = "";
if($tested) {
  $form_start = isset($_GET['start']) ? $_GET['start'] : 0;
  $form_end = isset($_GET['end']) ? $_GET['end'] : time();
  $time_diff = $form_end - $form_start;
  $msg = "Test complete. ({$time_diff} seconds)<br />";
  if($time_diff > 3) {
    $msg .= "Vulnerable to SQLI.";
  } else {
    $msg .= "Not vulnerable to SQLI.";
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>SQLI Test</title>
    <meta charset="utf-8">
  </head>
  <body>
    <a href="index.php">Test Menu</a><br />
    <br />

    <p>Click here to test your site for SQLI vulnerability.</p>
    <p>Wait for the results, it might take 5 seconds.</p>
    <script> updated = false; </script>
    <form action="../public/staff/login.php" method="post" name="sqli" target="results">
      <input type="hidden" name="username" value="<?php echo $string; ?>" />
      <input type="hidden" name="password" value="anything" />
      <input type="submit" name="submit" value="Test SQLI"  />
    </form>
    <iframe name="results" style="display: none;" onload="if(updated === true) { window.location =
  'sqli.php?tested=1&start=' + start + '&end=' + Math.floor(new Date().getTime()/1000)} ;"></iframe>
    <br />
    <br />
    <div id="state-code-test">
      <?php echo $msg; ?>
    </div>
    <script>
      start = 0;
      document.forms["sqli"].onsubmit = function() {
        updated = true;
        start = Math.floor(new Date().getTime()/1000);
      }
    </script>
  </body>
</html>
