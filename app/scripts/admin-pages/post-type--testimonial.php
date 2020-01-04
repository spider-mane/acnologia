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
$postType = "{$prefix}_testimonial";


################################################################################
# Content Metabox
################################################################################

// create metabox
$metabox = (new MetaBox("{$prefix}_testimonial_data", "Info"))
    ->setContext("normal")
    ->setScreen($postType)
    ->hook();

// create form submission manager
$nonce = $metabox->getNonce();
$form = (new PostMetaBoxFormSubmissionManager($postType))
    ->setNonce($nonce["name"], $nonce["action"])
    ->hook();

// create form field controller
$testimonial = AdminField::create([
    "post_var" => $postType . "__testimonial",
    "type" => [
        "@create" => "textarea",
        "rows" => 15,
        "classlist" => ["large-text"],
        "id" => str_replace("_", "-", $postType) . "--content",
    ],
    "data" => [
        "@create" => "post_meta",
        "meta_key" => $postType . "_content",
    ],
]);

// create field scaffold
$testimonialField = (new MetaBoxField($testimonial))
    ->setDescription("content")
    ->setLabel("Content");

// add field to metabox and form manager
$metabox->addContent("content", $testimonialField);
$form->addField($testimonial);
