<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Main_Controller extends Base_Controller
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

        // Get Backnumber html
        $data_cache_backnumber = get_cache('backnumber_main_' . LANGUAGE_CODE);

        if (empty($data_cache_backnumber) || count($_GET) > 1) {
            $this->model->load('main');
            $main_model = new Main_Model();
            $data_backnumber = $main_model->all($_GET);
            $data['backnumber_html'] = $main_model->renderList($data_backnumber, $data['vol'], $data['category']);
            $main_model->db_close();

            if (empty($data_cache_backnumber) && ((count($_GET) == 0) || (isset($_GET['lang']) && count($_GET) == 1))) {
                set_cache('backnumber_main_' . LANGUAGE_CODE, $data['backnumber_html']);
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

        // Render HTML
        $this->load_header();
        $this->load_top_bar();
        $this->view->load('index', $data);
        $this->load_footer();
    }

    public function importAction()
    {
        // Include Library
        require_once(PATH_VENDOR . '/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require_once(PATH_VENDOR . '/spreadsheet-reader/SpreadsheetReader.php');

        // Move file import to server
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . PATH_UPLOADS . '/import-files/' . $_FILES['file']['name'];
        if (file_exists($targetPath)) {
            unlink($targetPath);
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        // Import to db
        try {
            $Spreadsheet = new SpreadsheetReader($targetPath);
            // $BaseMem = memory_get_usage();
            $Sheets = $Spreadsheet->Sheets();

            foreach ($Sheets as $Index => $Name) {
                $Spreadsheet->ChangeSheet($Index);

                $this->model->load('main');
                $model = new Main_Model();

                $error = "";
                if ($Spreadsheet) {
                    $error = $model->import($Spreadsheet);
                    $model->db_close();
                    delete_cache('backnumber_vi');
                    delete_cache('backnumber_ja');
                    delete_cache('backnumber_main_vi');
                    delete_cache('backnumber_main_ja');
                    if (empty($error)) {
                        header('Location: /admin/backnumber/?lang=' . LANGUAGE_CODE);
                        exit;
                    }
                }
                echo 'Lỗi dòng ' . $error;
            }
        } catch (Exception $E) {
            echo $E->getMessage();
        }
    }
}
