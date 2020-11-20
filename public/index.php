<?php

/**
 * index.php - Main entry point of application.
 * Should be the fallback resource configured on the web server.
 * 
 * The page will set $app['uri_params'] and give it the key
 * values extracted from the URL. You'll have to check if the 
 * 'uri_params' key is set on $app though.
 * 
 * When requesting an API endpoint, will set the API servion
 * into $app['api_version'].
 */

include_once(dirname(__DIR__) . '/src/conf/config.php');

function parseUriParams($query) {
  $res = Array();
  for ($i = 1; $i < count($query); $i += 2) {
    $res[$query[$i]] = 
      isset($query[$i + 1]) ? $query[$i + 1] : true;
  }
  return $res;
}

/**
 * Double check if the file exists and if it really sits 
 * in the directory it's supposed to be in.
 * This is to add another check for possible UTF attacks
 * and other attempts to import a PHP file outside of
 * the allowed import directories.
 * 
 * @param string $path The fully constructed import path
 * @param string $root The directory that the import path
 * is supposed to match
 * @return bool true if allowed to import, false otherwise
 */
function isAllowedToImport($path, $root) {
  if (is_file($path) && 
    rtrim($root, '/') === dirname($path)) 
      return true;
  return false;
}

// The include paths **must have a trailing slash**
// Include path for views:
$includePath = dirname(__DIR__) . '/src/views/';
// Include path for API handlers:
$includePathApi = dirname(__DIR__) . '/src/api/';

// Request URI including query string.
if ($parsedUri = parse_url($_SERVER["REQUEST_URI"])) {
  $reqUri = $parsedUri['path'];
} else {
  // We got an invalid URL for some reason.
  // This is never supposed to happen so let's
  // show 404.
  $reqUri = '';
}
// Future assoc for request params available throughout
// the app:
$app = Array();

$page = ['name' => '404', 'path' => $includePath];
if ($reqUri === '/') {
  $page['name'] = 'index';
} elseif (strpos($reqUri, API_ROOT) === 0) {
  // Requesting an API endpoint.
  $query = explode('/', rtrim(substr($reqUri, strlen(API_ROOT)), '/'));

  // Remove dots and a few special characters:
  if (isset($query[0]) &&
    isset($query[1]) && 
    (preg_match('/^[A-Za-z0-9-_]+$/', $query[1]) === 1) &&
    (isAllowedToImport($includePathApi . $query[1] . '.php', $includePathApi))) {
      // Set the API version:
      $app['api_version'] = $query[0];
      // We can now remove the API version:
      array_shift($query);
      $page['path'] = $includePathApi;
      $page['name'] = $query[0];
      $app['url_params'] = parseUriParams($query);
    }
} elseif (preg_match('/^\/([A-Za-z0-9-_\/]+\/)?([A-Za-z0-9-_]+)\.html$/', $reqUri, $matches)) {
  // We expect a very specific URL pattern. See README.md.
  // It's important to be careful with how this is processed.
  // Inserting double dots or strange characters could cause
  // an undesireable file being accessed (more like included).
  if ($matches[1]) {
    $query = explode('/', rtrim($matches[1], '/'));
    $pageCandidate = $query[0];
    // What's before the final .html is a query param value
    // so we need to add it to $query:
    $query[] = $matches[2];
    // Set the query parameters:
    /* for ($i = 1; $i < count($query); $i += 2) {
      $app['url_params'][$query[$i]] = 
        isset($query[$i+1]) ? $query[$i+1] : true;
    } */
    $app['url_params'] = parseUriParams($query);
  } else {
    $pageCandidate = $matches[2];
  }
  // We should check if the page exists:
  if (isAllowedToImport($page['path'] . $pageCandidate . '.php', $includePath)) 
    $page['name'] = $pageCandidate;
}

$app['page'] = $page['name'];
require($page['path'] . $page['name'] . '.php');
