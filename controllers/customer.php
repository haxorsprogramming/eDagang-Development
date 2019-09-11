<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}

	function index()
	{
		redirect('account');
	}

	function all()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '12'OR $group_id == '13')
			{
				$data['customersrecord'] = $this->customer_model->get_customers();

				$data['content']		= 'customer/list';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Pelanggan';

				$this->load->view('template',$data);
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

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['content']		= 'customer/create';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Tambah Pelanggan';

				//$this->form_validation->set_rules('customer_id','ID Customer', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('customer_full_name','Nama Lengkap', 'trim|required|min_length[3]');
				//$this->form_validation->set_rules('hp','No. HP', 'trim|required|min_length[10]');
				//$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');

				//echo $this->input->post('customer_saldo');;
				//exit();
				$chp=$this->input->post('customer_hp');
				$cfm=$this->input->post('customer_full_name');
				$cemail=$this->input->post('customer_email');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$customers	= $this->customer_model->get_customer_by_username(set_value('hp'));
					foreach($customers as $customer)
					{
						$ada	= $customer->username;
					}
					if ($ada == TRUE)
					{
						$this->session->set_flashdata('message_error','Penambahan Pelanggan baru gagal. No. HP sudah terdaftar.');
						$this->load->view('template',$data);
					}
					else
					{
						$user_id			= $this->session->userdata('user_id');
						$customer_group_id	= $this->input->post('group');
						$customer_saldo		= $this->input->post('customer_saldo');

						if($_FILES['userfile']['name'] != '')
						{
							$config['upload_path'] = './assets/img/user/';
							$config['allowed_types'] = 'jpg|png';
							$config['max_size']	= '2000';
							$config['max_width']  = '2000';
							$config['max_height']  = '2000';

							$this->load->library('upload', $config);
							//$this->upload->initialize($config);

							if ( ! $this->upload->do_upload())
							{
								$this->load->view('template',$data);
							}
							else
							{
								$pic = $this->upload->data();

								$data_form	=	array(
													'username'				=> $chp,
													'password'				=> sha1($chp),
													'created_time'			=> date('Y-m-d H:i:s'),
													'created_by'			=> $user_id,
													'customer_full_name'	=> $cfm,
													'customer_hp'			=> $chp,
													'customer_email'		=> $cemail,
													'customer_saldo'		=> $customer_saldo,
													'customer_image'		=> $pic['file_name'],
													'customer_group_id'		=> $this->input->post('customer_group')
													);

								$this->customer_model->create($data_form);
								$this->session->set_flashdata('message_success','Penambahan Pelanggan baru berhasil.');
								redirect('customer/all');
							}
						}
						else
						{
							$data_form	=	array(
												'username'				=> $chp,
												'password'				=> sha1($chp),
												'created_time'			=> date('Y-m-d H:i:s'),
												'created_by'			=> $user_id,
												'customer_full_name'	=> $cfm,
												'customer_hp'			=> $chp,
												'customer_email'		=> $cemail,
												'customer_saldo'		=> $customer_saldo,
												'customer_group_id'		=> $this->input->post('customer_group')
												);

							$this->customer_model->create($data_form);
							$this->session->set_flashdata('message_success','Penambahan Pelanggan baru berhasil.');
							redirect('customer/all');
						}
					}
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function edit($customer_id)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == 6)
			{
				$data['content']		= 'customer/edit';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Edit Pelanggan';

				$this->form_validation->set_rules('customer_full_name','Nama Lengkap', 'trim|required|min_length[3]');
				//$this->form_validation->set_rules('customer_hp','No. HP', 'trim|required|min_length[12]');

				if ($this->form_validation->run() == FALSE)
				{
				/*	if ($this->uri->segment(3) === FALSE)
					{
						$customer_id = $this->input->post('customer_id');
					}
					else
					{
						$customer_id = $this->uri->segment(3);
					} */
					$data['customers']	= $this->customer_model->get_customer_by_customer_id($customer_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id			= $this->session->userdata('user_id');
					$customer_id		= $this->input->post('customer_id');
					$customer_full_name	= $this->input->post('customer_full_name');
					$customer_hp		= $this->input->post('customer_hp');
					$customer_email		= $this->input->post('customer_email');
					$customer_group		= $this->input->post('customer_group');

					if($_FILES['userfile']['name'] != '')
					{
						$config['upload_path'] = './assets/img/user/';
						$config['allowed_types'] = 'jpg|png';
						$config['max_size']	= '2000';
						$config['max_width']  = '2000';
						$config['max_height']  = '2000';

						$this->load->library('upload', $config);
						//$this->upload->initialize($config);

						if ( ! $this->upload->do_upload())
						{
							$this->load->view('template',$data);
						}
						else
						{
							$pic = $this->upload->data();

							$data_form	=	array(
												'edited_time'			=> date('Y-m-d H:i:s'),
												'edited_by'				=> $user_id,
												'customer_full_name'	=> $customer_full_name,
												'customer_hp'			=> $customer_hp,
												'customer_email'		=> $customer_email,
												'customer_image'		=> $pic['file_name'],
												'customer_group_id'		=> $customer_group
												);

							$this->customer_model->update($customer_id,$data_form);
							$this->session->set_flashdata('message_success','Edit Pelanggan berhasil.');
							redirect('customer/all');
						}
					}
					else
					{
						$data_form	=	array(
											'edited_time'			=> date('Y-m-d H:i:s'),
											'edited_by'				=> $user_id,
											'customer_full_name'	=> $customer_full_name,
											'customer_hp'			=> $customer_hp,
											'customer_email'		=> $customer_email,
											'customer_group_id'		=> $customer_group
											);

						$this->customer_model->update($customer_id,$data_form);
						$this->session->set_flashdata('message_success','Edit Pelanggan berhasil.');
						redirect('customer/all');
					}
				}
			}
			else
			{
				redirect('account/login');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function delete($customer_id)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1')
			{
				$this->customer_model->delete($customer_id);
				redirect('customer/all');
			}
			else
			{
				redirect('account/login');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function group()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['grouprecord'] = $this->customer_model->get_group();

				$data['content']		= 'customer/group';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Group Pelanggan';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function group_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{
				$data['content']		= 'customer/group_create';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Tambah Group';

				$this->form_validation->set_rules('customer_group_name','Nama Group', 'trim|required');
				//$this->form_validation->set_rules('customer_group_selling_price','Harga Jual', 'required');
				//$this->form_validation->set_rules('customer_group_discount','Discount', 'required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$customer_group_name			= $this->input->post('customer_group_name');
					$customer_group_selling_price	= $this->input->post('customer_group_selling_price');
					$customer_group_discount		= $this->input->post('customer_group_discount');

					$data	=	array(
								'customer_group_name'			=> $customer_group_name,
								'customer_group_selling_price'	=> $customer_group_selling_price,
								'customer_group_discount'		=> $customer_group_discount
								);

					$this->customer_model->group_create($data);
					$this->session->set_flashdata('message_success','Penambahan Group baru berhasil.');
					redirect('customer/group');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function group_edit($customer_group_id)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{
				$data['content']		= 'customer/group_edit';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Edit Group';

				$this->form_validation->set_rules('customer_group_name','Nama Group', 'trim|required|');
				//$this->form_validation->set_rules('customer_group_discount','Discount', 'trim|required|');

				if ($this->form_validation->run() == FALSE)
				{
					$data['group']	= $this->customer_model->get_group_by_group_id($customer_group_id);
					$this->load->view('template',$data);
				}
				else
				{
					$customer_group_name			= $this->input->post('customer_group_name');
					$customer_group_discount		= $this->input->post('customer_group_discount');
					$customer_group_selling_price	= $this->input->post('customer_group_selling_price');

					$data	=	array(
									'customer_group_name'			=> $customer_group_name,
									'customer_group_discount'		=> $customer_group_discount,
									'customer_group_selling_price'	=> $customer_group_selling_price
									);

					$this->customer_model->group_update($customer_group_id,$data);
					$this->session->set_flashdata('message_success','Edit Group berhasil.');
					redirect('customer/group');
				}
			}
			else
			{
				redirect('account/login');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function reset_balance($customer_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3')
			{
				$data['content']		= 'customer/reset_balance';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Reset Saldo';

				//$this->form_validation->set_rules('customer_id','ID Customer', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('customer_saldo_new','Tambah Saldo', 'trim|required');
				//$this->form_validation->set_rules('hp','No. HP', 'trim|required|min_length[10]');
				//$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');

				//echo $this->input->post('customer_saldo');;
				//exit();

				if ($this->form_validation->run() == FALSE)
				{
					$data['customerrecord'] = $this->customer_model->get_customer_by_customer_id($customer_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id				= $this->session->userdata('user_id');
					$customer_saldo_new		= $this->input->post('customer_saldo_new');

					$this->customer_model->saldo_update($customer_id,$customer_saldo_new);
					$this->session->set_flashdata('message_success','Penambahan Saldo berhasil.');
					redirect('customer/all');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

}

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */
