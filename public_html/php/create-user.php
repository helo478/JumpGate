<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-type:application/json');

require_once('../../resources/main/php/library.php');

echo (string)getGlobalUserController();

function getGlobalUserController() {

    if(!isset($GLOBALS['userController']))
    {
        $dao = UserDaoFactory::getInstance();
        $GLOBALS['userController'] = new UserController($dao);
    }
    
    return $GLOBALS['userController'];
}

?>