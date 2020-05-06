<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix for WordPress database tables
    |
    */
    'table_prefix' => env('TABLE_PREFIX', 'wp_'),

    /*
    |--------------------------------------------------------------------------
    | Wp Config
    |--------------------------------------------------------------------------
    |
    | Add any wp config properties that you'd rather define here over directly
    | via constant declaration. Don't forget to pass the value to the
    | corresponding constant!
    |
    */
    'config' => require dirname(__FILE__) . '/wp/config.php',


    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    |
    | Simple configuration values to use when creating admin components. Define
    | many as you'd like.
    |
    */
    'admin' => [

        'alerts' => [
            'invalid_url' => 'The url you provided is invalid',
            'invalid_phone' => 'The phone number provided was invalid',
            'invalid_email' => 'The email address provided was not recognized as valid',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Option Resolvers
    |--------------------------------------------------------------------------
    |
    | This is where you can define the classes and processes that will resolve
    | simple arguments into concrete actions that customize the WordPress cms.
    |
    */
    'options' => [

        'form_field' => [
            'fields' => [],
            'namespaces' => [
                'app' => "App\\Forms\\Fields"
            ]
        ],

        'data_manager' => [
            'managers' => [
                'term_based_post_meta' => WebTheory\Taxtrubute\TermBasedPostMeta::class,
                'term_related_posts' => WebTheory\Post2Post\TermRelatedPostsManager::class,
            ],
            'namespaces' => [
                'app' => "App\\Forms\\Managers"
            ]
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

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Post types to be registered by via Leonidas post type factory.
    |
    */

    'post_types' => require dirname(__FILE__) . '/wp/post_types.php',

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Taxonomies to be registered by via Leonidas taxonomy factory.
    |
    */

    'taxonomies' => require dirname(__FILE__) . '/wp/taxonomies.php',
];
