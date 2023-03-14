<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';

/**
 * @Auther: Gamal A.Nasser
 * Class UsersController
 */
class UsersController extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('user');
	}


	public function index_get()
	{
		$peakDate = $this->input->get('peak_date');

		$usersList = $this->user->getUsersInPeakHour($peakDate);

		return $this->load->view('users', ['usersList' => $usersList]);
	}

}
