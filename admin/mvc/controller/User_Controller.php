<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class User_Controller extends Base_Controller
{
  public function indexAction()
  {
    if ($_SESSION['permission'] != 1) {
      header('Location: /admin/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('user');
    $model = new User_Model();
    $arr = array(
      'table' => 'user',
      'where' => array(
        array(
          'key' => 'user_id',
          'value' => '1',
          'operator' => '<>'
        )
      )
    );

    $data = $model->db_get_data($arr);
    $model->db_close();

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('user/index', $data);
    $this->load_footer();
  }

  public function editAction()
  {
    $id = $_GET['id'];
    if (!$id) {
      header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('user');
    $model = new User_Model();

    $dataPost = $_POST;
    if ($dataPost) {
      $this->library->load('custom');
      $library = new Custom_Library();
      $error = $model->edit($id, $dataPost, $library);

      if (!$error) {
        if ($id == $_SESSION['user_id']) {
          $_SESSION['fullname'] = $dataPost['user_fullname'];
        }
        $model->db_close();
        header('Location: /admin/user/?lang=' . LANGUAGE_CODE . '&action=edit&id=' . $id . '&status=1');
        exit;
      }

      $data['error'] = 'Update error, Please check input data';
    }

    $arr = array(
      'table' => 'user',
      'where' => array(
        array(
          'key' => 'user_id',
          'value' => $id,
          'operator' => '='
        )
      )
    );
    $data = $model->db_get_data($arr, 'row');
    $model->db_close();

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('user/edit', $data);
    $this->load_footer();
  }

  public function addAction()
  {
    if ($_SESSION['permission'] != 1) {
      header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $data = $_POST;

    if ($data) {
      $this->model->load('user');
      $model = new User_Model();
      $this->library->load('custom');
      $library = new Custom_Library();

      $arr = array(
        'table' => 'user',
        'where' => array(
          'relation' => 'OR',
          array(
            'key' => 'user_name',
            'value' => $data['user_name'],
            'operator' => '='
          ),
          array(
            'key' => 'user_email',
            'value' => $data['user_email'],
            'operator' => '='
          )
        )
      );

      $check_user = $model->db_get_data($arr);

      if (!$check_user) {
        $error = $model->add($data, $library);
        $model->db_close();
        if (!$error) {
          header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
          exit;
        }
        $data['error'] = 'Add error, Please check input data';
      } else {
        $model->db_close();
        $data['error'] = 'Add error, user name or email already exists';
      }
    }

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('user/add', $data);
    $this->load_footer();
  }


  public function deleteAction()
  {
    $id = $_GET['id'];

    if (!$id) {
      header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('user');
    $model = new User_Model();
    $error = $model->delete($id);
    $model->db_close();

    if (!$error) {
      header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
      exit;
    }

    echo 'Error!!!';
  }

  public function deleteItemsAction()
  {
    $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

    if (!$arr) {
      header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('user');
    $model = new User_Model();
    $error = $model->deleteAll($arr);
    $model->db_close();

    if (!$error) {
      header('Location: /admin/user/?lang=' . LANGUAGE_CODE);
      exit;
    }

    echo 'Error!!!';
  }
}
