<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prisons extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
        $this->load->model('model_prisons');

        $data['prisons'] = $this->model_prisons->getallprisons();

        $data['title'] = 'Prisoner Reporting System | Prisons';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_prisons', $data);

        $this->load->view('includes/footer', $data);
    }

    function addprison()

    {
        $this->load->model('model_prisons');

        $data['faviconpartpath'] = base_url().'img/favicon.png';
        $data['counties'] = $this->model_prisons->getallcounties();

        $data['title'] = 'Prisoner Reporting System | Add Prison';

        $this->load->view('includes/header', $data);
        $this->load->view('view_add_prison', $data);

        $this->load->view('includes/footer', $data);
    }
    function uuid(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    function addprisontodb()
    {
        $this->load->model('model_prisons');
        $message = 'Prison Added Successfully';
        $county = $this->input->post('county');
        $name = $this->input->post('prisonName');

        $data = array(
            'County'   => $county,
            'Name'   => $name
        );

        $ret = $this->model_prisons->addToDatabase($data);

        if($ret)
        {
            $this->session->set_flashdata('message_no', 0);
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('hasMessage', 1);
        }
        else
        {
            $this->session->set_flashdata('message_no', 1);
            $this->session->set_flashdata('message', "Error adding Prison");
            $this->session->set_flashdata('hasMessage', 1);
        }
        redirect('prisons/addprison', 'refresh');
    }    

    function allprisons()
    {
        $this->load->model('model_users');
        $data['prisons'] = $this->model_prisons->getallprisons();
        $data['title'] = 'Prisons';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_prisons', $data);
        $this->load->view('includes/footer', $data);
    }

    function removeprison($id)
    {
        $this->load->model('model_prisons');

        $ret = $this->model_prisons->deleteprison($id);

        $this->session->set_flashdata('message_no', 0);
        $this->session->set_flashdata('message', "Prison Removed Successfully!");
        $this->session->set_flashdata('hasMessage', 1);
            
        redirect('prisons', 'refresh');        
    }

	public function getPrisonersOverFilter()
	{ 
        $this->load->model('model_prisons');


        $data = array(
            'Month' => $this->input->post('Month'),
            'PrisonerType' => $this->input->post('PrisonerType'),
            'Year' => $this->input->post('Year'),
            'County' => $this->input->post('County'),
            'NumberPlate' => $this->input->post('NumberPlate'),
            'FilterType' => $this->input->post('FilterType')
        );
        
        $file = fopen('output.txt', 'w');
        fwrite($file, 'Month : '.$this->input->post('Month').'\n');
        fwrite($file, 'PrisonerType : '.$this->input->post('PrisonerType').'\n');
        fwrite($file, 'Year : '.$this->input->post('Year').'\n');
        fwrite($file, 'County : '.$this->input->post('County').'\n');
        fwrite($file, 'NumberPlate : '.$this->input->post('NumberPlate').'\n');
        fwrite($file, 'FilterType : '.$this->input->post('FilterType').'\n');
        fclose($file);
		$prisons = $this->model_prisons->getPrisonersOverFilter($data);

		echo json_encode($prisons);

    }    
}
