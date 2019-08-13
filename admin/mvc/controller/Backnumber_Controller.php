<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Backnumber_Controller extends Base_Controller
{
    public function indexAction()
    {
        // Get vol
        $data_vol = get_cache('vol');
        if ($data_vol) {
            foreach ($data_vol as $value) {
                $data['vol'][$value['vol_number']] = $value;
            }
        }

        // Get category
        $data_category = get_cache('category');
        if ($data_category) {
            foreach ($data_category as $value) {
                $data['category'][$value['category_id']] = $value;
            }
        }

        // Get backnumber
        $data_cache_backnumber = get_cache('backnumber_' . LANGUAGE_CODE);

        if ($data_cache_backnumber == false || count($_GET) > 1) {
            $this->model->load('backnumber');
            $bn_model = new Backnumber_Model();
            $data_backnumber = $bn_model->all($_GET);
            $data['backnumber_html'] = $bn_model->renderList($data_backnumber, $data['vol'], $data['category']);
            $bn_model->db_close();

            if (empty($data_cache_backnumber) && ((count($_GET) == 0) || (isset($_GET['lang']) && count($_GET) == 1))) {
                set_cache('backnumber_' . LANGUAGE_CODE, $data['backnumber_html']);
            }
        } else {
            $data['backnumber_html'] = $data_cache_backnumber;
        }

        // Set $_GET variable
        $data['vol_id'] = isset($_GET['vol_id']) ? $_GET['vol_id'] : -1;
        $data['pdf_page'] = isset($_GET['pdf_page']) ? $_GET['pdf_page'] : "";
        $data['book_page'] = isset($_GET['book_page']) ? $_GET['book_page'] : "";
        $data['category_id'] = isset($_GET['category_id']) ? $_GET['category_id'] : -1;
        $data['content'] = isset($_GET['content']) ? $_GET['content'] : "";
        $data['series_name'] = isset($_GET['series_name']) ? $_GET['series_name'] : "";

        // Render html
        $this->load_header();
        $this->load_top_bar();
        $this->view->load('backnumber/index', $data);
        $this->load_footer();
    }

    public function addAction()
    {
        if ($_SESSION['permission'] != 1) {
            die('You don\'t have permission to access this page!');
        }

        $data = $_POST;

        if ($data) {
            $this->model->load('backnumber');
            $model = new Backnumber_Model();
            $error = $model->add($data);
            $model->db_close();

            if (!$error) {
                delete_cache('backnumber_vi');
                delete_cache('backnumber_ja');
                delete_cache('backnumber_main_vi');
                delete_cache('backnumber_main_ja');

                header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
                exit;
            }
        }

        echo 'Error!!!';
    }

    public function editAction()
    {
        if ($_SESSION['permission'] != 1) {
            die('You don\'t have permission to access this page!');
        }

        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
            exit;
        }

        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $dataPost = $_POST;

        if ($dataPost) {
            $error = $model->edit($id, $dataPost);
            $model->db_close();

            if (!$error) {
                delete_cache('backnumber_vi');
                delete_cache('backnumber_ja');
                delete_cache('backnumber_main_vi');
                delete_cache('backnumber_main_ja');

                header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
                exit;
            }

            $data['error'] = 'Update error, Please check input data';
        }

        // Get row Backnumber
        $arr = array(
            'table' => 'backnumber',
            'where' => array(
                array(
                    'key' => 'backnumber_id',
                    'value' => $id,
                    'operator' => '='
                )
            )
        );
        $data['backnumber'] = $model->db_get_data($arr, 'row');
        $model->db_close();

        // Get vol
        $data_vol = get_cache('vol');

        foreach ($data_vol as $value) {
            $data['vol'][$value['vol_number']] = $value;
        }

        // Get category
        $data_category = get_cache('category');

        foreach ($data_category as $value) {
            $data['category'][$value['category_id']] = $value;
        }

        // Render html
        $this->load_header();
        $this->load_top_bar();
        $this->view->load('backnumber/edit', $data);
        $this->load_footer();
    }

    public function deleteAction()
    {
        if ($_SESSION['permission'] != 1) {
            die('You don\'t have permission to access this page!');
        }

        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
            exit;
        }

        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $error = $model->delete($id);
        $model->db_close();

        if (!$error) {
            delete_cache('backnumber_vi');
            delete_cache('backnumber_ja');
            delete_cache('backnumber_main_vi');
            delete_cache('backnumber_main_ja');

            header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
            exit;
        }

        echo 'Error!!!';
    }

    public function deleteItemsAction()
    {
        if ($_SESSION['permission'] != 1) {
            die('You don\'t have permission to access this page!');
        }

        $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

        if (!$arr) {
            header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
            exit;
        }

        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $error = $model->deleteAll($arr);
        $model->db_close();

        if (!$error) {
            delete_cache('backnumber_vi');
            delete_cache('backnumber_ja');
            delete_cache('backnumber_main_vi');
            delete_cache('backnumber_main_ja');

            header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
            exit;
        }

        echo 'Error!!!';
    }
}
