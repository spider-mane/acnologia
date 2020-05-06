<?php

################################################################################
# Disallow indexing on non production environments
################################################################################
if (defined('WP_ENV') && WP_ENV !== 'production' && !is_admin()) {
    add_action('pre_option_blog_public', '__return_zero');
}


################################################################################
# Register default wordpress theme directory
################################################################################
if (!defined('WP_DEFAULT_THEME')) {
    register_theme_directory(ABSPATH . 'wp-content/themes');
}


################################################################################
# Register admin pages
################################################################################
add_action('admin_menu', function () {

    # company info settings admin page
    require 'admin-pages/options--company-info.php';
});
