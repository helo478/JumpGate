<?php

require_once('UserDao.php');

class UserDaoCloud9Impl implements iUserDao
{
    private $mysqli;
    
    function __construct()
    {
        $host = getenv('IP');
        $user = getenv('C9_USER');
        $password = '';
        $database = 'jumpgate';
        $port = 3306;
        
        $this->mysqli = new mysqli($host, $user, $password, $database, $port);
        if (!$this->mysqli)
        {
            die('Connection failed: ' . $this->mysqli->connect_error);
        }
    }
    
    function createUser($alias, $passwordHash, $fname, $lname, $email)
    {
        $sql = "
            INSERT INTO `users` 
            (`alias`, `passwordHash`, `fname`, `lname`, `email`)
            VALUES (?, ?, ?, ?, ?)
        ";
        
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt)
        {
            die('Prepared statement for createUser() failed: ' 
                . $this->mysqli->error);
        }
        
        $stmt->bind_param("sssss", 
            $alias, $passwordHash, $fname, $lname, $email);
            
        $result = $stmt->execute();
        
        return $result;
    }
    
    function logIn($alias, $passwordHash)
    {
        $sql = "
            SELECT `passwordHash` FROM `users` WHERE `alias` = ?
        ";
        
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt)
        {
            die('Prepared statement for logIn() failed: ' . 
                $this->mysqli->error);
        }
        
        $stmt->bind_param("s", $alias);
        
       $result = $stmt->execte();
        if (!$result) // If the alias was not found
        {
            return 0;
        }
        
        $persistedPasswordHash = $stmt->fetch();
        
        return $passwordHash == $persistedPasswordHash;
    }
    
    function clearAll()
    {
        $sql = "TRUNCATE TABLE `users`";
        $this->mysqli->query($sql);
    }
}

?>