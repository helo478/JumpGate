<?php

interface iUserDao
{
    /**
     * createUser
     * 
     * persists a new user account.
     * 
     * @param alias, the unique user name of the user to be created
     * @param passwordHash, the hash of the password to be associated with the new user
     * @param fname, the first name of the user to be created
     * @param lname, the last name of the user to be created
     * @param email, the email address of the user to be created
     * 
     * @precondition alias must be non empty and unique
     * @precondition passwordHash must be exactly 32 characters
     * @precondition email must be non empty and unique
     * 
     * @return 1 if successful, 0 if the alias is already in use
     * 
     * @throws if unable to read or write to persisted memory
     */
    public function createUser($alias, $passwordHash, $fname, $lname, $email);
    
    /**
     * logIn
     * 
     * checks the provided alias and passwordHash against what is persisted
     * and returns whether or not they match
     * 
     * @param alias, the unique user name of the user logging in
     * @param passwordHash, the hash of the password provided by the user logging in
     * 
     * @precondition alias must be non empty
     * @precondition passwordHash must be exactly 32 characters
     * 
     * @return 1 if the login credentials are authentic, 0 if they are not
     * 
     * @throws if unable to read the persisted memory
     */
    public function logIn($alias, $passwordHash);
    
    /**
     * clearAll
     * 
     * removes all persisted users
     */
     public function clearAll();
}

?>