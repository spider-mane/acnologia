<?php

/**
 * Configuration overrides for APP_ENV === 'development'
 */

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

# display errors in dev environment
ini_set('display_errors', '1');

// Error handling
(new Run)->prependHandler(new PrettyPageHandler)->register();
