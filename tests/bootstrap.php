<?php

require_once 'vendor/autoload.php';

define('ROOT', dirname(__DIR__));
define('APP_DIR', 'TestApp');
define('WEBROOT_DIR', 'webroot');
define('TMP', sys_get_temp_dir().DS);
define('LOGS', TMP.'logs'.DS);
define('CACHE', TMP.'cache'.DS);
define('SESSIONS', TMP.'sessions'.DS);
define('CAKE_CORE_INCLUDE_PATH', ROOT.'/vendor/cakephp/cakephp');
define('CORE_PATH', CAKE_CORE_INCLUDE_PATH.DS);
define('CAKE', CORE_PATH.'src'.DS);
define('CORE_TESTS', CORE_PATH.'tests'.DS);
define('CORE_TEST_CASES', CORE_TESTS.'TestCase');
define('TEST_APP', ROOT.DS.'tests'.DS.'test_app'.DS);
define('LOG_ERROR', LOG_ERR);

// Point app constants to the test app.
define('APP', TEST_APP.'TestApp'.DS);
define('WWW_ROOT', TEST_APP.WEBROOT_DIR.DS);
define('TESTS', TEST_APP.'tests'.DS);
define('CONFIG', TEST_APP.'config'.DS);

use Cake\Datasource\ConnectionManager;

ConnectionManager::config('test', []);

mb_internal_encoding('UTF-8');
