<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prisoners extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
        $this->load->model('model_prisons');

        $data['prisons'] = $this->model_prisons->getallprisons();

        $data['title'] = 'Prisoner Reporting System | Prisoners';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_prisons', $data);

        $this->load->view('includes/footer', $data);
    }

    function viewdetails($id)
    {
        $this->load->model('model_prisons');

        $this->load->model('model_motorvehicles');

        $data['prison'] = $this->model_prisons->getprisondetailsoverid($id);

        $data['images'] = $this->model_prisons->getimagesoveruuid($data['prison'][0]['UUID']);

        $data['motorvehicles'] = $this->model_motorvehicles->getmotorvehiclesoveruuid($data['prison'][0]['UUID']);

        //print_r($data['images']);die();
        $data['title'] = 'Prisoner Reporting System | Prisoners - ' .$id;
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_single_prison', $data);

        $this->load->view('includes/footer', $data);
    }

    function addprison()

    {
        $this->load->model('model_prisons');

        $data['faviconpartpath'] = base_url().'img/favicon.png';
        $data['counties'] = $this->model_prisons->getallcounties();

        $data['title'] = 'Prisoner Reporting System | Report Prisoner';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_prison', $data);

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

        $this->load->model('model_motorvehicles');
        $message = 'Prisoner Report Added Successfully';
        $county = $this->input->post('county');
        $subCounty = $this->input->post('subCounty');
        $location = $this->input->post('location');
        $prisonType = $this->input->post('prisonType');

        $details = $this->input->post('details');
        $reporter = $this->session->userdata('Email');

        $uuid = $this->uuid();

        $data = array(
            'County'   => $county,
            'SubCounty'   => $subCounty,
            'Location'   => $location,
            'PrisonerType'   => $prisonType,

            'ReportedBy'   => $reporter,
            'Details'  => $details,
            'UUID' => $uuid
        );

        $ret = $this->model_prisons->addtodatabase($data);


        $countfiles = count($_FILES['files']['name']);

        for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['files']['name'][$i])){
                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $config = array(
                    'upload_path' => 'uploads/',
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "10048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "2768",
                    'max_width' => "4024",
                    'file_name' => $_FILES['files']['name'][$i]
                );
                
                $this->upload->initialize($config);
                
                $this->load->library('upload',$config); 
        
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    
                    $data['filenames'][] = $filename;

                    $image_data = array(
                        'PrisonerUUID' => $uuid,
                        'Name' => $filename,
                        'Path' => 'uploads/'.$filename
                    );

                    $ret = $this->model_prisons->addimagetodatabase($image_data);


                }
                else{
                    $message =+ $this->upload->display_errors();
                }
            }
    
        }

        $mvs = $this->input->post('motorvehicletypes');
        $cls = $this->input->post('colours');
        $nps = $this->input->post('numberplates');

        $motorvehicles = explode(",", $mvs);
        $colours = explode(",", $cls);
        $numberplates = explode(",", $nps);

        $index = 0;

        // print_r($motorvehicles);
        // die();
        while(true){
            // print_r("colours count : ".count($colours));
            if($index >= count($colours))
            {
                break;
            }

            try{
                // print_r("index : ".$index);
                $motorvehicle = $motorvehicles[$index];
                $colour = $colours[$index];
                $numberplate = $numberplates[$index];

                $data = array(
                    "PrisonerUUID" => $uuid,
                    "MotorVehicleType" => $motorvehicle,
                    "NumberPlate" => $numberplate,
                    "Color" =>$colour
                );
                $ret = $this->model_motorvehicles->addtodatabase($data);
            }
            catch(Exception $e){
                break;
            }
            $index = $index + 1;
        }

        $this->session->set_flashdata('message_no', 1);
        $this->session->set_flashdata('message', $message);
        redirect('prisons/addprison', 'refresh');

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
