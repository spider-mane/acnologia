<?php

use Enqueue\Dsn\Dsn;
use WebTheory\Zeref\Application;

$content = 'app';
$wp_home = env('WP_HOME');
$dsn = env('DATABASE_URL') ? Dsn::parseFirst(env('DATABASE_URL')) : null;

return [

    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'default' => [

        # Base
        'WP_SITEURL' => env('WP_SITEURL'),
        'WP_HOME' => $wp_home,

        # Custom WP Content Directory
        'WP_CONTENT_DIR' => Application::getInstance()->webPath($content),
        'WP_CONTENT_URL' => $wp_home . '/' . $content,

        # Default theme
        'WP_DEFAULT_THEME' => 'groot',

        # Database settings
        'DB_NAME' => $dsn ? $dsn->getPath() : env('DB_NAME'),
        'DB_USER' => $dsn ? $dsn->getUser() : env('DB_USER'),
        'DB_PASSWORD' => $dsn ? $dsn->getPassword() : env('DB_PASSWORD'),
        'DB_HOST' => $dsn ? $dsn->getHost() : env('DB_HOST', 'localhost'),
        'DB_CHARSET' => 'utf8mb4',
        'DB_COLLATE' => '',

        # Debug Settings
        'WP_DEBUG' => false,
        'WP_DEBUG_DISPLAY' => false,
        'WP_DISABLE_FATAL_ERROR_HANDLER' => false,
        'SCRIPT_DEBUG' => false,
        'SAVEQUERIES' => false,
        'JETPACK_DEV_DEBUG' => false,

        # Disable the plugin and theme file editor in the admin
        'DISALLOW_FILE_EDIT' => true,

        # Disable plugin and theme updates and installation from the admin
        'DISALLOW_FILE_MODS' => true,

        # Misc
        'WP_AUTO_UPDATE_CORE' => false,
        'WP_POST_REVISIONS' => true,
        'AUTOMATIC_UPDATER_DISABLED' => true,
        'DISABLE_WP_CRON' => env('DISABLE_WP_CRON', false),
        'IMAGE_EDIT_OVERWRITE' => true,

        # Authentication Unique Keys and Salts
        'AUTH_KEY' => env('AUTH_KEY'),
        'SECURE_AUTH_KEY' => env('SECURE_AUTH_KEY'),
        'LOGGED_IN_KEY' => env('LOGGED_IN_KEY'),
        'NONCE_KEY' => env('NONCE_KEY'),
        'AUTH_SALT' => env('AUTH_SALT'),
        'SECURE_AUTH_SALT' => env('SECURE_AUTH_SALT'),
        'LOGGED_IN_SALT' => env('LOGGED_IN_SALT'),
        'NONCE_SALT' => env('NONCE_SALT'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Development
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'development' => [

        # Debug Settings
        'WP_DEBUG' => true,
        'WP_DEBUG_DISPLAY' => true,
        'WP_DISABLE_FATAL_ERROR_HANDLER' => true,
        'SCRIPT_DEBUG' => true,
        'SAVEQUERIES' => true,
        'JETPACK_DEV_DEBUG' => true,

        # Allow file mods in development
        'DISALLOW_FILE_MODS' => false,
    ],
];
