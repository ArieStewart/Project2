<?php
/**
 * Created by PhpStorm.
 * User: arielstewart
 * Date: 3/23/15
 * Time: 6:00 PM
 */

namespace Common\Authentication;


class FileBased implements IAuthentication
{
    private $csv;

    public function __construct()
    {
        $fileDir = dirname(__FILE__);

        $this->csv = fopen($fileDir.DIRECTORY_SEPARATOR.'UserCSV.csv', 'r');
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
        if(is_null($this->csv))
        {
            echo 'Could not locate file.';
            return false;
        }

        while(! feof($this->csv))
        {
            $csvRow = fgetcsv($this->csv);

            if($csvRow[0] === $username && $csvRow[1] === $password)
            {
                return true;
            }
        }

        fclose($this->csv);
        return false;
    }
}