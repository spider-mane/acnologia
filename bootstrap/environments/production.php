<?php

/**
 * Should only be used for live issue tracking that would not be useful in
 * development or staging environments
 */

use WebTheory\Zeref\Accessors\Config;

use function Sentry\init as sentry_init;

sentry_init([
    'dsn' => Config::get('services.sentry.dsn')
]);
