<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';

/**
 * @Auther: Gamal A.Nasser
 * Class DashboardController
 */
class DashboardController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('user');
	}

	public function index_get()
	{
		return $this->load->view('dashboard');
	}

	public function index_post()
	{
		$dateFrom = $this->input->post('date_from');
		$dateTo   = $this->input->post('date_to');

		// Get the peak hours based on specific period
		$peakTimes = $this->user->getPeakHoursInPeriod($dateFrom, $dateTo);

		return $this->response($peakTimes);
	}
}
