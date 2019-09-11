<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}	
	
	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8')
			{
				$data['suppliersrecord'] = $this->supplier_model->get_suppliers();
				$data['content']		= 'supplier/supplier_list';
				$data['title']			= 'Supplier';
				$data['sub_title']		= 'Supplier';

				$this->load->view('template',$data);
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
	
	function create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id	= $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{
				$data['content']		= 'supplier/supplier_create';
				$data['title']			= 'Supplier';
				$data['sub_title']		= 'Tambah Supplier';
				
				$this->form_validation->set_rules('supplier_full_name','Nama', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('supplier_hp','No. HP', 'trim|required|min_length[11]');
			
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$user_id							= $this->session->userdata('user_id');
					$supplier_full_name					= $_POST['supplier_full_name'];
					$supplier_hp						= $_POST['supplier_hp'];
					$supplier_email						= $_POST['supplier_email'];
					$supplier_telp						= $_POST['supplier_telp'];
					$supplier_address					= $_POST['supplier_address'];
					$supplier_personal_contact_name		= $_POST['supplier_personal_contact_name'];
					
					$supplier_data	=	array(
										'created_time'						=> date('Y-m-d H:i:s'),
										'created_by'						=> $user_id,
										'supplier_full_name'				=> $supplier_full_name,
										'supplier_hp'						=> $supplier_hp,
										'supplier_email'					=> $supplier_email,
										'supplier_telp'						=> $supplier_telp,
										'supplier_address'					=> $supplier_address,
										'supplier_personal_contact_name'	=> $supplier_personal_contact_name
										);
							
					$this->supplier_model->create_supplier($supplier_data);
					
					$this->session->set_flashdata('message_success','Penambahan Supplier berhasil.');
					redirect('supplier');
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
	
	function edit($supplier_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{
				$data['content']		= 'supplier/supplier_edit';
				$data['title']			= 'Supplier';
				$data['sub_title']		= 'Edit Supplier';
				
				$this->form_validation->set_rules('supplier_full_name','Nama', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$data['suppliers'] = $this->supplier_model->get_supplier_by_supplier_id($supplier_id);
					$this->load->view('template',$data);
				}
				else
				{
					$supplier_hp						= $this->input->post('supplier_hp');
					$ds=$this->supplier_model->get_suppliers();
					$stat=0;
					foreach($ds AS $row)
					{
						$sup_hp	= $row->supplier_hp;
						$sup_id	= $row->supplier_id;
						if($sup_hp==$supplier_hp and $sup_id!=$supplier_id){
							$stat=1;
						}
					}
					if($stat==1){
						$this->session->set_flashdata('message_error','No. Hp Sudah terdaftar');
						redirect('supplier/edit/'.$supplier_id);
					}else{
					$supplier_full_name					= $this->input->post('supplier_full_name');
					$supplier_hp						= $this->input->post('supplier_hp');
					$supplier_email						= $this->input->post('supplier_email');
					$supplier_telp						= $this->input->post('supplier_telp');
					$supplier_address					= $this->input->post('supplier_address');
					$supplier_personal_contact_name		= $this->input->post('supplier_personal_contact_name');
					
					$supplier_data	=	array(
										'supplier_full_name'					=> $supplier_full_name,
										'supplier_hp'							=> $supplier_hp,
										'supplier_email'						=> $supplier_email,
										'supplier_telp'							=> $supplier_telp,
										'supplier_address'						=> $supplier_address,
										'supplier_personal_contact_name'		=> $supplier_personal_contact_name
					);
				
					$this->supplier_model->update_supplier($supplier_id,$supplier_data);
					$this->session->set_flashdata('message_success','Data Update');
					redirect('supplier');
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


}

/* End of file supplier.php */
/* Location: ./application/controllers/supplier.php */