<?php

error_reporting(1);

require_once 'config/config.php';

require_once 'helpers/Admin.php';
require_once 'helpers/Session.php';
require_once 'helpers/Time.php';
require_once 'helpers/UserHelper.php';

require_once 'controllers/BaseController.php';

require_once 'libraries/Core.php';
require_once 'libraries/View.php';
require_once 'libraries/ValidException.php';
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