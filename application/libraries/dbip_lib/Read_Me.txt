Welcome to dbip CI library 
=========================
Created by Zahid - 2021

This library will work on remote and banglaflix server only 

=========================

Step 1:

Copy and paste dbip_lib to Application/libraries

Step 2: 

Copy and paste dbip_helper to application/third_party

Step 3:

Copy and paste dbip to application/models

Step 4:

Now add this code in your controller class

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/dbip_lib/Ipinfo.php';
class Classname extends CI_Controller {
 
    function __construct() {
        parent::__construct();  
        $this->Ipinfo = new Ipinfo();
        header('Content-Type: application/json');
    }

    public function getipinfo()
    {
        $ip = $this->input->post('ip',true);
        echo $this->Ipinfo->get_ip_info($ip);
    }
    
 
}
