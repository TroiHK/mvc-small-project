<?php

if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Category_Controller extends Base_Controller
{
  public function indexAction()
  {
    $data = get_cache('category');
    if ($data == false) {
      $this->model->load('category');
      $model = new Category_Model();
      $arr = array(
        'table' => 'category',
        'order_by' => 'category_id DESC',
      );
      $data = $model->db_get_data($arr);
      $model->db_close();
      set_cache('category', $data);
    }
    $this->load_header();
    $this->load_top_bar();
    $this->view->load('category/index', $data);
    $this->load_footer();
  }

  public function addAction()
  {
    if ($_SESSION['permission'] != 1) {
      header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
      exit;
    }
    $data = $_POST;

    if ($data) {
      $this->model->load('category');
      $model = new Category_Model();
      $error = $model->add($data);
      $model->db_close();
      if (!$error) {
        delete_cache('category');
        header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
        exit;
      }
      $data['error'] = 'Add error, Please check input data';
    }

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('category/add', $data);
    $this->load_footer();
  }

  public function editAction()
  {
    $id = $_GET['id'];
    if (!$id || $_SESSION['permission'] != 1) {
      header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('category');
    $model = new Category_Model();
    $dataPost = $_POST;

    if ($dataPost) {
      $error = $model->edit($id, $dataPost);
      if (!$error) {
        $model->db_close();
        delete_cache('category');
        header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
        exit;
      }
      $data['error'] = 'Update error, Please check input data';
    }

    $arr = array(
      'table' => 'category',
      'where' => array(
        array(
          'key' => 'category_id',
          'value' => $id,
          'operator' => '='
        )
      )
    );
    $data = $model->db_get_data($arr, 'row');
    $model->db_close();

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('category/edit', $data);
    $this->load_footer();
  }

  public function deleteAction()
  {
    $id = $_GET['id'];

    if (!$id) {
      header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('category');
    $model = new Category_Model();
    $error = $model->delete($id);
    $model->db_close();

    if (!$error) {
      delete_cache('category');
      header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
      exit;
    }

    echo 'Error!!!';
  }

  public function deleteItemsAction()
  {
    $arr = isset($_GET['arr']) ? $_GET['arr'] : array();

    if (!$arr) {
      header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
      exit;
    }

    $this->model->load('category');
    $model = new Category_Model();
    $error = $model->deleteAll($arr);
    $model->db_close();

    if (!$error) {
      delete_cache('category');
      header('Location: /admin/category/?lang=' . LANGUAGE_CODE);
      exit;
    }

    echo 'Error!!!';
  }
}
