<?php

require_once('simpletest/autorun.php');
require_once('../../main/php/library.php');

Mock::generate('iUserDao');

class UserControllerTest extends UnitTestCase
{
    private $mockDao;
    private $controller;
    
    private $validAlias = 'testAlias';
    private $validPassword = 'password';
    private $validEmail = 'a@b.c';
    
    function setUp()
    {
        $this->mockDao = new MockiUserDao();
        $this->controller = new UserController($this->mockDao);
    }
    
    function testConstructor_shouldNotBeNull()
    {
        $this->assertNotNull($this->controller);
    }
    
    function testToString_shouldBeClassNameAndInstanceNumber()
    {
        $this->controller = new UserController($this->mockDao);
        $expected = 'UserController';
        $actual = (string)$this->controller;
        $this->assertEqual($expected, substr($actual, 0, strlen('UserController')));
    }
    
    function testCreateUser_shouldCallDaoCreateUserOnce()
    {
        $this->mockDao->returns('createUser', 1);
        $this->mockDao->expectOnce('createUser');
        $this->controller->createUser($this->validAlias, $this->validPassword, 
            '', '', $this->validEmail);
    }
    
    function testCreateUser_emptyAlias_shouldThrowException()
    {
        $this->mockDao->expectNever('createUser');
        $this->expectException(new ControllerException('Empty value for alias'));
        $this->controller->createUser('', $this->validPassword, '', '', 
            $this->validEmail);
            
    }
    
    function testCreateUser_emptyPassword_shouldThrowException()
    {
        $this->mockDao->expectNever('createUser');
        $this->expectException(new ControllerException('Empty value for password'));
        $this->controller->createUser($this->validAlias, '', '', '', 
            $this->validEmail);
            
    }
    
    function testCreateUser_emptyEmail_shouldThrowException()
    {
        $this->mockDao->expectNever('createUser');
        $this->expectException(new ControllerException('Empty value for email'));
        $this->controller->createUser($this->validAlias, $this->validPassword, 
            '', '', '');
            
    }
    
    function testCreateUser_shouldHashPassword()
    {
        $passwordHash = md5($this->validPassword);
        $this->mockDao->returns('createUser', 1);
        $expectedParams = array($this->validAlias, $passwordHash, '', '', 
            $this->validEmail);
        $this->mockDao->expectOnce('createUser', $expectedParams);
        $this->controller->createUser($this->validAlias, $this->validPassword,
            '', '', $this->validEmail);
    }
}

?>