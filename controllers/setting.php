<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['content']			= 'setting/general';
				$data['title']				= 'Pengaturan';
				$data['sub_title']			= 'Pengaturan Aplikasi';

				$data['company_title']		= 'Perusahaan';
				$data['receipt_title']		= 'Print Receipt';
				$data['mail_title']			= 'Email';
				$data['finance_title']		= 'Keuangan';
				$data['misc_title']			= 'Misc';

				$data['settings']		= $this->setting_model->get_settings();
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

	function general_update()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->form_validation->set_rules('company_name','Nama Perusahaan', 'trim|required');
				$this->form_validation->set_rules('company_address','Alamat Perusahaan', 'trim|required');
				//$this->form_validation->set_rules('company_telp','Telepon', 'trim|required');
				$this->form_validation->set_rules('company_email','Email', 'trim|required|valid_email');

				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('message_error',validation_errors());
					$this->index();
				}
				else
				{
					$company_name				= $this->input->post('company_name');
					$company_address			= $this->input->post('company_address');
					$company_telp				= $this->input->post('company_telp');
					$company_email				= $this->input->post('company_email');
					$receipt_header				= $this->input->post('receipt_header');
					$receipt_footer				= $this->input->post('receipt_footer');
					$receipt_promo				= $this->input->post('receipt_promo');
					$receipt_max_print			= $this->input->post('receipt_max_print');
					$finance_account_daily		= $this->input->post('finance_account_daily');
					$finance_account_monthly	= $this->input->post('finance_account_monthly');
					$finance_account_sales		= $this->input->post('finance_account_sales');
					$tax_fare					= $this->input->post('tax_fare');
					$service_fare				= $this->input->post('service_fare');
					$discount_manual_max		= $this->input->post('discount_manual_max');
					$overtime_fare_per_hour		= $this->input->post('overtime_fare_per_hour');
					$late_fare_per_minute		= $this->input->post('late_fare_per_minute');
					$receipt_print_format = $this->input->post('receipt_print_format');

					if($_FILES['userfile']['name'] != '')
					{
						$config['upload_path'] = './assets/img/';
						$config['allowed_types'] = 'jpg|png';
						$config['max_size']	= '1000';
						$config['max_width']  = '2000';
						$config['max_height']  = '2000';

						$this->load->library('upload', $config);
						//$this->upload->initialize($config);

						if ( ! $this->upload->do_upload())
						{
							$data['settings']	= $this->setting_model->get_settings();
							$this->load->view('template',$data);						}
						else
						{
							$pic = $this->upload->data();

							$data	= array(
										'company_name'				=> $company_name,
										'company_address'			=> $company_address,
										'company_telp'				=> $company_telp,
										'company_email'				=> $company_email,
										'company_logo'				=> $pic['file_name'],
										'receipt_header'			=> $receipt_header,
										'receipt_footer'			=> $receipt_footer,
										'receipt_promo'				=> $receipt_promo,
										'receipt_print_format' => $receipt_print_format,
										'receipt_max_print'			=> $receipt_max_print,
										'finance_account_daily'		=> $finance_account_daily,
										'finance_account_monthly'	=> $finance_account_monthly,
										'finance_account_sales'		=> $finance_account_sales,
										'tax_fare'					=> $tax_fare,
										'service_fare'				=> $service_fare,
										'discount_manual_max'		=> $discount_manual_max,
										'overtime_fare_per_hour'	=> $overtime_fare_per_hour,
										'late_fare_per_minute'		=> $late_fare_per_minute
									);
							$this->setting_model->edit($data);
						}
					}
					else
					{
						$data	= array(
										'company_name'				=> $company_name,
										'company_address'			=> $company_address,
										'company_telp'				=> $company_telp,
										'company_email'				=> $company_email,
										'receipt_header'			=> $receipt_header,
										'receipt_footer'			=> $receipt_footer,
										'receipt_promo'				=> $receipt_promo,
										'receipt_print_format' => $receipt_print_format,
										'receipt_max_print'			=> $receipt_max_print,
										'finance_account_daily'		=> $finance_account_daily,
										'finance_account_monthly'	=> $finance_account_monthly,
										'finance_account_sales'		=> $finance_account_sales,
										'tax_fare'					=> $tax_fare,
										'service_fare'				=> $service_fare,
										'discount_manual_max'		=> $discount_manual_max,
										'overtime_fare_per_hour'	=> $overtime_fare_per_hour,
										'late_fare_per_minute'		=> $late_fare_per_minute
									);
							$this->setting_model->edit($data);
					}
					$this->setting_model->index();
					$this->session->set_flashdata('message_success','Edit Pengaturan Berhasil!');
					redirect('setting');
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

	function production_devices()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2')
			{
				$data['content']			= 'setting/production_devices';
				$data['title']				= 'Pengaturan';
				$data['sub_title']			= 'Perangkat Produksi';

				$data['productiondevices']	= $this->setting_model->get_production_devices();

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

	function production_devices_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2')
			{
				if($this->session->userdata('division') == 1)
				{
					$data['content']		= 'setting/production_devices_create';
					$data['title']			= 'Perangkat Produksi';
					$data['sub_title']		= 'Tambah Perangkat';

					$this->form_validation->set_rules('production_devices_name','Nama Perangkat', 'trim|required');
					$this->form_validation->set_rules('production_devices_ip_address','IP Address', 'trim|required|min_length[7]');

					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('template',$data);
					}
					else
					{
						$production_devices_type		= $this->input->post('production_devices_type');
						$production_devices_name		= set_value('production_devices_name');
						$production_devices_ip_address	= set_value('production_devices_ip_address');

						$data	=	array(
									'production_devices_created_by'		=> $user_id,
									'production_devices_type'			=> $production_devices_type,
									'production_devices_name'			=> $production_devices_name,
									'production_devices_ip_address'		=> $production_devices_ip_address
									);

						$this->setting_model->create_production_devices($data);

						redirect('setting/production_devices');
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

	function production_devices_edit($production_devices_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2')
			{
				$data['content']		= 'setting/production_devices_edit';
				$data['title']			= 'Perangkat';
				$data['sub_title']		= 'Edit Perangkat';

				$this->form_validation->set_rules('production_devices_name','Nama Perangkat', 'trim|required');
				$this->form_validation->set_rules('production_devices_ip_address','IP Address', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['productiondevices'] = $this->setting_model->get_production_devices_by_production_devices_id($production_devices_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id						= $this->session->userdata('user_id');
					$production_devices_type		= $this->input->post('production_devices_type');

					$data	= array(
								'production_devices_edited_time'	=> date('Y-m-d H:i:s'),
								'production_devices_edited_by'		=> $user_id,
								'production_devices_type'			=> $production_devices_type,
								'production_devices_name'			=> set_value('production_devices_name'),
								'production_devices_ip_address'		=> set_value('production_devices_ip_address')
								);

					$this->setting_model->update_production_devices($production_devices_id,$data);
					redirect('setting/production_devices');
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

    function open_status_table($table_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'OR $group_id == '3'OR $group_id == '4' OR $group_id == '5')
			{
				$this->setting_model->open_table($table_id,'unlock');
                $this->session->set_flashdata('message_success','DATA BERHASIL DIUBAH');

				redirect('setting/table');
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

	function table()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{
				$data['content']			= 'setting/table_list';
				$data['title']				= 'Pengaturan';
				$data['sub_title']			= 'Manajemen Meja';

				$data['tablelist']	= $this->setting_model->get_table_list();

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

	function table_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2')
			{
				if($this->session->userdata('division') == 1)
				{
					$data['content']		= 'setting/table_create';
					$data['title']			= 'Meja';
					$data['sub_title']		= 'Tambah Meja';

					$this->form_validation->set_rules('table_name','Nama Meja', 'trim|required');

					if ($this->form_validation->run() == FALSE)
					{
						$data['table_category']=$this->setting_model->get_general('table_category');
						$this->load->view('template',$data);
					}
					else
					{
						$table_name		= $this->input->post('table_name');
						$table_category_id		= $this->input->post('table_category_id');

						$data	=	array(
									'table_created_by'		=> $user_id,
									'table_name'			=> $table_name,
									'table_category_id' => $table_category_id
									);

						$this->setting_model->create_table($data);

						redirect('setting/table');
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

	function table_edit($table_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2')
			{
				$data['content']		= 'setting/table_edit';
				$data['title']			= 'Perangkat';
				$data['sub_title']		= 'Edit Meja';

				$this->form_validation->set_rules('table_name','Nama Meja', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['tables'] = $this->setting_model->get_table_by_table_id($table_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$table_name		= $this->input->post('table_name');

					$data	= array(
								'table_edited_time'	=> date('Y-m-d H:i:s'),
								'table_edited_by'	=> $user_id,
								'table_name'		=> $table_name
								);

					$this->setting_model->update_table($table_id,$data);
					redirect('setting/table');
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

	function table_category($param1='',$param2='',$param3='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{

				if($param1=='create'&&$param2=='do')
				{
					$data = array(
						'table_category_name' => $this->input->post('table_category_name'),
						'table_cat_status' => '1'
					);
					$this->setting_model->create_general('table_category',$data);
					$this->session->set_flashdata('notif','<div class="alert alert-success">Kategori Meja / Ruangan Berhasil ditambahkan</div>');
					redirect('setting/table_category');
				}
				else if($param1=='edit'&&$param2=='do')
				{
					$data = array(
						'table_category_name' => $this->input->post('table_category_name'),
						'table_cat_status' => $this->input->post('table_cat_status'),
					);
					$this->setting_model->update_general('table_category','table_category_id',$param3,$data);
					$this->session->set_flashdata('notif','<div class="alert alert-success">Kategori Meja / Ruangan Berhasil diedit</div>');
					redirect('setting/table_category');
				}
				else if($param1=='edit'){
					$data['content']			= 'setting/table_category_edit';
					$data['title']				= 'Pengaturan';
					$data['sub_title']			= 'Edit Kategori Meja';
					$data['tablecatlist'] = $this->setting_model->get_by_id_general('table_category','table_category_id',$param2);
					$this->load->view('template',$data);
				}
				else if($param1=='create')
				{
					$data['content']			= 'setting/table_category_create';
					$data['title']				= 'Pengaturan';
					$data['sub_title']			= 'Tambah Kategori Meja';
					$this->load->view('template',$data);
				}
				else{
				$data['content']			= 'setting/table_category_list';
				$data['title']				= 'Pengaturan';
				$data['sub_title']			= 'Kategori Meja';
				$data['tablecatlist']	= $this->setting_model->get_general('table_category');
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

}

/* End of file setting.php */
/* Location: ./application/controllers/setting.php */
