<?php if (!defined('PATH_SYSTEM')) die('Bad requested!');

class Helper_Controller extends Base_Controller
{
    public function indexAction()
    {
        $this->model->load('helper');
        $model = new Helper_Model();
        $getKeyLanguage = $model->get_language();
        $model->db_close();
        $getValueLanguage = get_cache('translate_language');

        foreach ($getKeyLanguage as $vg) {
            $data['language'][base64_encode($vg)] = $getValueLanguage[base64_encode($vg)];
        }

        $this->load_header();
        $this->load_top_bar();
        $this->view->load('helper/index', $data);
        $this->load_footer();
    }

    public function languageAction()
    {
        $dataPost = $_POST;
        if ($dataPost['language']) {
            delete_cache('translate_language', $dataPost['language']);
            set_cache('translate_language', $dataPost['language']);
        }
        header('Location: /admin/helper/?lang=' . LANGUAGE_CODE);
        exit;
    }

    public function imagickAction()
    {
        $message = "";

        if ( IMAGICK && isset($_POST['folder']) ) {
            $dir    = $_SERVER['DOCUMENT_ROOT'] . '/data/uploads/' . $_POST['folder'];
            $arrFile = glob($dir . '*.{jpg,gif,png}', GLOB_BRACE);
            $img = new Imagick();

            foreach ($arrFile as $value) {
                $path_parts = pathinfo($value);
                $file_name = $path_parts['filename'];
                $file_ext = $path_parts['extension'];

                preg_match_all('#\b(-op|-thumb)\b#', $file_name, $matches);

                if ( empty($matches[0]) && empty($matches[1]) ) {
                    $dest = $_SERVER['DOCUMENT_ROOT'] . '/data/uploads/' . $_POST['folder'] . $file_name . '-op.' . $file_ext;
                    $dest2 = $_SERVER['DOCUMENT_ROOT'] . '/data/uploads/' . $_POST['folder'] . $file_name . '-thumb.' . $file_ext;

                    $img->readImage($value);
                    $img->setImageCompression(imagick::COMPRESSION_JPEG);
                    $img->setImageCompressionQuality(80);
                    $img->stripImage();
                    file_put_contents($dest, $img);

                    $img->resizeImage(75, 0, imagick::FILTER_LANCZOS, 1);
                    file_put_contents($dest2, $img);

                    $img->clear();
                }
            }

            $img->destroy();

            $message = 1;
        } else {
            $message = 0;
        }

        if ( $message ) {
            header('Location: /admin/helper/?lang=' . LANGUAGE_CODE . '&imgop_status=' . $message);
            exit;
        }
    }

    public function vol_imagesAction()
    {
        $ds = $_SERVER['DOCUMENT_ROOT'] . '/' . PATH_UPLOADS;  //1
        $storeFolder = '/vol/images/pdf/';   //2

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];          //3
            $targetPath = $ds . $storeFolder;  //4
            $targetFile =  $targetPath . str_replace(' ', '_', strtolower($_FILES['file']['name']));  //5

            if (file_exists($targetFile)) {
                unlink($targetFile);
            }
            move_uploaded_file($tempFile, $targetFile); //6
            $this->imagick($targetFile, $targetPath);
        }
    }

    public function imagick($file_path, $output) {
        if ( IMAGICK && file_exists($file_path) ) {
            $img = new Imagick();

            $path_parts = pathinfo($file_path);
            $file_name = $path_parts['filename'];
            $file_ext = $path_parts['extension'];

            // $dest1 = $_SERVER['DOCUMENT_ROOT'] . '/' . $output . $file_name . '-op.' . $path_parts['extension'];
            $dest2 = $output . $file_name . '-thumb.' . $path_parts['extension'];

            $img->readImage($file_path);
            // $img->setImageCompression(imagick::COMPRESSION_JPEG);
            // $img->setImageCompressionQuality(80);

            $img->stripImage();
            // file_put_contents($dest1, $img);

            $img->resizeImage(75, 0, imagick::FILTER_LANCZOS, 1);
            file_put_contents($dest2, $img);

            $img->clear();
            $img->destroy();
        }
    }
}
