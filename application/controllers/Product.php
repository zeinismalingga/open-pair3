<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$data['product'] = $this->db->query("SELECT * FROM product")->result_array();

		$this->load->view('product/index', $data);
	}

	public function create()
	{
		$this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('product/create');
		}else{
			
			$config['upload_path'] = './upload';
          	$config['allowed_types'] = 'jpg|jpeg|png|svg';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('image')) {
				$fileData = $this->upload->data();
				
				$data = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $fileData['file_name']
				);

				$this->db->insert('product', $data);

				die('ok');
			}else{
				$data['error'] = $this->upload->display_errors();

				print_r($data['error']);
			}
			
		}
		
	}

}
