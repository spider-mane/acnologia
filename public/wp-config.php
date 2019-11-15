<?php

/**
 * You shouldn't need to edit this file. Edit the bootstrap/wordpress.php file
 * instead. This file is required in the root directory so WordPress can find
 * it. WP is hardcoded to look in its own directory or one directory up for
 * wp-config.php.
 */

require APP_ROOT_DIR . '/vendor/autoload.php';
require APP_ROOT_DIR . '/bootstrap/dotenv.php';
require APP_ROOT_DIR . '/bootstrap/app.php';
require APP_ROOT_DIR . '/bootstrap/system.php';

require ABSPATH . 'wp-settings.php';
