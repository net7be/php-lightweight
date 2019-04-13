<?php
include_once(dirname(__DIR__) . '/lib/Templating.php');
$assets = Templating::getAssets();

Templating::includeTemplate(
  'header.php',
  [
    'title' => 'Hello World!',
    'assets' => $assets
  ]
);

// Include the center piece:
Templating::includeTemplate('hello_world.php', null);

Templating::includeTemplate(
  'footer.php',
  [
    'assets' => $assets
  ]
);
?>