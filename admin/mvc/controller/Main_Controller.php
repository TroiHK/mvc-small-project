<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Main_Controller extends Base_Controller
{
    public function indexAction()
    {
        $this->model->load('vol');
        $vol_model = new Vol_Model();
        $vol_list = $vol_model->shortVol();

        foreach ($vol_list as $value) {
            $data['vol'][$value['vol_number']] = $value;
        }

        $this->model->load('category');
        $category_model = new Category_Model();
        $category_list = $category_model->shortCate();

        foreach ($category_list as $value) {
            $data['category'][$value['category_id']] = $value;
        }

        $this->model->load('main');
        $main_model = new Main_Model();
        $data['backnumber'] = $main_model->all($_GET);

        $data['vol_id'] = isset($_GET['vol_id']) ? $_GET['vol_id'] : -1;
        $data['pdf_page'] = isset($_GET['pdf_page']) ? $_GET['pdf_page'] : "";
        $data['book_page'] = isset($_GET['book_page']) ? $_GET['book_page'] : "";
        $data['category_id'] = isset($_GET['category_id']) ? $_GET['category_id'] : -1;
        $data['content'] = isset($_GET['content']) ? $_GET['content'] : "";
        $data['series_name'] = isset($_GET['series_name']) ? $_GET['series_name'] : "";

        $this->load_header();
        $this->load_top_bar();
        $this->view->load('index', $data);
        $this->load_footer();
        $main_model->db_close();
    }

    public function importAction()
    {
        $this->library->load('simpleXLS');

        $data = $_FILES;
        $fileName = $data["file"]["tmp_name"];

        $data_xls = array();
        if ($data["file"]["size"] > 0) {
            $xls = new SimpleXLS_Library($fileName);
            if ($xls->success()) {
                $data_xls = $xls->rows();
            } else {
                echo 'xls error: ' . $xls->error();
                die();
            }
        }

        $this->model->load('main');
        $model = new Main_Model();

        $error = "";
        if ( $data_xls ) {
            $error = $model->import($data_xls);

            if ( empty($error) ) {
                $model->db_close();
                header('Location: /admin/backnumber/');
                exit;
            }
        }
        echo 'Lỗi dòng '. $error;
        $model->db_close();
    }
}