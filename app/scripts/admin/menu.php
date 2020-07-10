<?php

declare(strict_types=1);

use WebTheory\Leonidas\AdminPage\SettingsPage;
use WebTheory\Zeref\Accessors\Config;

################################################################################
# Variables
################################################################################
$prefix = Config::get("app.prefix");
$companyInfoOptionGroup = "{$prefix}-company-info";


################################################################################
# Register Pages
################################################################################

# Company Info
(new SettingsPage("{$prefix}-company-info", $companyInfoOptionGroup, "manage_options"))
    ->setIcon("dashicons-building")
    ->setDescription("Information about your company")
    ->setMenuTitle("Company Info")
    ->setPageTitle("Company Info")
    ->setPosition(100)
    ->register();
