<?php
namespace Payu\Test;

error_reporting(E_ALL | E_STRICT);
define('TEST_MICROTIME', microtime(true));

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    public static function init()
    {
        chdir(dirname(__DIR__));
        include('vendor/autoload.php');
        if (!is_dir('tests/testresults')) {
            mkdir('tests/testresults', 0755);
        }
    }
}

Bootstrap::init();
