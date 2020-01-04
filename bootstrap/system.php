<?php

/**
 * Your base production configuration goes in this file. Environment-specific
 * overrides go in their respective config/environments/{{WP_ENV}}.php file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

use WebTheory\Zeref\Accessors\App;
use WebTheory\Zeref\Accessors\Config;
use WebTheory\Zeref\System;

$core = 'wp';
$content = 'app';


/**
 * Set up our global environment constant and load its config first
 */
System::define('WP_ENV', env('WP_ENV', 'production'));

# URLs
System::define('WP_SITEURL', env('WP_SITEURL'));
System::define('WP_HOME', env('WP_HOME'));


# WP Core
System::define('WP_CORE_DIR', App::webPath($core));

# WP Content
System::define('WP_CONTENT_DIR', App::webPath($content));
System::define('WP_CONTENT_URL', System::get('WP_HOME') . '/' . $content);


# Database settings
System::define('DB_NAME', env('DB_NAME'));
System::define('DB_USER', env('DB_USER'));
System::define('DB_PASSWORD', env('DB_PASSWORD'));
System::define('DB_HOST', env('DB_HOST', 'localhost'));
System::define('DB_CHARSET', 'utf8mb4');
System::define('DB_COLLATE', '');
$table_prefix = env('DB_PREFIX', 'wp_');

if (env('DATABASE_URL')) {
    $dsn = (object) parse_url(env('DATABASE_URL'));

    System::define('DB_NAME', substr($dsn->path, 1));
    System::define('DB_USER', $dsn->user);
    System::define('DB_PASSWORD', isset($dsn->pass) ? $dsn->pass : null);
    System::define('DB_HOST', isset($dsn->port) ? "{$dsn->host}:{$dsn->port}" : $dsn->host);
}

/**
 * Authentication Unique Keys and Salts
 */
System::define('AUTH_KEY', env('AUTH_KEY'));
System::define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
System::define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
System::define('NONCE_KEY', env('NONCE_KEY'));
System::define('AUTH_SALT', env('AUTH_SALT'));
System::define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
System::define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
System::define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Debug Settings
 */
System::define('WP_DEBUG_DISPLAY', false);
System::define('SCRIPT_DEBUG', false);
System::define('JETPACK_DEV_DEBUG', false);
ini_set('display_errors', '0');

/**
 * Misc
 */
System::define('WP_DEFAULT_THEME', Config::get('wp.config.default_theme'));
System::define('APP_TD', Config::get('wp.config.textdomain'));
System::define('WP_AUTO_UPDATE_CORE', false);
System::define('AUTOMATIC_UPDATER_DISABLED', true);
System::define('DISABLE_WP_CRON', env('DISABLE_WP_CRON', false));

// Disable the plugin and theme file editor in the admin
System::define('DISALLOW_FILE_EDIT', true);

// Disable plugin and theme updates and installation from the admin
System::define('DISALLOW_FILE_MO$ds', true);

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer
 * See https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

$envConfig = realpath(__DIR__ . '/environments/' . System::get('WP_ENV') . '.php');

if (file_exists($envConfig)) {
    require $envConfig;
}

/**
 * Formally define as constants all values passed to System::define()
 */
System::apply();
