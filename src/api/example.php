<?php

header('Content-type: application/json');

// We have access to URL params in $app['url_params']
// and can wire different responses according to that.
echo json_encode(
  [
    'hello' => 'world',
    'api_version' => $app['api_version'],
    'params' => $app['url_params']
  ]
);