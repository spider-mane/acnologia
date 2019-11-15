<?php

/*
Plugin Name:  Application Loader
Plugin URI:   https://github.com/spider-mane/acnologia
Description:  Loads primary application files.
Version:      1.0.0
Author:       Chris Williams
Author URI:   https://github.com/spider-mane
License:      MIT License
*/

use WebTheory\Zeref\Accessors\App;

/**
 * loads logic from project app directory on wp init
 */
add_action('init', function () {
    require_once App::path('scripts/init.php');
});

/**
 * loads logic from project app directory on admin init
 */
add_action('admin_init', function () {
    require_once App::path('scripts/admin.php');
});

/**
 * Loads a script before as soon as this file is loaded by wp
 */
if (file_exists($root = App::path('scripts/root.php'))) {
    require_once $root;
}
