<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Base_Controller extends KL_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function load_header($string = 'blocks/header')
    {
        // data
        $data = array();
        $arrUrl = explode('/', $_SERVER['PHP_SELF']);
        $data['page_slug'] = $arrUrl[2];

        // Load view
        $this->view->load($string, $data);
    }

    public function load_top_bar($string = 'blocks/top_bar')
    {
        // data
        $data = array();
        $arrUrl = $_SERVER['PHP_SELF'];
        $data['url'] = trim($arrUrl, 'index.php');
        $data['class_menu_vi'] = LANGUAGE_CODE == 'vi' ? 'bg-success' : 'bg-secondary';
        $data['class_menu_ja'] = LANGUAGE_CODE == 'ja' ? 'bg-success' : 'bg-secondary';

        // Load view
        $this->view->load($string, $data);
    }

    public function load_footer($string = 'blocks/footer')
    {
        // Load view
        $this->view->load($string);
    }

    // Hàm hủy này có nhiệm vụ show nội dung của view, lúc này các controller
    // không cần gọi đến $this->view->show nữa
    public function __destruct()
    {
        $this->view->show();
    }
}