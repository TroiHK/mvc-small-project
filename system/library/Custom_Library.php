<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Custom_Library
{
    public function addslashes_to_array($aValue) {
        for($i=0;$i<sizeof($aValue);$i++)
            $aValue[$i]=addslashes($aValue[$i]);
        return $aValue;
    }

    public function encrypt($user,$pass) {
        $salt="cetusjapan";
        $encrypt = sha1($pass);
        $letters = array("d", "e", "c", "a", "b", "f", "u");
        $a_salt=str_split($salt);
        $encrypt = str_replace($letters, $a_salt, $encrypt);
        $encrypt = md5($encrypt.$user);
        return $encrypt;
    }
}