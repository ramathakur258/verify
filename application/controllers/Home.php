
<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//error_reporting(0);
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper('url');
        $this->load->model('Home_model', 'home');
       // $this->load->library('excel');

    }
    
    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        if (isset($_POST['submit'])) { //echo "sdafsd";die;
            $data['user_id'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            
            $checkId = $this->home->checkuserlogin($data);
            if ($checkId) {
                $result = $this->home->CheckLogin($data);
                if (count($result) == '1') {
                    // echo "<pre>";print_r($result);die();
                    $this->session->set_userdata('userlogin', $result);
                    redirect('home/verify');
                } else {
                    $msg = 'Id and Password not match !';
                    $this->session->set_flashdata('message', '<div id="successMsg" class="alert alert-danger">'.$msg.'</div>');
                    redirect('home');
                }
            } else {
                $msg = 'Enter Valid User Id!';
                $this->session->set_flashdata('message', '<div id="successMsg" class="alert alert-danger">'.$msg.'</div>');
                redirect('home');
            }
        }
        $this->load->view('login');
    }

    public function verify()
    {
        if ($this->session->userdata('userlogin') =='') {
            redirect(base_url());
        } else {
            $data['title'] = 'Varify Contact';
    
            $this->load->view('varify', $data);
        }
    }
    
    public function check_contact()
    {
       
        if ($this->session->userdata('userlogin') =='') {
            redirect(base_url());
        } else {
            $data['title'] = 'Varify Contact';
            if (isset($_POST["submit"])) {
                $path = $_FILES["file"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach($object->getWorksheetIterator() as $worksheet)
                {
                 $highestRow = $worksheet->getHighestRow();
                 $highestColumn = $worksheet->getHighestColumn();
                 for($row=2; $row<=$highestRow; $row++)
                 {
                  $number = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                  
                  $data['number'] = $number;
                 }
                }
               // echo "<pre>";
               // print_r($data);
               // die;
               // $file = $_FILES['file']['tmp_name'];
                // echo "<pre>";print_r($file);die;
               //  $handle = fopen($file, "r");
                // echo "<pre>";
                // print_r($handle);
                // echo "</pre>";
                $c = 0;//
                 $output = [];
                // while (($filesop = fgetcsv($data, 1000, ",")) !== false) {
                    foreach($data as $contact){ 
                    // echo  $contact = [0];
                     if ($c>0) {
                       // print_r($contact);echo "<br>";
                      //  echo $contact;
                       //  echo "<br>";//die;
                          $url = "https://apilayer.net/api/validate?access_key=c1267f0074edd9cd1c318698e8aeba87&number=".$contact."&country_code=&format=1";
                         $handle = curl_init();
                         curl_setopt($handle, CURLOPT_URL, $url);
                         curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                         $output = curl_exec($handle);
                         curl_close($handle);
                         echo "<pre>";
                         print_r($output);
                         echo "</pre>";
                     }


                     $c = $c+1;
                }
                
                 $contact = $output;
               
              //  die;
                //echo "sucessfully import data !";
            }
                    if(is_array($contact)): 
                    foreach ($contact as $val) {
                        $ch = curl_init();
                        curl_setopt( $ch,CURLOPT_URL, 'https://apilayer.net/api/validate?access_key=c1267f0074edd9cd1c318698e8aeba87&'.$val->contact.'&country_code=&format=1');
                        curl_setopt( $ch,CURLOPT_POST, true );
                        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $arrayToSend ) );
                        $result = curl_exec($ch);

                        $response = "https://apilayer.net/api/validate?access_key=c1267f0074edd9cd1c318698e8aeba87&number=9754124571&country_code=&format=1";
                    }
                     endif; 
            $this->load->view('varify', $data);
        }
    }
}
// https://apilayer.net/api/validate?access_key=c1267f0074edd9cd1c318698e8aeba87&number=14158586273&country_code=&format=1

