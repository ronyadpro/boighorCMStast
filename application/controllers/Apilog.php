<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Apilog extends CMS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_Admin');
    }

    public function index() {
        if ($this->userinfo['permissions']->admin_view) {
            $data['userlist'] = $this->Model_Admin->get_user_list();
            $data['userinfo'] = $this->userinfo;
            $data['title'] = 'Permissions';
            $data['content'] = $this->load->view('view_api_log.php', $data, TRUE);
            $this->load->view('view_layout', $data);
        } else {
            $this->access_denied();
        }
    }

    public function get_logdetails() {
        $param = $this->input->post();

        if ($param['date'] != '') {
            // Current Filename;
            $selecteddate = date("Y-m-d", strtotime($param['date']));
            //$file = FCPATH . 'application/logs/' . 'log-'.$selecteddate.'.php';
            $file = '../logs/' . 'log-'.$selecteddate.'.php';
            // $file = "/var/www/html/boighor-projects/api/application/views/welcome_message.php"
            if (file_exists($file)) {
                $size = filesize($file);

                if ($size >= 5242880) {
                    $suffix = array(
                        'B',
                        'KB',
                        'MB',
                        'GB',
                        'TB',
                        'PB',
                        'EB',
                        'ZB',
                        'YB'
                    );

                    $i = 0;

                    while (($size / 1024) > 1) {
                        $size = $size / 1024;
                        $i++;
                    }

                    $error_warning = 'Warning: Your error log file %s is %s!';
                    $data['error_warning'] = sprintf($error_warning, basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
                } else {
                    $log = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
                    $lines = explode("\n", $log);
                    $content = implode("\n", array_slice($lines, 1));
                    $data['log'] = $content;
                    $data['status']='success';
                    $data['msg'] = "content found";
                    $data['file'] = $file;

                }
            }else {
                $data['log'] = '';
                $data['status']='failed';
                $data['msg'] = "content not found";
            }

        }else {
            $data['log'] = '';
            $data['status']='failed';
            $data['msg'] = "No date selected";
        }

        echo json_encode($data);

    }

    public function update_user_permission() {
        if ($this->userinfo['permissions']->admin_update) {
            echo $this->Model_Admin->update_user_permission($_POST['username'], $_POST['field'], $_POST['value']);
        } else {
            $this->access_denied();
        }
    }

}
