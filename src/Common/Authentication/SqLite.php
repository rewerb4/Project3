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

        if ($numRows == 1) {

            return 1;
        } else {

            return 0;
        }
//close database
        $db = NULL;

    }

    public function create($username, $password)
    {

        if ($username == '')
        {
            echo json_encode(array('success' => false, 'message' => 'Please enter a username.'));
            return 1;
        }
        if ($password == '')
        {
            echo json_encode(array('success' => false, 'message' => 'Please enter a password.'));
            return 1;
        }
        else
        {

            $db = new PDO('sqlite:../src/Common/Authentication/Users_PDO');

            $rows = $db->query("SELECT count(*) as count FROM user WHERE username = '$username' AND password= '$password'");
            $numRows = $rows->fetchColumn();

            if ($numRows == 1)
            {
                echo "username and password already used";
                return 1;
            }
            else
            {
                $db->exec("INSERT INTO user (username,password) VALUES ('$username', '$password');");
                echo json_encode(array('success' => true, 'message' => 'Account created.'));
                return 0;

            }
        }
    }
}
