<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
        $this->load->model('model_reports');
        $data['reports'] = $this->model_reports->getallreports();
        $data['title'] = 'Report Reporting System | Reports';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_reports', $data);
        $this->load->view('includes/footer', $data);
    }

    function viewdetails($id)
    {
        $this->load->model('model_reports');
        $this->load->model('model_motorvehicles');

        $data['report'] = $this->model_reports->getreportdetailsoverid($id);
        $data['images'] = $this->model_reports->getimagesoveruuid($data['report'][0]['UUID']);
        $data['motorvehicles'] = $this->model_motorvehicles->getmotorvehiclesoveruuid($data['report'][0]['UUID']);
        //print_r($data['images']);die();
        $data['title'] = 'Report Reporting System | Reports - ' .$id;
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_single_report', $data);
        $this->load->view('includes/footer', $data);
    }

    function prisons()
    {
        $this->load->model('model_prisons');
        $data['prisons'] = $this->model_prisons->getallprisons();
        $data['title'] = 'Prison Registration Sytem | Prisons Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_prisons', $data);
        $this->load->view('includes/footer', $data);
    }

    function prisoners()
    {
        $this->load->model('model_prisoners');
        $data['prisoners'] = $this->model_prisoners->getallprisoners();
        $data['title'] = 'Prison Registration Sytem | Prisoners Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_prisoners', $data);
        $this->load->view('includes/footer', $data);
    }

    function prisonersfilters()
    {
        $this->load->model('model_prisoners');
        $data['prisoners'] = $this->model_prisoners->getallprisoners();
        $this->load->model('model_prisons');
        $data['crimes'] = $this->model_prisons->getallcrimes();
        $data['prisons'] = $this->model_prisons->getallprisons();

        $data['title'] = 'Prison Registration Sytem | Prisoners Filter Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_prisoners_filter', $data);
        $this->load->view('includes/footer', $data);
    }

    function users()
    {
        $this->load->model('model_users');
        $data['users'] = $this->model_users->getallusers();
        $data['title'] = 'Prison Registration Sytem | Users Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_users', $data);
        $this->load->view('includes/footer', $data);
    }

    function monthly()
    {
        $this->load->model('model_reports');
        $data['counties'] = $this->model_reports->getallcounties();
        $data['title'] = 'Report Reporting System | Monthly Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_monthly', $data);
        $this->load->view('includes/footer', $data);
    }

    function yearly()
    {
        $this->load->model('model_reports');
        $data['counties'] = $this->model_reports->getallcounties();
        $data['title'] = 'Report Reporting System | Yearly Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_yearly', $data);
        $this->load->view('includes/footer', $data);
    }

    function county()
    {
        $this->load->model('model_reports');
        $data['counties'] = $this->model_reports->getallcounties();
        $data['title'] = 'Report Reporting System | County Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_county', $data);
        $this->load->view('includes/footer', $data);
    }

    function prisontype()

    {
        $this->load->model('model_reports');
        $data['title'] = 'Report Reporting System | Accident Type Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_prison_type', $data);

        $this->load->view('includes/footer', $data);
    }

    function numberplate()
    {
        $this->load->model('model_reports');
        $data['title'] = 'Report Reporting System | Number Plate Report';
        $data['faviconpartpath'] = base_url().'img/favicon.png';

        $this->load->view('includes/header', $data);
        $this->load->view('view_report_number_plate', $data);
        $this->load->view('includes/footer', $data);
    }

    function uuid(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
