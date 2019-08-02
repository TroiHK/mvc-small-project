<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Login_Controller extends Base_Controller
{
    public function indexAction()
    {
        if ( isset($_SESSION["user_id"]) ) {
            header('Location: /admin/?lang='.LANGUAGE_CODE);
            exit;
        }

        $error = false;
        $data = $_POST;

        if ( $data ) {
            $this->library->load('custom');
            $library = new Custom_Library();

            $this->model->load('login');
            $model = new Login_Model();
            $error = $model->check_login($data, $library);
            $model->db_close();

            if ( !$error ) {
                $lang = $_SESSION['setting']['default_language'] ? $_SESSION['setting']['default_language'] : 'vi';
                header('Location: /admin/?lang='.$lang);
                exit;
            }
        }

        $data['error'] = $error;
        $this->load_header('blocks/header-login');
        $this->view->load('login', $data);
        $this->load_footer('blocks/footer-login');
    }

    public function forgot_passwordAction()
    {
        $email = $_POST['user-email'];
        if(isset($email) && !empty($email)){
            $this->library->load('custom');
            $library = new Custom_Library();

            $this->model->load('login');
            $model = new Login_Model();
            $error = $model->forgot_password($email,$library);
            $model->db_close();

            if ( !$error ) {
                header('Location: /admin/login?status=1');
                exit;
            }
        }

        header('Location: /admin/login?status=2');
        exit;
    }

    public function logoutAction()
    {
        session_destroy();
        header('Location: /admin/login/');
        exit;
    }
}