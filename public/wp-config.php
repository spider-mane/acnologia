<?php

/**
 * You shouldn't need to edit this file. Edit the bootstrap/wordpress.php file
 * instead. This file is required in the root directory so WordPress can find
 * it. WP is hardcoded to look in its own directory or one directory up for
 * wp-config.php.
 */

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/bootstrap/app.php';
require dirname(__DIR__) . '/bootstrap/setup.php';

require ABSPATH . 'wp-settings.php';
