<?php

require_once('UserDaoCloud9Impl.php');

class UserDaoFactory
{
    private static $dao;
    
    public static function getInstance()
    {
        if (UserDaoFactory::$dao == null)
        {
            UserDaoFactory::$dao = new UserDaoCloud9Impl();
        }
        return UserDaoFactory::$dao;
    }
}

?>