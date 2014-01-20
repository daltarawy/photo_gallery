<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'Workspaces' . DS . 'AptanaStudio');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'PHP' . DS . 'photo_gallery' . DS . 'includes');
defined('LOG_PATH') ? null : define('LOG_PATH', SITE_ROOT . DS . 'PHP' . DS . 'photo_gallery' . DS . 'logs');
defined('LOG_FILE') ? null : define('LOG_FILE', 'log.txt');

// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER')   ? null : define("DB_USER", "photo_gallery");
defined('DB_PASS')   ? null : define("DB_PASS", "photo_gallery");
defined('DB_NAME')   ? null : define("DB_NAME", "photo_gallery");

// Set timezone
date_default_timezone_set('America/New_York');

// Set timezone
defined('ROWS_PER_PAGE')   ? null : define("ROWS_PER_PAGE", 3);
defined('NUM_OF_PAGES_IN_PAGINATION_STR')   ? null : define("NUM_OF_PAGES_IN_PAGINATION_STR", 10);


?>