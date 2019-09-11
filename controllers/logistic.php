<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logistic extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}

	function logisticout_approve($product_id,$jen)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '9' OR $group_id == '14' OR $group_id == '16')
			{
					$this->logistic_model->update_sr_logisticout($product_id,$user_id,$jen);
					$this->session->set_flashdata('message_success','Status SR berhasil update.');
					redirect('logistic/reqlogistict_list');
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


	function manager_approve_reject($product_id,$jen)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16')
			{
					$this->logistic_model->update_sr_manager($product_id,$user_id,$jen);
					$this->session->set_flashdata('message_success','Status SR berhasil update.');
					redirect('logistic/reqlogistict_list');
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


		function pr_approve_reject($product_id,$jen)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '9' OR $group_id == '14' OR $group_id == '16')
			{
					$this->logistic_model->update_sr_warehouse($product_id,$user_id,$jen);
					$this->session->set_flashdata('message_success','Status SR berhasil update.');
					redirect('logistic/reqlogistict_list');
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function log_removein($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);
			redirect('logistic/logistic_in');
		}
		else
		{
			redirect('account/login');
		}
	}
	function log_remove($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);
			redirect('logistic/logistic_out');
		}
		else
		{
			redirect('account/login');
		}
	}
	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '9' or $group_id == '10' or $group_id == '11'or $group_id == '18')
			{
				$array_val = array('created_time' => '','logistic_location_id' => '', 'logistic_description' => '');
				$this->session->set_userdata($array_val);
				$this->cart->destroy();
				$data['logisticsrecord'] = $this->logistic_model->get_logistic_today();
                $data['dm'] = $this->logistic_model->select_material();
				$data['content']		= 'logistic/summary';
				$data['title']			= 'Inventori';
				$data['sub_title']		= 'Inventori';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

    function logistic_in()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '5' or $group_id == '11' or $group_id == '10' OR $group_id == '14' OR $group_id == '16' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '9' or $group_id == '18')
			{
				$data['logisticsrecord'] = $this->logistic_model->get_logistic_today();
				$data['content']		= 'logistic/logistic_in';
				$data['title']			= 'Inventori';
				$data['sub_title']		= 'Penerimaan Barang';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function logistic_out()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '14' OR $group_id == '16' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '9' or $group_id == '18')
			{
				$data['logisticsrecord'] = $this->logistic_model->get_logistic_today();
				$data['content']		= 'logistic/logistic_out';
				$data['title']			= 'Inventori';
				$data['sub_title']		= 'Pengeluaran Barang';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


		function log_view($pr_number)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			if(isset($pr_number))
			{
				$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$user_id			= $this->session->userdata('user_id');

				$group_id = $this->session->userdata('group_id');
				if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8' OR $group_id == '14' OR $group_id == '16' OR $group_id == '9'OR $group_id == '10'OR $group_id == '11'or $group_id == '18')
				{
					$data['prrecord'] = $this->logistic_model->get_pr_by_pr_number($pr_number);

					$data['content']		= 'logistic/log_view';
					$data['title']			= 'Logistic';
					$data['sub_title']		= 'Detail SR';

					$this->load->view('template',$data);
				}
				else
				{
					redirect('account');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function pr_list_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8' OR $group_id == '14' OR $group_id == '16' OR $group_id == '9'or $group_id == '18')
			{
				$start_date=date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date=date('Y-m-d',strtotime($this->input->post('end_date')));
				//$data['prrecord'] = $this->purchase_model->get_pr_list($start_date,$end_date);
				$data['prrecord'] = $this->logistic_model->get_srdate($start_date,$end_date);
				$data['content']		= 'logistic/logistic_req_list';
				$data['title']			= 'Logistic';
				$data['sub_title']		= 'Permintaan';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function reqlogistict_list()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8' OR $group_id == '9' OR $group_id == '10' OR $group_id == '11'or $group_id == '18' OR $group_id == '14' OR $group_id == '16')
			{
				$data['prrecord'] = $this->logistic_model->get_sr();
				$data['content']		= 'logistic/logistic_req_list';
				$data['title']			= 'Logistic';
				$data['sub_title']		= 'Permintaan';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


		function log_material_add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '3' OR $group_id == '9' OR $group_id == '10' OR $group_id == '11'or $group_id == '18')
			{
				$this->form_validation->set_rules('pr_material_qty','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('logistic/logistic_req_cart');
				}
				else
				{
					//echo "masuk sni"; exit();
					$material_id		= $this->input->post('pr_material_id');
					$qty				= $this->input->post('pr_material_qty');
					$pr_supplier		= $this->input->post('pr_supplier');

					$materialsrecords	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materialsrecords AS $materials)
					{
						$material_name				= $materials->material_name;
						$material_purchase_price	= $materials->material_purchase_price;
					}

					$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> $material_purchase_price,
							   'name'    	=> $material_name,
							   'options' 	=> array('pr_supplier' => $pr_supplier)
							);

					$this->cart->insert($data_form);
					redirect('logistic/logistic_req_cart');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


		function log_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '9' OR $group_id == '14' OR $group_id == '16' OR $group_id == '10' OR $group_id == '11'or $group_id == '18')
			{
				if($this->session->userdata('pr_date_required') == TRUE)
				{
					redirect('logistic/logistic_req_cart');
				}
				else
				{
					$data['content']		= 'logistic/log_create';
					$data['title']			= 'Logistic';
					$data['sub_title']		= 'Buat SR';

					$this->load->view('template',$data);
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

		function logistic_cancel()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->cart->destroy();
			$this->session->unset_userdata('pr_date_required');
			$this->session->unset_userdata('pr_note');
			redirect('logistic/reqlogistict_list');
		}
		else
		{
			redirect('account/login');
		}
	}

			function logistic_save()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '9' OR $group_id == '10' OR $group_id == '11'or $group_id == '18')
			{
				$this->form_validation->set_rules('pr_date_required','Tanggal Dibutuhkan', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('logistic/logistic_req_cart');
				}
				else
				{
					if($this->logistic_model->create_log() == TRUE)
					{
						$this->cart->destroy();
						$this->session->unset_userdata('pr_date_required');
						$this->session->unset_userdata('pr_note');
						$this->session->set_flashdata('message_success','Pembuatan SR berhasil.');
						redirect('logistic/reqlogistict_list');
					}
					else
					{
						redirect('logistic/logistic_req_cart');
					}
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

		function log_material_remove_from_cart($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);
			redirect('logistic/logistic_req_cart');
		}
		else
		{
			redirect('account/login');
		}
	}
		function logistic_req_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '3' OR $group_id == '9'OR $group_id == '10' OR $group_id == '11'or $group_id == '18')
			{
				$data['content']		= 'logistic/logistic_req_cart';
				$data['title']			= 'Logistic';
				$data['sub_title']		= 'Tambah SR';

				if($this->session->userdata('pr_date_required') == TRUE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$this->form_validation->set_rules('pr_date_required','Tanggal Dibutuhkan', 'trim|required');
					if($this->form_validation->run() == FALSE)
					{
						redirect('logistic/log_create');
					}
					else
					{
						echo "masuk ni";
						$session_data	= array(
											'pr_date_required'			=> date('Y-m-d',strtotime($this->input->post('pr_date_required'))),
											'pr_note'					=> $this->input->post('po_note') //edit by heru
											);
						$this->session->set_userdata($session_data);
						redirect('logistic/logistic_req_cart');
					}
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

    	function logistic_simpanin()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '5' OR $group_id == '14' OR $group_id == '16' or $group_id == '8' or $group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '9'or $group_id == '18')
			{
				$created_time=$this->session->userdata('created_time');
				$created_id=$this->session->userdata('user_id');
				$logistic_location_id=$this->session->userdata('logistic_location_id');
				$logistic_description=$this->session->userdata('logistic_description');

				$this->db->trans_start();

				foreach($this->cart->contents() as $item)
				{
					 			$data_form = array(
														'created_time'				=> date('Y-m-d H:i:s'),
														'created_by'			=> $created_id,
														'material_id'			=> $item['id'],
														'logistic_stock'			=> $item['qty'],
														'logistic_description'			=> $logistic_description,
														'status'			=> 'in',
														'logistic_location_id'			=> $logistic_location_id,
														'tgl_terima'				=> date('Y-m-d',strtotime($created_time)),
														);

									$this->logistic_model->logistic_create($data_form);
                                    $this->material_model->update_materialid($item['id'],$item['qty'],$created_id);
				}
				$this->db->trans_complete();
				//$data['logisticsrecord'] = $this->logistic_model->get_logistic_today();
//				$data['content']		= 'logistic/logistic_out';
//				$data['title']			= 'Logistik';
//				$data['sub_title']		= 'Pengeluaran Logistik';
//
//				$this->load->view('template',$data);
				$array_val = array('created_time' => '','logistic_location_id' => '', 'logistic_description' => '');
				$this->session->set_userdata($array_val);
				$this->session->set_flashdata('message_success','Data Update');
				redirect('logistic');
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function logistic_simpan()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '10' OR $group_id == '14' OR $group_id == '16' OR $group_id == '11' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '9'or $group_id == '18')
			{
				$created_time=$this->session->userdata('created_time');
				$created_id=$this->session->userdata('user_id');
				$logistic_location_id=$this->session->userdata('logistic_location_id');
				$logistic_description=$this->session->userdata('logistic_description');

				$this->db->trans_start();

				foreach($this->cart->contents() as $item)
				{
					 			$data_form = array(
														'created_time'				=> date('Y-m-d H:i:s'),
														'created_by'			=> $created_id,
														'material_id'			=> $item['id'],
														'logistic_stock'			=> $item['qty'],
														'logistic_description'			=> $logistic_description,
														'status'			=> 'out',
														'logistic_location_id'			=> $logistic_location_id

														);

									$this->logistic_model->logistic_create($data_form);
				}
				$this->db->trans_complete();
				//$data['logisticsrecord'] = $this->logistic_model->get_logistic_today();
//				$data['content']		= 'logistic/logistic_out';
//				$data['title']			= 'Logistik';
//				$data['sub_title']		= 'Pengeluaran Logistik';
//
//				$this->load->view('template',$data);
				$array_val = array('created_time' => '','logistic_location_id' => '', 'logistic_description' => '');
				$this->session->set_userdata($array_val);
				$this->session->set_flashdata('message_success','Data Update');
				redirect('logistic');
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

		function addcart_logistic()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '11' OR $group_id == '14' OR $group_id == '16' or $group_id == '10' or $group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' or $group_id == '9'or $group_id == '18')
			{
				$this->form_validation->set_rules('po_material_qty','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('logistic/logistic_out');
				}
				else
				{
					$created_time=date('Y-m-d',strtotime($this->input->post('created_time')));
					$logistic_location_id=$this->input->post('logistic_location_id');
					$logistic_description=$this->input->post('logistic_description');
					$session_data	= array(
											'created_time'			=> $created_time,
											'logistic_location_id'					=> $logistic_location_id,
											'logistic_description'					=> $logistic_description
											);
						$this->session->set_userdata($session_data);

					$material_id		= $this->input->post('po_material_id');
					$qty				= $this->input->post('po_material_qty');
					$price				= 0;

					$materialsrecords	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materialsrecords AS $materials)
					{
						$material_name	= $materials->material_name;
					}

					$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> $price,
							   'name'    	=> $material_name,
							   'options' 	=> ''
							);

					$this->cart->insert($data_form);
					redirect('logistic/logistic_out');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

    function addcart_logisticin()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '5' OR $group_id == '14' OR $group_id == '16' or $group_id == '8' or $group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' or $group_id == '9'or $group_id == '18')
			{
				$this->form_validation->set_rules('po_material_qty','QTY', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					redirect('logistic/logistic_in');
				}
				else
				{
					$created_time=date('d-m-Y',strtotime($this->input->post('created_time')));
					$logistic_location_id=$this->input->post('logistic_location_id');
					$logistic_description=$this->input->post('logistic_description');
					$session_data	= array(
											'created_time'			=> $created_time,
											'logistic_location_id'					=> $logistic_location_id,
											'logistic_description'					=> $logistic_description
											);
						$this->session->set_userdata($session_data);

					$material_id		= $this->input->post('po_material_id');
					$qty				= $this->input->post('po_material_qty');
					$price				= 0;

					$materialsrecords	= $this->material_model->get_material_by_material_idresep($material_id);
                   // echo $material_id;
                   // print_r($materialsrecords);
                    //exit();
					foreach($materialsrecords AS $materials)
					{
						$material_name	= $materials->material_name;
					}

					$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> $price,
							   'name'    	=> $material_name,
							   'options' 	=> ''
							);

					$this->cart->insert($data_form);
					redirect('logistic/logistic_in');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '10' OR $group_id == '11'or $group_id == '18')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));
                $material_id=$this->input->post('material_id');
				$v_status=$this->input->post('v_status');

				$data['logisticsrecord'] = $this->logistic_model->get_logisticnew($start_date,$end_date,$material_id,$v_status);
				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));
				$data['material_id']			= $material_id;
                $data['v_status']			= $v_status;
                $data['dm'] = $this->logistic_model->select_material();
				$data['content']		= 'logistic/logistic_search';
				$data['title']			= 'Inventori';
				$data['sub_title']		= 'Data Inventori';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function logistic_export_to_excel($start_date,$end_date)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '3' OR $group_id == '7')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$logisticsrecord = $this->logistic_model->get_logistic($start_date,$end_date);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Logistic")
											 ->setSubject("Logistic")
											 ->setDescription("Logistic")
											 ->setKeywords("Logistic")
											 ->setCategory("Logistic");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'Tanggal')
							->setCellValue('C1', 'Oleh')
							->setCellValue('D1', 'Material')
							->setCellValue('E1', 'Keterangan')
							->setCellValue('F1', 'Stok')
							->setCellValue('G1', 'Satuan')
							->setCellValue('H1', 'Status');

				// Add data
				$no=1;
				$i=1;
				foreach($logisticsrecord as $row)
				{
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, date("d-m-Y H:i:s",strtotime($row->created_time)))
							->setCellValue('C'.$i, $row->full_name)
							->setCellValue('D'.$i, $row->item_name)
							->setCellValue('E'.$i, $row->description)
							->setCellValue('F'.$i, $row->stock)
							->setCellValue('G'.$i, $row->unit_name)
							->setCellValue('H'.$i, $row->status);
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Logistic');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="logistic.xlsx"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save('php://output');
				exit;
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if( $group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '7')
			{
				$data['content']		= 'logistic/create';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Tambah Logistik';

				$this->form_validation->set_rules('stock','Stok', 'trim|required|numeric|min_length[1]');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$item_id	= $this->input->post('item_id');
					$unit_id	= $this->input->post('unit_id');

					$data_form	=	array(
									'created_time'				=> date('Y-m-d H:i:s'),
									'created_by'				=> $user_id,
									'logistic_item_id'			=> $item_id,
									'status'					=> 'in',
									'logistic_description'		=> set_value('description'),
									'logistic_item_stock'		=> set_value('stock')
									);

					$this->logistic_model->logistic_create($data_form);

					$this->session->set_flashdata('message_success','Penambahan Logistik berhasil.');
					redirect('logistic');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


    	function edit_logistic()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if( $group_id == '1' OR $group_id == '2' )
			{
			     $v_jene=$_POST['v_jene'];
                 $v_nilai=$_POST['v_nilai'];
                 $v_id=$_POST['v_id'];
                 $v_userid=$user_id;
				$ok=$this->logistic_model->edit_logistic( $v_jene,$v_nilai ,$v_id,$v_userid );
                echo $ok;
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


	function expenditure()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '7')
			{
				$data['content']		= 'logistic/expenditure';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Pengeluaran Logistik';

				$this->form_validation->set_rules('description','Keterangan', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('stock','Stok', 'trim|required|numeric|min_length[1]');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$item_id	= $this->input->post('item_id');
					$unit_id	= $this->input->post('unit_id');

					$data_form	=	array(
									'created_time'	=> date('Y-m-d H:i:s'),
									'created_by'	=> $user_id,
									'item_id'		=> $item_id,
									'status'		=> $this->input->post('status'),
									'description'	=> set_value('description'),
									'stock'			=> set_value('stock'),
									'unit_id'		=> $unit_id
									);

					$this->logistic_model->logistic_create($data_form);

					$this->session->set_flashdata('message_success','Penambahan Logistik berhasil.');
					redirect('logistic');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function edit($product_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if( $group_id == '1' OR $group_id == '14' OR $group_id == '16' OR $group_id == '2' OR $group_id == '7')
			{
				$data['content']		= 'logistik/edit';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Edit Logistik';

				$this->form_validation->set_rules('name','Nama Produk', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('description','Deskripsi', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('price','Harga', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('discount','Discount', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('stock','Stok', 'trim|required|min_length[1]');

				if ($this->form_validation->run() == FALSE)
				{
					$data['products'] = $this->products_model->find($product_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('user_id');
					if($_FILES['userfile']['name'] != '')
					{
						$config['upload_path'] = './assets/img/products/';
						$config['allowed_types'] = 'jpg|png';
						$config['max_size']	= '2000';
						$config['max_width']  = '2000';
						$config['max_height']  = '2000';

						$this->load->library('upload', $config);
						//$this->upload->initialize($config);

						if ( ! $this->upload->do_upload())
						{
						$data['products'] = $this->products_model->find($product_id);
						$this->load->view('template',$data);
						}
						else
						{
							$pic = $this->upload->data();
							$data_form	=	array(
											'edited_time'	=> date('Y-m-d H:i:s'),
											'edited_by'		=> $user_id,
											'name'			=> set_value('name'),
											'description'	=> set_value('description'),
											'price'			=> set_value('price'),
											'discount'		=> set_value('discount'),
											'stock'			=> set_value('stock'),
											'image'			=> $pic['file_name']
											);

							$this->products_model->update($product_id,$data_form);
							redirect('products');
						}
					}
					else
					{
						$data_form	=	array(
										'edited_time'	=> date('Y-m-d H:i:s'),
										'edited_by'		=> $user_id,
										'name'			=> set_value('name'),
										'description'	=> set_value('description'),
										'price'			=> set_value('price'),
										'discount'		=> set_value('discount'),
										'stock'			=> set_value('stock')
										);

						$this->products_model->update($product_id,$data_form);
						redirect('products');
					}
				}
			}
			else
			{
				redirect('users');
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function delete($product_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if($group_id == '11' OR $group_id == '14' OR $group_id == '16' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '7'or $group_id == '18')
			{
				$this->products_model->delete($product_id);
				redirect('products');
			}
			else
			{
				redirect('users');
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function units()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if( $group_id == '1' OR $group_id == '2' OR $group_id == '7' OR $group_id == '14' OR $group_id == '16')
			{
				$data['unitsrecord']	= $this->logistic_model->get_units();

				$data['content']		= 'logistic/unit';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Data Satuan';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('users');
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function unit_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id	= $this->session->userdata('group_id');

			if($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '7'or $group_id == '18')
			{
				$data['content']		= 'logistic/unit_create';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Tambah Satuan';

				$this->form_validation->set_rules('name','Nama Unit', 'trim|required|min_length[1]');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('user_id');
					$name		= $this->input->post('name');

					$data_form	=	array(
										'created_time'				=> date('Y-m-d H:i:s'),
										'created_by'				=> $user_id,
										'logistic_unit_name_big'	=> set_value('name')
										);

					$this->logistic_model->unit_create($data_form);

					$this->session->set_flashdata('message_success','Penambahan Unit berhasil.');
					redirect('logistic/units');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function items()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '7' OR $group_id == '14' OR $group_id == '16')
			{
				$data['itemsrecord']	= $this->logistic_model->get_items();

				$data['content']		= 'logistic/item';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Data Item';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function item_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id	= $this->session->userdata('group_id');

			if($group_id == '1' OR $group_id == '2' OR $group_id == '7' OR $group_id == '14' OR $group_id == '16')
			{
				$data['content']		= 'logistic/item_create';
				$data['title']			= 'Logistik';
				$data['sub_title']		= 'Tambah Item';

				$this->form_validation->set_rules('name','Nama Item', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('item_price','Harga Pembelian (Satuan)', 'trim|required');
				$this->form_validation->set_rules('purchase_unit','Jumlah Pembelian (Satuan)', 'trim|required');
				$this->form_validation->set_rules('bottom_line_stock','Batas Bawah Stock', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('user_id');
					$unit_id	= $this->input->post('unit_id');

					$data_form	=	array(
										'created_time'						=> date('Y-m-d H:i:s'),
										'created_by'						=> $user_id,
										'logistic_item_name'				=> set_value('name'),
										'logistic_unit_id'					=> $unit_id,
										'logistic_item_price'				=> set_value('item_price'),
										'logistic_item_purchase_unit'		=> set_value('purchase_unit'),
										'logistic_item_standard_stock'		=> set_value('standard_stock'),
										'logistic_item_bottom_line_stock'	=> set_value('bottom_line_stock')
										);

					$this->logistic_model->item_create($data_form);

					$this->session->set_flashdata('message_success','Penambahan Item berhasil.');
					redirect('logistic/items');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function item_edit($item_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2')
			{
				$data['content']		= 'logistic/item_edit';
				$data['title']			= 'Logistic';
				$data['sub_title']		= 'Edit Item';

				$this->form_validation->set_rules('item_name','Nama Item', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['items'] = $this->logistic_model->get_item_by_item_id($item_id);
					$this->load->view('template',$data);
				}
				else
				{
					$unit_id	= $this->input->post('unit_id');
					$data_form	=	array(
									'logistic_item_name'	=> ucwords(set_value('item_name')),
									'logistic_unit_id'		=> $unit_id
									);

					$this->logistic_model->update_item($item_id,$data_form);
					redirect('logistic/items');
				}
			}
			else
			{
				redirect('account');
			}
		}
		else
		{
			redirect('account/login');
		}
	}


}

/* End of file logistic.php */
/* Location: ./application/controllers/logistic.php */
