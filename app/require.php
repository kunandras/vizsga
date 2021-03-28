<?php

require_once 'config/config.php';

require_once 'libraries/Core.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';

$core = new Core();

/**
 * @param $className
 * @return bool
 */
function __autoload($className): bool {
    if (file_exists('../app/models/' . $className . '.php')) {
        require_once '../app/models/' . $className . '.php';
        return true;
    }
    return false;
}