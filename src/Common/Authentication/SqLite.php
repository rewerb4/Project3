<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 3/17/2015
 * Time: 8:26 PM
 */

namespace Common\Authentication;


use PDO;


class SqLite implements IAuthentication
{
    /**
     * Function authenticate
     *
     * @param string $username
     * @param string $password
     * @return mixed
     *
     * @access public
     */
    public function authenticate($username, $password)
    {

        // TODO: Implement authenticate() method.
            //open database
       /* $username = $_GET['username'];
        $password = $_GET['password'];

        // Escape User Input to help prevent SQL Injection
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        */

        $db = new PDO('sqlite:../src/Common/Authentication/Users_PDO');
    /*
        if(!$db)
        {
            echo $db->lastErrorMsg();
        }
        else
        {
            echo "Opened database successfully\n";
        }

        $db->exec("CREATE TABLE user (Id INTEGER PRIMARY KEY, username VARCHAR, password VARCHAR)");


        $ret = $db->exec("INSERT INTO user (username,password) VALUES ('mat', 'hi');"."INSERT INTO user (username,password) VALUES ('john', 'hello');" );
        if (!$ret)
        {
            echo $db->lastErrorMsg();
        }
        else
        {
            echo "Records created successfully\n";
        }
       */

        $rows = $db->query("SELECT count(*) as count FROM user WHERE username = '$username' AND password= '$password'");
        $numRows = $rows->fetchColumn();

        if ($numRows == 1)
        {
            //echo "authorized with SQLite3 Welcome- ".$username;
            return 1;
        }
        else
        {
           // echo "not authorized";
            return 0;
        }
        //close database
        $db = NULL;

    }

}