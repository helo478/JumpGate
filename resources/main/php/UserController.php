<?php

require_once('library.php');

class UserController
{
    private static $instanceCounter = 0;
    
    private $instanceNum;
    private $dao;
    
    public function __construct($dao)
    {
        $this->dao = $dao;
        $this->instanceNum = UserController::$instanceCounter++;
    }
    
    public function __toString()
    {
        return 'UserController' . $this->instanceNum;
    }
    
    public function createUser($alias, $password, $fname, $lname, $email)
    {
        if(empty($alias))
        {
            throw new ControllerException('Empty value for alias');   
        }
        
        if(empty($password))
        {
            throw new ControllerException('Empty value for password');
        }
        
        if(empty($email))
        {
            throw new ControllerException('Empty value for email');
        }
        
        $passwordHash = md5($password);
        
        $this->dao->createUser($alias, $passwordHash, $fname, $lname, $email);
    }
}

?>