<?php

use App\Forms\ContactForm;
use WebTheory\Zeref\Accessors\Config;
use WebTheory\Zeref\Accessors\Forms;
use WebTheory\Zeref\Accessors\PostType;
use WebTheory\Zeref\Accessors\Taxonomy;
use WebTheory\Zeref\Forms\Form;
use WebTheory\Zeref\WpMaster;

################################################################################
# Variables
################################################################################
$prefix = Config::get('app.key_prefix');


################################################################################
# Admin modifiers
################################################################################
WpMaster::setPostsAsBlog();


################################################################################
# Disable Gutenberg
################################################################################
array_map(function ($postType) {
    get_post_type_object($postType)->show_in_rest = false;
}, ['page', 'post']);


################################################################################
# Register post types and taxonomies
################################################################################
PostType::create(Config::get('wp.post_types'));
Config::remove('wp.post_types');

Taxonomy::create(Config::get('wp.taxonomies'));
Config::remove('wp.taxonomies');


################################################################################
# Register Forms
################################################################################
Forms::register('contact', Form::create("{$prefix}-contact-form", ContactForm::class, true));


################################################################################
# load files
################################################################################
