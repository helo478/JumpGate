<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


//echo 'contents of current directory: ' . implode(', ', scandir('../../main/php')); 

require_once("simpletest/autorun.php");
require_once("../../main/php/UserDaoCloud9Impl.php");

class UserDaoCloud9ImplTest extends UnitTestCase {

    private $mysqli;
    private $host;
    private $user;
    private $password = '';
    private $database = 'jumpgate';
    private $port = 3306;
    
    private $table = 'users';

    private $alias1 = "testAlias1";
    private $passwordHash1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEF";
    private $fname1 = "testFirstName1";
    private $lname1 = "testLastName1";
    private $email1 = "testEmail1";
    
    function __construct()
    {
        parent::__construct();
        
        $this->host = getenv('IP');
        $this->user = getenv('C9_USER');
        
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, 
            $this->database, $this->port);
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
        $dao->createUser($this->alias1, $this->passwordHash1, $this->fname1, 
            $this->lname1, $this->email1);
            
        $expected = 1;
        $actual = $this->_getRowCount();
        
        $this->assertEqual($expected, $actual);
    }
    
    function testClearAll_tableShouldHave0Rows()
    {
        $dao = new UserDaoCloud9Impl();
        $dao->createUser($this->alias1, $this->passwordHash1, $this->fname1, 
            $this->lname1, $this->email1);
        $dao->clearAll();
        
        $sql = "SELECT COUNT(*) FROM `$this->table`";
        $mysqli = new mysqli($this->host, $this->user, $this->password, 
            $this->database, $this->port);
        if (!$mysqli) {
            die('Connection failed: ' . $this->mysqli->connect_error);
        }
        
        $result = $mysqli->query($sql);
            
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

?>