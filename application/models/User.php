<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use CodeIgniter\Database\Seeder;


/**
 * Class User
 */
class User extends CI_Model
{

	/**
	 * The name of entity table
	 * @var
	 */
	protected $table = 'users';

	/**
	 * DB Object
	 * @var
	 */
	protected $model;

	public function __construct()
	{
		parent::__construct();

		$this->model = $this->db->from($this->table);
	}

	/**
	 * Get user by id function
	 * @param $id
	 * @return mixed
	 */
	public function findById($id)
	{
		return $this->model->where('id', $id)->limit(1)->get()->row();
	}

	/**
	 * Resolve user login function.
	 *
	 * @access public
	 * @param $email
	 * @param mixed $password
	 * @return mixed user object on success, false on failure
	 */
	public function resolveUserLogin($email, $password)
	{
		$user = $this->model->where('email', $email)->limit(1)->get()->row();

		if (isset($user) && $this->verifyPasswordHash($password, $user->password)) {

			// Update last-login date
			$this->updateLastLogin($user->id);

			return $user;
		}

		return false;
	}

	/**
	 * Verify hashed password function
	 * @param $password
	 * @param $hash
	 * @return bool
	 */
	private function verifyPasswordHash($password, $hash)
	{
		return password_verify($password, $hash);
	}

	/**
	 * Update last login field
	 * @param $id
	 * @return mixed
	 */
	private function updateLastLogin($id)
	{
		return $this->model->where('id', $id)
			->update($this->table, ['last_login' => date("Y-m-d H:i:s")]);
	}

	public function getPeakHoursInPeriod($dateFrom, $dateTo)
	{
		return $this->model
			->select('COUNT(*) AS count, DATE_FORMAT(last_login, "%Y-%m-%d %H:00") AS peak_hours')
			->where('DATE(last_login) >=', date('Y-m-d', strtotime($dateFrom)))
			->where('DATE(last_login) <=', date('Y-m-d', strtotime($dateTo)))
			->group_by('peak_hours')
			->order_by('count', 'DESC')
			->get()
			->result();
	}

	public function getUsersInPeakHour($date)
	{
		return $this->model
			->select('*, DATE_FORMAT(last_login, "%Y-%m-%d %H:00") AS peak_hours')
			->having('peak_hours', $date)
			->get()
			->result();
	}

	public function insertBulk()
	{
		$faker = Faker\Factory::create();

		for ($i=0; $i < 10; $i++) {
			$data[] = [
				'username'     	=> $faker->userName,
				'passwd'     	=> $faker->sha1,
				'role'         	=> $faker->randomElement(['admin', 'staff', 'member']),
				'status'     	=> $faker->randomElement(['active', 'pending', 'banned']),
				'created_at'	=> $faker->dateTimeBetween('-2 month', '-1 days')->format('Y-m-d H:i:s'),
			];

		}

		$this->db->insert_batch($this->table, $data);

		$insert = $this->db->insert_batch($this->table, [
			[
				'id' => 1,
				'name' => 'Gamal Nasser',
				'email' => 'gamal@mail.com',
				'phone' => '9659883452',
				'password' => password_hash('password1', PASSWORD_BCRYPT),
				'created' => date('Y-m-d H:i:s'),
			],
			[
				'id' => 2,
				'name' => 'Amr Saad',
				'email' => 'amr@mail.com',
				'phone' => '9659882552',
				'password' => password_hash('password2', PASSWORD_BCRYPT),
				'created' => date('Y-m-d H:i:s'),
			],
			[
				'id' => 3,
				'name' => 'Hamza Ahmed',
				'email' => 'hamza@mail.com',
				'phone' => '9659442552',
				'password' => password_hash('password3', PASSWORD_BCRYPT),
				'created' => date('Y-m-d H:i:s'),
			],
			[
				'id' => 4,
				'name' => '3esam rady',
				'email' => '3esam@mail.com',
				'phone' => '9659112552',
				'password' => password_hash('password4', PASSWORD_BCRYPT),
				'created' => date('Y-m-d H:i:s'),
			],
			[
				'id' => 5,
				'name' => '3esam rady',
				'email' => '3esam@mail.com',
				'phone' => '9659112552',
				'password' => password_hash('password4', PASSWORD_BCRYPT),
				'created' => date('Y-m-d H:i:s'),
			],
		]);
	}

}
