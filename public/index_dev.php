<?php

/**
 * index_dev.php - Script given to the PHP dev server
 * so that it can serve html files as PHP.
 * 
 * Documentation for the dev server:
 * http://php.net/manual/en/features.commandline.webserver.php
 */

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1', '[::1]'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Current IP address: ' . $_SERVER['REMOTE_ADDR']);
}

// Route all the ".html" through the prod index.php.
if (preg_match('/\.html$/', $_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] === '/') {
  require('index.php');
} else { 
  // A php router returning false means the resource will be served as is.
  // Necessary for all the assets to work with the dev server.
  return false;
}
