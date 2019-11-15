<?php

/**
 * Configuration overrides for WP_ENV === 'development'
 */

use WebTheory\Zeref\System;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

System::define('SAVEQUERIES', true);
System::define('WP_DEBUG', true);
System::define('WP_DEBUG_DISPLAY', true);
System::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
System::define('SCRIPT_DEBUG', true);
System::define('JETPACK_DEV_DEBUG', true);

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
System::define('DISALLOW_FILE_MODS', false);

// Error handling
(new Run)->prependHandler(new PrettyPageHandler)->register();
