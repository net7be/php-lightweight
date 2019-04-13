<?php
include_once(dirname(__DIR__) . '/lib/Templating.php');
$assets = Templating::getAssets();

header("HTTP/1.0 404 Not Found");

Templating::includeTemplate(
  'header.php',
  [
    'title' => '404 Not Found',
    'assets' => $assets
  ]
);

?>

<h1>Page not found.</h1>

<?php
Templating::includeTemplate(
  'footer.php',
  [
    'assets' => $assets
  ]
);
?>