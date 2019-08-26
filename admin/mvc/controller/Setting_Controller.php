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

    $data['user_setting'] = isset($_SESSION["setting"]) ? $_SESSION["setting"] : null;

    if ( $_SESSION["permission"] == 1 ) {
      $this->model->load('setting');
      $setting = new Setting_Model();

      $arr = array(
        'select'  => 'config_value',
        'table' => 'config',
        'where' => array(
          array(
            'key' => 'config_key',
            'value' => 'ip_range',
            'operator' => '='
          )
        )
      );
      $ip = $setting->db_get_data($arr, 'row');
      $setting->db_close();

      if ( isset($ip['config_value']) ) {
        $data['ip_range'] = unserialize(base64_decode($ip['config_value']));
      }
    }

    $this->load_header();
    $this->load_top_bar();
    $this->view->load('setting/index', $data);
    $this->load_footer();
  }

  public function ip_rangeAction()
  {
    $dataPost = $_POST;

    if (isset($dataPost) && !empty($dataPost)) {
      $this->model->load('setting');
      $setting = new Setting_Model();
      $error = $setting->add_ip($dataPost);
      $setting->db_close();

      if (!$error) {
        header('Location: /admin/setting/?lang=' . LANGUAGE_CODE);
        exit();
      }

      echo "Error!";
    }
  }
}
