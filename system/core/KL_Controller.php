<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class KL_Controller
{
    // Đối tượng view
    protected $view     = NULL;

    // Đối tượng model
    protected $model    = NULL;

    // Đối tượng library
    protected $library  = NULL;

    /**
     * Hàm khởi tạo
     *
     * @desc    Load các thư viện cần thiết
     */
    public function __construct($is_controller = true)
    {
        // Loader Library
        require_once PATH_SYSTEM . '/core/loader/KL_Library_Loader.php';
        $this->library = new KL_Library_Loader();

        // Load View
        require_once PATH_SYSTEM . '/core/loader/KL_View_Loader.php';
        $this->view = new KL_View_Loader();

        // Loader Model
        require_once PATH_SYSTEM . '/core/loader/KL_Model_Loader.php';
        $this->model = new KL_Model_Loader();
    }
}