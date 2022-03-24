<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_user extends CI_Controller {

	public function index()
	{
		$data['product'] = $this->db->query("SELECT * FROM product")->result_array();

		$this->load->view('product/index', $data);
	}

	public function create()
	{
		$data['products'] = $this->db->query("SELECT * FROM product")->result_array();

		$this->load->library('form_validation');

        $this->form_validation->set_rules('qty', 'Quantity', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('product_user/create', $data);
		}else{
			
			$data = array(
				'id_user' => $this->session->userdata('id_user'),
				'id_product' => $this->input->post('id_product'),
				'qty' => $this->input->post('qty'),
				'price' => $this->input->post('price'),
			);

			$this->db->insert('product_user', $data);
			redirect('welcome');
		}
		
	}

}
