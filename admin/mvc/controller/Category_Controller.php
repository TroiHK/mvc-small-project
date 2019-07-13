<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Category_Controller extends Base_Controller
{
    public function indexAction()
    {
        $this->model->load('category');
        $model = new Category_Model();

        $this->load_header();
        $this->load_top_bar();

        $data = $model->all();
        $this->view->load('category/index', $data);

        $this->load_footer();
        $model->db_close();
    }

    public function addAction()
    {
        $this->model->load('category');
        $model = new Category_Model();
        $data = $_POST;

        if ( $data ) {
            $error = $model->add($data);

            if (!$error) {
                $model->db_close();
                header('Location: /admin/category/');
                exit;
            }

            $data['error'] = 'Add error, Please check input data';
        }

        $this->load_header();
        $this->load_top_bar();
        $this->view->load('category/add', $data);
        $this->load_footer();
        $model->db_close();
    }

    public function editAction()
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/category/');
            exit;
        }

        $this->model->load('category');
        $model = new Category_Model();
        $dataPost = $_POST;

        if ($dataPost) {
            $error = $model->edit($id, $dataPost);
            if (!$error) {
                $model->db_close();
                header('Location: /admin/category/');
                exit;
            }
            $data['error'] = 'Update error, Please check input data';
        }

        $this->load_header();
        $this->load_top_bar();

        $data = $model->getRowById($id);
        $this->view->load('category/edit', $data);

        $this->load_footer();
        $model->db_close();
    }

    public function deleteAction()
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/category/');
            exit;
        }

        $this->model->load('category');
        $model = new Category_Model();
        $error = $model->delete($id);

        if (!$error) {
            $model->db_close();
            header('Location: /admin/category/');
            exit;
        }
        
        echo 'Error!!!';
        $model->db_close();
    }

    public function deleteItemsAction()
    {
        $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

        if (!$arr) {
            header('Location: /admin/category/');
            exit;
        }

        $this->model->load('category');
        $model = new Category_Model();
        $error = $model->deleteAll($arr);

        if ( !$error ) {
            $model->db_close();
            header('Location: /admin/category/');
            exit;
        }

        echo 'Error!!!';
        $model->db_close();
    }
}
