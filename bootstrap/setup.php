<?php

/**
 * Your base production configuration goes in this file. Environment-specific
 * overrides go in their respective config/environments/{{APP_ENV}}.php file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

use WebTheory\Zeref\Accessors\App;
use WebTheory\Zeref\Accessors\Config;

# Define dirname where wordpress core files are located
$core = 'wp';

# Define table prefix
$table_prefix = Config::get('wp.table_prefix');

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

# Do not display errors by default
ini_set('display_errors', '0');

# Load environment specific bootstrap script
$envSetup = realpath(__DIR__ . '/environments/' . env('APP_ENV') . '.php');
file_exists($envSetup) && require $envSetup;

# Define ABSPATH
defined('ABSPATH') || define('ABSPATH', App::webPath($core) . DIRECTORY_SEPARATOR);
