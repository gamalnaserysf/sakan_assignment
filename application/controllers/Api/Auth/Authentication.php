<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

require APPPATH . 'libraries/Format.php';

use Firebase\JWT\JWT;

/**
 * "I prefer to separate logic in which every class do one job (Single Responsibly)"
 *
 * @Auther: Gamal A.Nasser
 * Class LoginController
 */
class Authentication extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('JWT_Token');

		$this->load->model('user');
	}

	/**
	 * Get login page..
	 * @return mixed
	 */
	public function index_get()
	{
		return $this->load->view('auth/login');
	}


	public function index_post()
	{
		//1. Validation
		$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->response([
				'success' => false,
				'message' => validation_errors()
			], REST_Controller::HTTP_OK);
		}

		if ($user = $this->user->resolveUserLogin($this->input->post('email'), $this->input->post('password'))) {
			$_SESSION['user_id'] = (int)$user->id;
			$_SESSION['logged_in'] = (bool)true;

			$response['access_token'] = $this->jwt_token->generateToken([$user->id, $user->email]);
			$response['success'] = true;
			$response['data'] = $user;
			$response['message'] = 'Login success!';

			$this->response($response, REST_Controller::HTTP_OK);
		}

		$this->response([
			'success' => FALSE,
			'message' => 'Invalid Credentials',
		], REST_Controller::HTTP_OK);

	}
}
