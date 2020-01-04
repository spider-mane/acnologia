<?php

use WebTheory\Leonidas\Screen;
use WebTheory\Zeref\Accessors\Config;
use WebTheory\Zeref\WpMaster;

################################################################################
# Variables
################################################################################
$prefix = Config::get("app.key_prefix");


################################################################################
# General admin modifiers
################################################################################
WpMaster::clearDashboard();


################################################################################
# Load scripts to modify post admin pages
################################################################################

Screen::load("post", ["post_type" => "page"], function () {
    require "admin-pages/post-type--page.php";
});

Screen::load("post", ["post_type" => "{$prefix}_testimonial"], function () {
    require "admin-pages/post-type--testimonial.php";
});

Screen::load("post", ["post_type" => "{$prefix}_service"], function () {
    require "admin-pages/post-type--service.php";
});


################################################################################
# Load scripts to modify term admin pages
################################################################################

Screen::load(["edit-tags", "term"], ["taxonomy" => "{$prefix}_project_type"], function () {
    require "admin-pages/taxonomy--project-type.php";
});
