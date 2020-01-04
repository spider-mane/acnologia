<?php

/*
Plugin Name:  Application Script Loader
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
    require App::path('scripts/init.php');
});

/**
 * loads logic from project app directory on admin init
 */
add_action('admin_init', function () {
    require App::path('scripts/admin.php');
});

/**
 * Loads a setup file
 */
require App::path('scripts/setup.php');
