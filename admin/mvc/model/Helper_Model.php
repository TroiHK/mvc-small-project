<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Helper_Model extends KL_Model
{
    public function get_language(){
        $arrLanguage = include(PATH_APPLICATION . '/language/index.php');
        return $arrLanguage;
    }
}
