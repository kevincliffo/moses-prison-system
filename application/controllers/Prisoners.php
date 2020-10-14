<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prisoners extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
        $this->load->model('model_prisoners');

        $data['prisoners'] = $this->model_prisoners->getallprisoners();

        $data['title'] = 'Prisoner Reporting System | Prisoners';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_prisoners', $data);

        $this->load->view('includes/footer', $data);
    }

    function addprisoner()

    {
        $this->load->model('model_prisoners');
        $this->load->model('model_prisons');

        $data['faviconpartpath'] = base_url().'img/favicon.png';
        $data['counties'] = $this->model_prisoners->getallcounties();
        $data['prisons'] = $this->model_prisons->getallprisons();
        $data['crimes'] = $this->model_prisons->getallcrimes();

        $data['title'] = 'Prisoner Reporting System | Report Prisoner';

        $this->load->view('includes/header', $data);
        $this->load->view('view_add_prisoner', $data);

        $this->load->view('includes/footer', $data);
    }
    function uuid(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    function addprisonertodb()
    {
        $this->load->model('model_prisoners');
        
        $message = 'Prisoner Added Successfully';

        $crime = $this->input->post('crime');
        $prison = $this->input->post('prison');
        $crimeCounty = $this->input->post('crimeCounty');
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $idNumber = $this->input->post('idNumber');
        $details = $this->input->post('details');
        $sentenceDate = $this->input->post('sentenceDate');
        $releaseDate = $this->input->post('releaseDate');

        $data = array(
            'Crime'   => $crime,
            'CrimeCounty'   => $crimeCounty,
            'Prison'   => $prison,
            'IDNumber'   => $idNumber,
            'FirstName'   => $firstName,
            'LastName'   => $lastName,
            'Details'   => $details,
            'SentenceDate'  => $sentenceDate,
            'ReleaseDate'  => $releaseDate,
        );

        // print_r($data);die();
        $ret = $this->model_prisoners->addtodatabase($data);

        if($ret)
        {
            $this->session->set_flashdata('message_no', 0);
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('hasMessage', 1);
        }
        else
        {
            $this->session->set_flashdata('message_no', 1);
            $this->session->set_flashdata('message', "Error adding Prisoner");
            $this->session->set_flashdata('hasMessage', 1);
        }
        redirect('prisoners/addprisoner', 'refresh');

    }    

    function allusers()
    {
        $this->load->model('model_users');
        $data['users'] = $this->model_users->getallusers();
        $data['title'] = 'Users';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_users', $data);
        $this->load->view('includes/footer', $data);
    }

    function removeprisoner($id)
    {
        $this->load->model('model_prisoners');

        $ret = $this->model_prisoners->deleteprisoner($id);

        $this->session->set_flashdata('message_no', 0);
        $this->session->set_flashdata('message', "Prisoner Removed Successfully!");
        $this->session->set_flashdata('hasMessage', 1);
            
        redirect('prisoners', 'refresh');        
    }

	public function getPrisonersOverFilter()
	{ 
        $this->load->model('model_prisoners');


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
		$prisons = $this->model_prisoners->getPrisonersOverFilter($data);

		echo json_encode($prisons);

    }    
}
