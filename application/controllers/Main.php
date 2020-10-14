<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
        
        // $data = array(
        //     'Email' => 'admin@yahoo.com',
        //     'UserId' => 1,
        //     'IsLoggedIn' => TRUE,
        //     'UserType' => 'Admin',
        //     'FirstName' => 'Admin',
        //     'LastName' => 'Admin'
        // );
        // $this->session->set_userdata($data);
        // redirect('main/dashboard', 'refresh');
        if($this->session->userdata('IsLoggedIn'))
        {        
            $data['title'] = 'Prison Reporting System';
            $data['prisonSummary'] = $this->getPrisonsSummary();

            $data['faviconpartpath'] = base_url().'img/favicon.png';

            $this->load->view('includes/header', $data);
            $this->load->view('view_dashboard', $data);
            $this->load->view('includes/footer', $data);
        }        
        else
        {
            $this->doinitializetasksif();
            $data['faviconpartpath'] = base_url().'img/favicon.png';
            $this->load->view('view_login', $data);
        }         
    }
    
    function doinitializetasksif()
    {
        $this->load->model('model_users');

        $userscount = $this->model_users->getuserscount();

        while(true)
        {
            if($userscount > 0)
            {
                break;
            }

            $userdata = array(
                'FirstName' => 'Admin',
                'LastName' => 'Admin',
                'UserType' => 'Admin',
                'Email' => 'admin@yahoo.com',			
                'Password' => md5('1admin@'),
                'MobileNo' => '0700000000',
            );        

            $query = $this->model_users->createUser($userdata);
            break;
        }
    }

    function dashboard()
    {
        if($this->session->userdata('IsLoggedIn'))
        {
            $this->load->model('model_users');
            $this->load->model('model_prisoners');
            $this->load->model('model_prisons');

            $data['title'] = 'Prison Reporting System';
            $data['users'] = $this->model_users->getallusers();
            $data['userscount'] = $this->model_users->getuserscount();
            $data['prisons'] = $this->model_prisons->getallprisons();
            $data['prisonscount'] = $this->model_prisons->getprisonscount();
            $data['prisoners'] = $this->model_prisoners->getallprisoners();
            $data['prisonerscount'] = $this->model_prisoners->getprisonerscount();

            $data['faviconpartpath'] = base_url().'img/favicon.png';

            $this->load->view('includes/header', $data);
            $this->load->view('view_dashboard', $data);
            $this->load->view('includes/footer', $data);
        }        
        else
        {
            redirect('main', 'refresh');
        }        

    }

    function removeuser($id)
    {
        $this->load->model('model_users');

        $ret = $this->model_users->deleteuser($id);

        $this->session->set_flashdata('message_no', 0);
        $this->session->set_flashdata('message', "User Removed Successfully!");
        $this->session->set_flashdata('hasMessage', 1);
            
        redirect('main/allusers', 'refresh');        
    }

    function getPrisonsSummary()
    {
        $this->load->model('model_prisons');

        $prisonSummary = $this->model_prisons->getPrisonsSummary();

        return $prisonSummary;

    }

    function adduser()
    {
        if($this->session->userdata('IsLoggedIn'))
        {
            $this->load->model('model_users');
            $data['title'] = 'Users';
            $data['randompassword'] = $this->generaterandomPassword();
            $data['faviconpartpath'] = base_url().'img/favicon.png';

            $this->load->view('includes/header', $data);
            $this->load->view('view_add_user', $data);
            $this->load->view('includes/footer', $data);
        }        
        else
        {
            redirect('main', 'refresh');
        }              
    }

    function addprison()

    {
        if($this->session->userdata('IsLoggedIn'))
        {
            $this->load->model('model_users');
            $data['counties'] = $this->model_users->getallcounties();
            $data['faviconpartpath'] = base_url().'img/favicon.png';
            $data['title'] = 'Users';

            $this->load->view('includes/header', $data);
            $this->load->view('view_report_prison', $data);

            $this->load->view('includes/footer', $data);
        }        
        else
        {
            redirect('main', 'refresh');
        }          
    }

    function addusertodb()
    {
        $this->load->model('model_users');

        $firstname = $this->input->post('firstName');
        $lastname = $this->input->post('lastName');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobileNumber');
        $password = $this->input->post('password');

        $data = array(
            'FirstName'   => $firstname,
            'LastName'   => $lastname,
            'Email'   => $email,
            'MobileNo'   => $mobile,
            'Password'   => md5($password),
            'UserType' => 'User'
        );

        $ret = $this->model_users->createUser($data);

        // print_r($res);die();
        if($ret)
        {
            $this->session->set_flashdata('message_no', 0);
            $this->session->set_flashdata('message', "User added successfully");
            $this->session->set_flashdata('hasMessage', 1);

            redirect('main/allusers');
        }
        else
        {
            $this->session->set_flashdata('message_no', 1);
            $this->session->set_flashdata('message', "Error adding User");
            $this->session->set_flashdata('hasMessage', 1);

            redirect('main/adduser', 'refresh');
        }
    }

    function allusers()
    {
        if($this->session->userdata('IsLoggedIn'))
        {
            $this->load->model('model_users');
            $data['users'] = $this->model_users->getallusers();
            $data['faviconpartpath'] = base_url().'img/favicon.png';
            $data['title'] = 'Users';

            $this->load->view('includes/header', $data);
            $this->load->view('view_users', $data);
            $this->load->view('includes/footer', $data);
        }        
        else
        {
            redirect('main', 'refresh');
        }            
    }

    function profile()
    {
        if($this->session->userdata('IsLoggedIn'))
        {
            $this->load->model('model_users');
            $data['user'] = $this->model_users->getuserdataoverid($this->session->userdata('UserId'));
            
            $data['faviconpartpath'] = base_url().'img/favicon.png';
            $data['title'] = 'User - Profile';

            $this->load->view('includes/header', $data);
            $this->load->view('view_user_profile', $data);
            $this->load->view('includes/footer', $data);
        }        
        else
        {
            redirect('main', 'refresh');
        }            
    }

    function loginuser()
    {
        $this->load->model('model_users');

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $userType = $this->input->post('userType');

        $data = array(
            'Email'   => $email,
            'Password'   => $password,
            'UserType' => $userType
        );

        // print_r($data);die();
        $res = $this->model_users->validate($data);
        if($res['UserFound'])
        {
            $data = array(
                'Email' => $email,
                'UserId' => $res['UserId'],
                'IsLoggedIn' => $res['UserFound'],
                'UserType' => $res['UserType'],
                'FirstName' => $res['FirstName'],
                'LastName' => $res['LastName']
            );
            $this->session->set_userdata($data);

            redirect('main/dashboard', 'refresh');
        }
        else{
            redirect('main', 'refresh');
        }
    }

    function logout()
    {
        $sess_array = array(
            'Email' => '',
            'UserId' => '',
            'IsLoggedIn' => FALSE,
            'UserType' => '',
            'FirstName' => '',
            'LastName' => '');
                     
        $this->session->set_userdata($sess_array);
        $this->session->sess_destroy();
        $data['title'] = 'Login';
        $data['message'] = 'Successfully Logged Out';
        $data['faviconpartpath'] = base_url().'images/favicon.png';
        $data['loggedout'] = TRUE;
        
        redirect('main', 'refresh');
    }

    function generaterandomPassword() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function forgotpassword()
    {
        $this->load->view('view-forgot-password');
    }

    function sendforgotpasswordemail()
    {

    }

    function register()
    {
        $data['faviconpartpath'] = base_url().'img/favicon.png';
		$this->load->view('view_signup', $data);
    }

    function registeruser()
    {
        $this->load->model('model_users');

        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');
        $repeatPassword = $this->input->post('repeatPassword');

        $data = array(
            'FirstName'   => $firstname,
            'LastName'   => $lastname,
            'Email'   => $email,
            'MobileNo'   => $mobile,
            'Password'   => md5($password),
            'UserType' => 'User'
        );

        $res = $this->model_users->registerUser($data);

        if($res)
        {
            redirect('main');
        }
        else{
            redirect('main/register', 'refresh');
        }
    }

	public function getPrisonsForCurrentYearPerMonth()
	{
        $this->load->model('model_prisons');

        $companyName = $this->input->post('CompanyName');
        $year = date('Y');
		$customer = $this->model_prisons->getPrisonsForCurrentYearPerMonth($year);

		echo json_encode($customer);
    }    
}
