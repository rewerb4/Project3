<?php
/**
 * Created by PhpStorm.
 * User: kathytr
 * Date: 3/21/15
 * Time: 9:57 PM
 */

namespace Libraries\Authentication;

use sqlite3;

class InSQLite implements IAuthentication
{
    protected $username = " ";
    protected $password = " ";

    public function __construct($posting)
    {
        $this->username = trim($posting['username']);
        $this->password = trim($posting['password']);
    }


    public function authenticate()
    {
        // Connect to the SQLite3 database file.
        $dbh = new SQLite3(dirname(__FILE__) . '/../database/sqlitelogin.db');

        // Create database and insert data
// 		$query = $dbh->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='user';");
// 
//         if ($query === 0)
//         {
//             $dbh->exec('CREATE TABLE user (username VARCHAR(255), password VARCHAR(255))');
//             $dbh->exec('INSERT INTO user (username, password) VALUES ("Kathytt","kat123")');
//         }
// 
//         $query = $dbh->querySingle("SELECT count(*) FROM user WHERE username='$username' AND password='$password'");



        // Prepare the query to retrieve the user information.
        $statement = $dbh->prepare("SELECT * FROM user WHERE username = :username and password = :password;");

        // Safely replace values in the query with user input.
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':password', $this->password);

        // Execute the query statement.
        $result = $statement->execute();

        // Retrieve the actual records from the executed query.
        $rows = $result->fetchArray(SQLITE3_ASSOC);

        // The fetchArray call above will return a boolean false if no records
        // were found. If a record was found it means the user credentials
        // were correct.
        if ($rows != false && count($rows) > 0)
        {
            echo json_encode(array('success' => true, 'message' => 'SQLite login success. Hello, ' . htmlspecialchars($this->username)));
            return true;
        }

        // If this is reached then the login attempt failed.
        echo json_encode(array('success' => false, 'message' => 'SQLite login failed!'));
        return false;
    }

    public function create()
    {
    	if ($this->username == '')
    	{
    		echo json_encode(array('success' => false, 'message' => 'Please enter a username.'));
    	}
    	else if ($this->password == '')
    	{
    		echo json_encode(array('success' => false, 'message' => 'Please enter a password.'));
    	}
    	else
    	{
	    	$dbh = new SQLite3(dirname(__FILE__) . '/../database/sqlitelogin.db');
	
	    	// Prepare the query to retrieve the user information.
	    	$statement = $dbh->prepare("INSERT INTO `user` (username, password) VALUES (:username, :password);");
	
	    	// Safely replace values in the query with user input.
	    	$statement->bindValue(':username', $this->username);
	    	$statement->bindValue(':password', $this->password);
	
	    	// Execute the query statement.
	    	$result = $statement->execute();
	    	
	    	echo json_encode(array('success' => true, 'message' => 'Account created.'));
    	}
    }

}
