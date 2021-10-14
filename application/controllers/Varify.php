<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Varify extends CI_Controller {
	function __construct(){  
		parent::__construct();
        $this->load->model('Home_model','home');
	}
	
	public function index()
	{    
		echo "welcome";die;  
		$this->load->view('login');
	}

    public function login(){  
		if(isset($_POST['submit'])){ //echo "sdafsd";die;
			$data['user_id'] = $_POST['email'];
			$data['password'] = $_POST['password'];
            
			$checkId = $this->home->checkuserlogin($data);
            print_r($checkId);die();
			if($checkId)				
			{	
				$result = $this->home->CheckLogin($data);
				if (count($result) == '1') 	
				{	
					//~ echo "<pre>";print_r($result);die();
					$this->session->set_userdata('userlogin',$result);
                    redirect('verify');
				}else{
					$msg = 'Id and Password not match !';
					$this->session->set_flashdata('message', '<div id="successMsg" class="alert alert-danger">'.$msg.'</div>');			
					redirect('home');				
				}
			}		
			else{
				$msg = 'Enter Valid User Id!';			
				$this->session->set_flashdata('message', '<div id="successMsg" class="alert alert-danger">'.$msg.'</div>');
				redirect('home');				
			}
		}
		$this->load->view('login');
	}

    public function forgetpassword()
    {  //phpinfo();die();
	$data['title'] = 'Forget Password';
	$data['pages'] = 'forgot_password';
	if(isset($_POST['submit'])){
	    $v['to'] = $_POST['email_id'];
	    $v['from'] = 'deepak.shantiinfotech@gmail.com';
	    $v['subject'] = "For Conformation";
	    $v['message'] = "Reset Password <a href='".base_url('home/passwordreset?con="'.base64_encode($_POST['email_id']))."'>Click here...</a><br/>";
	    $send = $this->Common_model->send_mail($v);
	    if($send){
		$msg = "Mail successfully send";
		$this->session->set_flashdata('message', '<div id="successMsg" class="alert alert-success">'.$msg.'</div>');
		redirect('home/login', 'refresh');
            }	
	}
	$this->load->view('front/layout',$data);
    }    
}
