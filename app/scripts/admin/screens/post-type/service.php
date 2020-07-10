<?php

use WebTheory\Leonidas\Forms\Controllers\PostMetaBoxFormSubmissionManager;
use WebTheory\Leonidas\MetaBox\Field as MetaBoxField;
use WebTheory\Leonidas\MetaBox\MetaBox;
use WebTheory\Zeref\Accessors\AdminField;
use WebTheory\Zeref\Accessors\Config;

################################################################################
# Variables
################################################################################
$prefix = Config::get("app.key_prefix");
$postType = "{$prefix}_service";


################################################################################
# Content Metabox
################################################################################

// create metabox
$metabox = (new MetaBox("{$prefix}_service_data", "Info"))
    ->setContext("normal")
    ->setScreen($postType)
    ->hook();

// create form submission manager
$nonce = $metabox->getNonce();
$form = (new PostMetaBoxFormSubmissionManager($postType))
    ->setNonce($nonce["name"], $nonce["action"])
    ->hook();


################################################################################
# subtitle
################################################################################

// create form field controller
$subtitle = AdminField::create([
    "request_var" => $postType . "__subtitle",
    "type" => [
        "@create" => "text",
        "classlist" => ["large-text"],
        "id" => str_replace("_", "-", $postType) . "--subtitle",
    ],
    "data" => [
        "@create" => "post_meta",
        "meta_key" => $postType . "_subtitle",
    ],
]);

$subtitle->addFilter("sanitize_text_field");

// create field scaffold
$subtitleField = (new MetaBoxField($subtitle))
    ->setDescription("subtitle to display")
    ->setLabel("Subtitle");

// add field to metabox and form manager
$metabox->addContent("subtitle", $subtitleField);
$form->addField($subtitle);


################################################################################
# description
################################################################################

// create form field controller
$description = AdminField::create([
    "request_var" => $postType . "__description",
    "type" => [
        "@create" => "textarea",
        "rows" => 15,
        "classlist" => ["large-text"],
        "id" => str_replace("_", "-", $postType) . "--description",
    ],
    "data" => [
        "@create" => "post_meta",
        "meta_key" => $postType . "_description",
    ],
]);

$subtitle->addFilter("sanitize_textarea_field");

// create field scaffold
$descriptionField = (new MetaBoxField($description))
    ->setDescription("explain the service in detail")
    ->setLabel("Description");

// add field to metabox and form manager
$metabox->addContent("description", $descriptionField);
$form->addField($description);


################################################################################
# pitch
################################################################################

// create form field controller
$pitch = AdminField::create([
    "request_var" => $postType . "__pitch",
    "type" => [
        "@create" => "textarea",
        "rows" => 5,
        "classlist" => ["large-text"],
        "id" => str_replace("_", "-", $postType) . "--pitch",
    ],
    "data" => [
        "@create" => "post_meta",
        "meta_key" => $postType . "_pitch",
    ],
]);

$subtitle->addFilter("sanitize_text_field");

// create field scaffold
$pitchField = (new MetaBoxField($pitch))
    ->setDescription("a brief pitch for the service to display on service overview pages")
    ->setLabel("Pitch");

// add field to metabox and form manager
$metabox->addContent("pitch", $pitchField);
$form->addField($pitch);
