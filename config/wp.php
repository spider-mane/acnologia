<?php

return [

    'config' => [

        'default_theme' => null,
        'textdomain' => 'acnologia',
    ],

    'admin' => [

        'alerts' => [
            'invalid_url' => 'The url you provided is not valid',
            'invalid_phone' => 'The phone number provided was invalid',
            'invalid_email' => 'The email address provided was not recognized as valid',
        ],

        'social_media_platforms' => [
            'facebook' => 'Facebook',
            'linkedin' => 'linkedIn',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'github' => 'Github',
        ],
    ],

    'option_handlers' => [

        'form_fields' => [],

        'data_managers' => [
            'term_based_post_meta' => WebTheory\Taxtrubute\TermBasedPostMeta::class,
            'term_related_posts' => WebTheory\Post2Post\TermRelatedPostsManager::class,
        ],

        'post_type' => [
            'sort_by_term' => WebTheory\SortOrder\SortByTermPostTypeArg::class,
            'somewhat_relatable_to' => WebTheory\Post2Post\SomewhatRelatableToPostTypeArg::class,
        ],

        'taxonomy' => [
            'maintain_mb_hierarchy' => WebTheory\Leonidas\Taxonomy\OptionHandlers\MaintainMetaboxHierarchy::class,
            'sortable' => WebTheory\SortOrder\SortableTaxonomyArg::class,
            'structural' => WebTheory\TaxRoles\StructuralTaxonomyArg::class,
        ],
    ],

    'post_types' => require 'wp/post_types.php',
    'taxonomies' => require 'wp/taxonomies.php',
];
