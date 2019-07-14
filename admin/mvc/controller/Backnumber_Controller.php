<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Backnumber_Controller extends Base_Controller
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
        $ct_model = new Category_Model();
        $category_list = $ct_model->shortCate();

        foreach ($category_list as $value) {
            $data['category'][$value['category_id']] = $value;
        }

        $this->model->load('backnumber');
        $bn_model = new Backnumber_Model();
        $data['backnumber'] = $bn_model->all();

        $this->load_header();
        $this->load_top_bar();
        $this->view->load('backnumber/index', $data);
        $this->load_footer();
        $bn_model->db_close();
    }

    public function addAction()
    {
        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $data = $_POST;

        if ( $data ) {
            $error = $model->add($data);

            if ( !$error ) {
                $model->db_close();
                header('Location: /admin/backnumber/');
                exit;
            }
        }

        echo 'Error!!!';
        $model->db_close();
    }

    public function editAction()
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/backnumber/');
            exit;
        }

        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $dataPost = $_POST;

        if ($dataPost) {
            $error = $model->edit($id, $dataPost);

            if (!$error) {
                $model->db_close();
                header('Location: /admin/backnumber/');
                exit;
            }

            $data['error'] = 'Update error, Please check input data';
        }

        $this->model->load('vol');
        $vol_model = new Vol_Model();
        $vol_list = $vol_model->shortVol();

        foreach ($vol_list as $value) {
            $data['vol'][$value['vol_number']] = $value;
        }

        $this->model->load('category');
        $ct_model = new Category_Model();
        $category_list = $ct_model->shortCate();

        foreach ($category_list as $value) {
            $data['category'][$value['category_id']] = $value;
        }

        $this->load_header();
        $this->load_top_bar();

        $data['backnumber'] = $model->getRowById($id);
        $this->view->load('backnumber/edit', $data);

        $this->load_footer();
        $model->db_close();
    }

    public function deleteAction()
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/backnumber/');
            exit;
        }

        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $error = $model->delete($id);

        if ( !$error ) {
            $model->db_close();
            header('Location: /admin/backnumber/');
            exit;
        }

        echo 'Error!!!';
        $model->db_close();
    }

    public function deleteItemsAction()
    {
        $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

        if (!$arr) {
            header('Location: /admin/backnumber/');
            exit;
        }

        $this->model->load('backnumber');
        $model = new Backnumber_Model();
        $error = $model->deleteAll($arr);

        if ( !$error ) {
            $model->db_close();
            header('Location: /admin/backnumber/');
            exit;
        }

        echo 'Error!!!';
        $model->db_close();
    }
}
