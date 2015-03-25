<?php
/**
 * Created by PhpStorm.
 * User: arielstewart
 * Date: 3/23/15
 * Time: 6:04 PM
 */

namespace Common\Authentication;


class InMemory implements IAuthentication
{
    public function __construct()
    {
        $this->inMemArray = [
                        ['Mark','pass123'],
                        ['James','pass456'],
                        ['Stone','pass789']
        ];
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
        $rows = count($this->inMemArray);
        $i = 0;

        while($i < $rows) {

            if ($this->inMemArray[$i][0] === $username && $this->inMemArray[$i][1] === $password) {
                return true;
            }
            $i++;
        }
        return false;
    }
}