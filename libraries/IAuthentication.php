<?php
/**
 * File name: IAuthentication.php
 *
 * Project: Project1
 *
 * PHP version 5
 *
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Libraries\Authentication;


interface IAuthentication 
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
    public function __construct($posting);

    public function authenticate();

}
