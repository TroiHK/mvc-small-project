<?php
if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Setting_Controller extends Base_Controller
{
  public function indexAction()
  {
    $id = $_SESSION['user_id'];

    $dataPost = $_POST;

    if (isset($dataPost) && !empty($dataPost)) {
      $this->model->load('setting');
      $setting = new Setting_Model();
      $error = $setting->edit($id, $dataPost);
      $setting->db_close();

      if (!$error) {
        $_SESSION["setting"] = $dataPost['setting'];
        header('Location: /admin/setting/?lang=' . $_SESSION["setting"]['default_language'] . '&status=1');
        exit();
      }

      $data['status'] = '2';
    }

    $data['user_setting'] = $_SESSION["setting"];

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('setting/index', $data);
    $this->load_footer();
  }
}
