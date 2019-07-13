<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Login_Controller extends Base_Controller
{
    public function indexAction()
    {
        if ( isset($_SESSION["AdminId"]) ) {
            header('Location: /admin/');
            exit;
        }

        $this->library->load('custom');
        $library = new Custom_Library();

        $this->model->load('login');
        $model = new Login_Model();

        $error = false;
        $data = $_POST;
        if ( $data ) {
            $error = $model->check_login($data, $library);

            if ( !$error ) {
                $model->db_close();
                header('Location: /admin/');
                exit;
            }
        }

        $data['error'] = $error;
        $this->load_header('blocks/header-login');
        $this->view->load('login', $data);
        $this->load_footer('blocks/footer-login');
        $model->db_close();
    }

    public function logoutAction()
    {
        session_destroy();
        header('Location: /admin/login/');
        exit;
    }
}