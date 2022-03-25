<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		// 6.1
		$data['active_user'] = $this->db->query("SELECT COUNT(*) as total FROM users WHERE active = '1'")->result_array();

		// 6.2
		$data['active_user_attached'] = $this->db->query("SELECT COUNT(*) as total FROM users, product, product_user WHERE users.active = '1' AND users.id = product_user.id_user AND product.id = product_user.id_product")->result_array();

		// 6.3
		$data['active_product'] = $this->db->query("SELECT COUNT(*) as total FROM product WHERE status = '1'")->result_array();

		// 6.4
		$data['active_product_dont_belong'] = $this->db->query("SELECT COUNT(*) as total FROM product, product_user WHERE product.status = '1' AND product.id != product_user.id_product")->result_array();

		// 6.5
		$data['active_attached_products'] = $this->db->query("SELECT SUM(product_user.qty) as total FROM product, product_user, users WHERE product.status = '1' AND product.id = product_user.id_product AND product_user.id_user = users.id")->result_array();

		// 6.6
		$data['price_active_attached_products'] = $this->db->query("SELECT SUM(product_user.price * product_user.qty) as total FROM product, product_user, users WHERE product.status = '1' AND product.id = product_user.id_product AND product_user.id_user = users.id")->result_array();

		// 6.7
		$data['price_active_attached_products_peruser'] = $this->db->query("SELECT SUM(product_user.qty * product_user.price) as total, users.email FROM product, product_user, users WHERE product.status = '1' AND product.id = product_user.id_product AND product_user.id_user = users.id GROUP BY users.id")->result_array();

		// 6.8
		$json = file_get_contents('http://api.exchangeratesapi.io/v1/latest?access_key=3528e8a76aa4cfbd71e4d52c4e4ba43e');

		$data['exchange'] = json_decode($json, 1);

		// print_r($result);

		$this->load->view('welcome_message', $data);
	}
}
