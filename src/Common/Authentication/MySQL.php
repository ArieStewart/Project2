<?php
/**
 * Created by PhpStorm.
 * User: arielstewart
 * Date: 3/23/15
 * Time: 6:05 PM
 */

namespace Common\Authentication;

use PDO;
use PDOException;


class MySQL implements IAuthentication {

    private $host;
    private $username;
    private $password;
    private $db;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = 'root';
        $this->db = 'CS4350_MySQL';
    }

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
        try
        {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Good Connection";

            $stmt = $dbh->prepare("SELECT username,password FROM Users WHERE username= '".$username."' AND
                password='".$password."';");
            $stmt->execute();

            $stmtReturn = $stmt->fetchAll();

            if(count($stmtReturn) < 0)
            {
                var_dump($stmtReturn);
                return true;
            }
        }
        catch(PDOException $e)
        {
           echo "Error: ".$e->getMessage()."<br />";
        }

        return false;
    }
}