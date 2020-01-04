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
$postType = 'page';


################################################################################
# Content Metabox
################################################################################

// create metabox
$metabox = (new MetaBox('page_content', 'Other Content'))
    ->setContext('normal')
    ->setScreen($postType)
    ->hook();

// create form submission manager
$nonce = $metabox->getNonce();
$form = (new PostMetaBoxFormSubmissionManager($postType))
    ->setNonce($nonce['name'], $nonce['action'])
    ->hook();

// create form field controller
$subtitle = AdminField::create([
    'request_var' => $postType . '__subtitle',
    'escaper' => null,
    'type' => [
        '@create' => 'textarea',
        'rows' => 2,
        'classlist' => ['large-text'],
        'id' => str_replace('_', '-', $postType) . '--subtitle',
    ],
    'data' => [
        '@create' => 'post_meta',
        'meta_key' => "{$postType}_subtitle",
    ],
]);

// create field scaffold
$subtitleField = (new MetaBoxField($subtitle))
    ->setDescription('subtitle to place in the page hero')
    ->setLabel('Subtitle');

// add field to metabox and form manager
$metabox->addContent('subtitle', $subtitleField);
$form->addField($subtitle);
