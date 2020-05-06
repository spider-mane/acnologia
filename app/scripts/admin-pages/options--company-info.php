<?php

use Respect\Validation\Validator as v;
use WebTheory\GuctilityBelt\Phone;
use WebTheory\Leonidas\AdminPage\SettingsField;
use WebTheory\Leonidas\AdminPage\SettingsPage;
use WebTheory\Leonidas\AdminPage\SettingsSection;
use WebTheory\Leonidas\SettingManager;
use WebTheory\Saveyour\Fields\Email;
use WebTheory\Saveyour\Fields\Tel;
use WebTheory\Saveyour\Fields\Text;
use WebTheory\Saveyour\Fields\Url;
use WebTheory\Zeref\Accessors\Config;

################################################################################
# Script Variables
################################################################################
$prefix = Config::get("app.prefix");

# global alert messages
$invalidUrl = Config::get("wp.admin.alerts.invalid_email");

# option groups
$companyInfoOptionGroup = "{$prefix}-company-info";


################################################################################
# Register Page
################################################################################

# Create page
$page = (new SettingsPage("{$prefix}-company-info", "manage_options"))
    ->addFieldGroups($companyInfoOptionGroup)
    ->setIcon("dashicons-building")
    ->setDescription("Information about your company")
    ->setMenuTitle("Company Info")
    ->setPageTitle("Company Info")
    ->setPosition(100)
    ->register();


################################################################################
# Company title
################################################################################

## register section
$companNameSection = (new SettingsSection("{$prefix}-company-name", "Company Name", $page->getMenuSlug()))
    ->setDescription("Your company name")
    ->hook();

$titleVars = [
    "filter" => "sanitize_text_field"
];

# full title
$titleSetting = (new SettingManager($companyInfoOptionGroup, "{$companyInfoOptionGroup}--name--full"))
    ->setDescription("Full title, including any legal designations")
    ->addFilter($titleVars["filter"])
    ->hook();

$titleElement = (new Text)
    ->setId("{$prefix}--company-info--title-full")
    ->addClass("regular-text");

$titleField = (new SettingsField("{$prefix}-company-title", "Full Title", $page->getMenuSlug()))
    ->setSection($companNameSection->getId())
    ->setSetting($titleSetting->getOptionName())
    ->setField($titleElement)
    ->hook();


# short name
$shortTitleSetting = (new SettingManager($companyInfoOptionGroup, "{$companyInfoOptionGroup}--name--short"))
    ->setDescription("Short version of the full company name")
    ->addFilter($titleVars["filter"])
    ->hook();

$shortTitleElement = (new Text)
    ->setId("{$prefix}--company-info--title-short")
    ->addClass("regular-text");

$shortTitleField = (new SettingsField("{$prefix}-company-title-short", "Short Name", $page->getMenuSlug()))
    ->setSection($companNameSection->getId())
    ->setSetting($shortTitleSetting->getOptionName())
    ->setField($shortTitleElement)
    ->hook();


# styled name
$shortTitleSetting = (new SettingManager($companyInfoOptionGroup, "{$companyInfoOptionGroup}--name--styled"))
    ->setDescription("Stylized version of the company name")
    ->addFilter($titleVars["filter"])
    ->hook();

$shortTitleElement = (new Text)
    ->setId("{$prefix}--company-info--title-styled")
    ->addClass("regular-text");

$shortTitleField = (new SettingsField("{$prefix}-company-title-styled", "Stylized Name", $page->getMenuSlug()))
    ->setSection($companNameSection->getId())
    ->setSetting($shortTitleSetting->getOptionName())
    ->setField($shortTitleElement)
    ->hook();


################################################################################
# Contact info
################################################################################

$contactVars = [
    "filter" => "sanitize_text_field"
];

$telFilter = function ($phone) {
    return !empty($phone) ? Phone::formatUS($phone) : '';
};
$emailFilter = 'sanitize_email';


## register section
$companyContactSection = (new SettingsSection("{$prefix}-company-contact", "Contact Info", $page->getMenuSlug()))
    ->setDescription("General contact information for your company")
    ->hook();

# phone number
$phoneSetting = (new SettingManager($companyInfoOptionGroup, "{$companyInfoOptionGroup}--contact--phone"))
    ->addFilter($telFilter)
    ->addRule("valid-phone", v::optional(v::phone()), "Please enter a valid phone number")
    ->hook();

$phoneElement = (new Tel)
    ->setId("{$prefix}--company-contact--phone")
    ->addClass("regular-text")
    ->setPlaceholder("e.g. 555-555-5555");

$phoneField = (new SettingsField("{$prefix}-company-contact-phone", "Contact Number", $page->getMenuSlug()))
    ->setSection($companyContactSection->getId())
    ->setSetting($phoneSetting->getOptionName())
    ->setField($phoneElement)
    ->hook();


# email address
$emailSetting = (new SettingManager($companyInfoOptionGroup, "{$companyInfoOptionGroup}--contact--email"))
    ->addFilter($emailFilter)
    ->addRule("valid-email", v::optional(v::email()), "Please enter a valid email address")
    ->hook();

$emailElement = (new Email)
    ->setId("{$prefix}--company-contact--email")
    ->addClass("regular-text")
    ->setPlaceholder("e.g. contact@company.com");

$emailField = (new SettingsField("{$prefix}-company-contact-email", "Contact Email", $page->getMenuSlug()))
    ->setSection($companyContactSection->getId())
    ->setSetting($emailSetting->getOptionName())
    ->setField($emailElement)
    ->hook();


################################################################################
# Address
################################################################################

$addressVars = [
    "filter" => "sanitize_text_field"
];

## register section
$companyContactSection = (new SettingsSection("{$prefix}-company-address", "Address", $page->getMenuSlug()))
    ->setDescription("Your company\"s primary address")
    ->hook();


################################################################################
# Social Media
################################################################################

## register section
$socialMediaSection = (new SettingsSection("{$prefix}-social-media", "Social Media Accounts", $page->getMenuSlug()))
    ->setDescription("Provide links to your social media accounts")
    ->hook();

# repeated fields
$socialMediaAccounts = [
    'facebook' => 'Facebook',
    'instagram' => 'Instagram',
    'twitter' => 'Twitter',
    'linkedin' => 'linkedIn',
];

$placeholder = 'your-account';
$placeholders = [
    'linkedin' => "https://linkedin.com/company/{$placeholder}"
];

foreach ($socialMediaAccounts as $slug => $name) {
    $setting = (new SettingManager($companyInfoOptionGroup, "{$companyInfoOptionGroup}--social-media--{$slug}"))
        ->addRule("valid-url", v::optional(v::url()), $invalidUrl)
        ->addFilter("esc_url_raw")
        ->hook();

    $dummyUrl = $placeholders[$slug] ?? "https://{$slug}.com/{$placeholder}";

    $element = (new Url)
        ->addClass("large-text")
        ->setId("{$prefix}--social-media--{$slug}")
        ->setPlaceholder("e.g. {$dummyUrl}");

    $field = (new SettingsField("social-media-{$slug}", $name, $page->getMenuSlug()))
        ->setSection($socialMediaSection->getId())
        ->setSetting($setting->getOptionName())
        ->setField($element)
        ->hook();
}
