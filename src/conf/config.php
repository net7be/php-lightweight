<?php

// Public folder (web accessible directory):
define('PUBLIC_DIR', 'public');
// Assets folder:
define('ASSETS_DIR', '/assets');
// Path to the Webpack manifest file:
define('MANIFEST', ASSETS_DIR . '/manifest.json');
// Name of the main JS bundle in manifest:
define('MAIN_JS_BUNDLE', 'app.js');
// Name of the vendor JS bundle in manifest:
define('VENDOR_JS_BUNDLE', 'vendor.js');
// Name of the CSS bundle:
define('MAIN_CSS_BUNDLE', 'app.css');
// Main date format:
define('DATE_FORMAT', 'd/m/Y H:i');
// API root (**WIHTOUT VERSION STRING**):
define('API_ROOT', '/api/');