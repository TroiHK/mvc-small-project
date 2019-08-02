<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Vol_Controller extends Base_Controller
{
  public function indexAction()
  {
    $data = get_cache('vol');
    if ($data == false) {
      $this->model->load('vol');
      $model = new Vol_Model();
      $arr = array(
        'table' => 'vol',
        'order_by' => 'vol_number DESC'
      );
      $data = $model->db_get_data($arr);
      $model->db_close();
      set_cache('vol', $data);
    }

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('vol/index', $data);
    $this->load_footer();
  }

  public function editAction()
  {
    $id = $_GET['id'];

    if (!$id || $_SESSION['permission'] != 1) {
      header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $dataPost = $_POST;

    $this->model->load('vol');
    $model = new Vol_Model();

    if ($dataPost) {
      $error = $model->edit($id, $dataPost);

      if (!$error) {
        $model->db_close();
        delete_cache('vol');
        header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
        exit;
      }

      $data['error'] = 'Update error, Please check input data';
    }

    $arr = array(
      'table' => 'vol',
      'where' => array(
        array(
          'key' => 'vol_id',
          'value' => $id,
          'operator' => '='
        )
      )
    );
    $data = $model->db_get_data($arr, 'row');
    $model->db_close();

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('vol/edit', $data);
    $this->load_footer();
  }

  public function jsonAction()
  {
    $this->model->load('vol');
    $model = new Vol_Model();
    $data = $model->all();
    $model->db_close();

    header('Content-Type: application/json');
    echo json_encode(array('data' => $data));
  }

  public function addAction()
  {
    $data = $_POST;
    if ($data) {
      $this->model->load('vol');
      $model = new Vol_Model();
      $error = $model->add($data);
      $model->db_close();

      if (!$error) {
        delete_cache('vol');
        header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
        exit;
      }
    }

    echo 'Error!!!';
  }

  public function deleteAction()
  {
    $id = $_GET['id'];

    if (!$id || $_SESSION['permission'] != 1) {
      header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('vol');
    $model = new Vol_Model();
    $error = $model->delete($id);
    $model->db_close();

    if (!$error) {
      delete_cache('vol');
      header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
      exit;
    }

    echo 'Error!!!';
  }

  public function deleteItemsAction()
  {
    $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

    if (!$arr || $_SESSION['permission'] != 1) {
      header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('vol');
    $model = new Vol_Model();
    $error = $model->deleteAll($arr);
    $model->db_close();

    if (!$error) {
      delete_cache('vol');
      header('Location: /admin/vol/?lang=' . LANGUAGE_CODE);
      exit;
    }

    echo 'Error!!!';
  }
}
