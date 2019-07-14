<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Vol_Controller extends Base_Controller
{
    public function indexAction()
    {
        $this->model->load('vol');
        $model = new Vol_Model();
        $data = $model->all();

        $this->load_header();
        $this->load_top_bar();
        $this->view->load('vol/index', $data);
        $this->load_footer();
        $model->db_close();
    }

    public function editAction()
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/vol/');
            exit;
        }

        $this->model->load('vol');
        $model = new Vol_Model();
        $dataPost = $_POST;

        if ($dataPost) {
            $error = $model->edit($id, $dataPost);

            if (!$error) {
                $model->db_close();
                header('Location: /admin/vol/');
                exit;
            }

            $data['error'] = 'Update error, Please check input data';
        }

        $this->load_header();
        $this->load_top_bar();

        $data = $model->getRowById($id);
        $this->view->load('vol/edit', $data);

        $this->load_footer();
        $model->db_close();
    }

    public function jsonAction() {
        $this->model->load('vol');
        $model = new Vol_Model();
        $data = $model->all();
        $model->db_close();

        header('Content-Type: application/json');
        echo json_encode(array('data' => $data));
    }

    public function addAction()
    {
        $this->model->load('vol');
        $model = new Vol_Model();

        $data = $_POST;
        if ( $data ) {
            $error = $model->add($data);

            if ( !$error ) {
                $model->db_close();
                header('Location: /admin/vol/');
                exit;
            }
        }

        echo 'Error!!!';
        $model->db_close();
    }

    public function deleteAction()
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /admin/vol/');
            exit;
        }

        $this->model->load('vol');
        $model = new Vol_Model();
        $error = $model->delete($id);

        if ( !$error ) {
            $model->db_close();
            header('Location: /admin/vol/');
            exit;
        }

        echo 'Error!!!';
        $model->db_close();
    }

    public function deleteItemsAction()
    {
        $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

        if (!$arr) {
            header('Location: /admin/vol/');
            exit;
        }

        $this->model->load('vol');
        $model = new Vol_Model();
        $error = $model->deleteAll($arr);

        if ( !$error ) {
            $model->db_close();
            header('Location: /admin/vol/');
            exit;
        }

        echo 'Error!!!';
        $model->db_close();
    }
}