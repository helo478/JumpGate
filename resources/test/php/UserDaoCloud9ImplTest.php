<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("simpletest/autorun.php");
require_once("../../main/php/UserDaoCloud9Impl.php");

class UserDaoCloud9ImplTest extends UnitTestCase {


    private $mysqli;
    
    private $table = 'users';

    private $alias1 = "testAlias1";
    private $email1 = "testEmail1";
    
    private $alias2 = "testAlias2";
    private $email2 = "testEmail2";
    
    private $passwordHash = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEF";
    private $fname = "testFirstName";
    private $lname = "testLastName";
    
    function __construct()
    {
        parent::__construct();
        
        // Set up the mysqli object
        $host = getenv('IP');
        $user = getenv('C9_USER');    
        $password = '';
        $database = 'jumpgate';
        $port = 3306;
        $this->mysqli = new mysqli($host, $user, $password, $database, $port);
        if (!$this->mysqli) {
            die('Connection failed: ' . $this->mysqli->connect_error);
        }
    }

    function setUp()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->clearAll();
    }
    
    function tearDown()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->clearAll();
    }

    function testConstructor_shouldNotError()
    {
        $dao = new UserDaoCloud9Impl();
        $this->pass('UsuerDaoCloud9Impl constructor should not error');
    }

    function testCreateUser_shouldAddARowToTable()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->createUser($this->alias1, $this->passwordHash, $this->fname, 
            $this->lname, $this->email1);
            
        $expected = 1;
        $actual = $this->_getRowCount();
        
        $this->assertEqual($expected, $actual);
    }
    
    function testCreateUser_shouldReturnTrue()
    {
        $dao = new UserDaoCloud9Impl();
            
        $expected = true;
        $actual = $dao->createuser($this->alias1, $this->passwordHash, 
            $this->fname, $this->lname, $this->email1);
        
        $this->assertEqual($expected, $actual);
    }
    
    function testCreateuser_2NewUsers_shouldReturnTrue()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->createuser($this->alias1, $this->passwordHash, $this->fname,
            $this->lname, $this->email1);
        
        $expected = true;
        $actual = $dao->createuser($this->alias2, $this->passwordHash, 
            $this->fname, $this->lname, $this->email2);
            
        $this->assertEqual($expected, $actual);
    }
    
    function testCreateUser_duplicateUser_shouldReturnFalse()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->createuser($this->alias1, $this->passwordHash, $this->fname,
            $this->lname, $this->email1);
        
        $expected = false;
        $actual = $dao->createuser($this->alias1, $this->passwordHash, 
            $this->fname,  $this->lname, $this->email1);
        
        $this->assertEqual($expected, $actual);
        
    }
    
    function testClearAll_tableShouldHave0Rows()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->createUser($this->alias1, $this->passwordHash, $this->fname, 
            $this->lname, $this->email1);
        $dao->clearAll();
        
        $expected = 0;
        $actual = $this->_getRowCount();
        
        $this->assertEqual($expected, $actual);
    }
    
    private function _getRowCount()
    {
        $sql = "SELECT COUNT(*) FROM `$this->table`";
        $result = $this->mysqli->query($sql);
        return $result->fetch_array()[0];
    }
}

echo "test";

?>