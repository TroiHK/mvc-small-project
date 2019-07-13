<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Login_Model extends KL_Model
{
    public function check_login($data, $library) {
        $error = false;

        $sql = "SELECT * FROM admin WHERE Username='" . addslashes($data["Username"]) . "' AND Password='" . $library->encrypt(addslashes($data["Username"]), addslashes($data["Password"])) . "'";

        $user = $this->db_get_row($sql);

        if (empty($user)) {
            $error = 'User or password incorrect';
        } else {
            $_SESSION["Permission"] = $user["flag"];
            $_SESSION["AdminId"] = $user["AdminID"];
            $_SESSION["Username"] = addslashes($user["Username"]);
            $_SESSION["Password"] = addslashes($user["Password"]);
        }

        return $error;
    }
}