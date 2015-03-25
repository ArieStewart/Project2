<?php
/**
 * File name: AuthController.php
 *
 * Project: Project1
 *
 * PHP version 5
 *
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Controllers;

use Common\Authentication\FileBased;
use Common\Authentication\InMemory;
use Common\Authentication\MySQL;



/**
 * Class AuthController
 */
class AuthController extends Controller
{
    protected $auth;
    /**
     * Function execute
     *
     * @access public
     */
    public function action()
    {
        $postData = $this->request->getPost();
        $this->auth = new InMemory();

        foreach($postData as &$field)
        {
            $field = $this->dataScrub($field);
        }

        $authType = $postData->authType;
        $this->selectAuthType($authType);

        if($this->auth->authenticate($postData->username, $postData->password))
        {
           echo "Log in is successful.";
        }
        else{
            echo "Username or Password is incorrect. Please Try Again.";
        }

    }

    private function selectAuthType($authType)
    {
        if($authType === 'File')
        {
            $this->auth = new FileBased();
            //echo "File type selected.<br />";
        }

        if($authType === 'InMemory')
        {
            $this->auth = new InMemory();
            //echo "InMemory type selected.<br />";
        }

        if($authType === 'MySQL')
        {
            $this->auth = new MySQL();
            //echo "MySQL type selected.<br />";
        }
    }

    public function dataScrub($var)
    {
        if(!isset($var))
        {
            throw new \InvalidArgumentException(__METHOD__.'('.__LINE__.'): Null String');
        }

        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }
}
