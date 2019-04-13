<?php
/**
 * header.php
 * Example header partial template.
 * 
 * Params:
 * - pageTitle : Used as title for the document
 * - assets : App. static assets names
 */
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/favicon.ico">
  <title><?=$title?></title>
  <link rel="stylesheet" href="<?=$assets->{MAIN_CSS_BUNDLE}?>" />
</head>
<body>
  <header>
    <h1>Welcome!</h1>
  </header>
  <main>