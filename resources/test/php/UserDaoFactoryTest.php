<?php

require_once("simpletest/autorun.php");
require_once("../../main/php/UserDaoFactory.php");

class UserDaoFactoryTest extends UnitTestCase
{
    function testGetInstance_shouldNotBeNull()
    {
        $actual = UserDaoFactory::getInstance();
        $this->assertNotNull($actual);
    }
    
    function testGetInstance_objectIsAnIUserDao()
    {
        $instance = UserDaoFactory::getInstance();
        $interfaces = class_implements($instance);
        $actual = in_array('iUserDao', $interfaces);
        $this->assertTrue($actual);
    }
}

?>