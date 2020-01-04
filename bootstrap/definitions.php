<?php

/**
 * This file is used to define only the most urgent constants. For the most
 * part, this file can be left alone, unless you need to change a particular
 * directory name (ie change WEB_ROOT_DIRNAME to 'public_html')
 */

# Base
define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT_DIR', dirname(__DIR__));
define('WEB_ROOT_DIRNAME', 'public');

# WP Core
define('WP_CORE_DIRNAME', 'wp');
define('WP_CORE_DIR', APP_ROOT_DIR . DS . WEB_ROOT_DIRNAME . DS . WP_CORE_DIRNAME);

# WP Content
define('WP_CONTENT_DIRNAME', 'app');
define('WP_CONTENT_DIR', APP_ROOT_DIR . DS . WEB_ROOT_DIRNAME . DS . WP_CONTENT_DIRNAME);

# WP Absolute Path
if (!defined('ABSPATH')) {
    define('ABSPATH', WP_CORE_DIR . DS);
}
