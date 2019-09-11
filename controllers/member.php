<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
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
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['membersrecord'] = $this->member_model->get_members();	
				
				$data['content']		= 'member/list';
				$data['title']			= 'Member';
				$data['sub_title']		= 'Data Member';
				
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
				$data['content']		= 'member/create';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Tambah Member';
				
				$this->form_validation->set_rules('member_id','ID Member', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('full_name','Nama Lengkap', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('hp','No. HP', 'trim|required|min_length[10]');
				//$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$members	= $this->member_model->get_member_by_username(set_value('hp'));
					foreach($members as $member)
					{
						$ada	= $member->username;
					}
					if ($ada == TRUE)
					{
						$this->session->set_flashdata('message_error','Penambahan Pelanggan baru gagal. No. HP sudah terdaftar.');
						$this->load->view('template',$data);
					}
					else
					{
						$user_id			= $this->session->userdata('user_id');
						$member_group_id	= $this->input->post('group');
						
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
													'username'			=> set_value('hp'),
													'password'			=> sha1(set_value('hp')),
													'created_time'		=> date('Y-m-d H:i:s',now()),
													'created_by'		=> $user_id,
													'full_name'			=> set_value('full_name'),
													'hp'				=> set_value('hp'),
													'email'				=> set_value('email'),
													'saldo'				=> set_value('saldo'),
													'image'				=> $pic['file_name'],
													'group_id'			=> 8,
													'member_id'			=> set_value('member_id'),
													'member_group_id'	=> $member_group_id
													);
							
								$this->member_model->create($data_form);
								$this->session->set_flashdata('message_success','Penambahan Pelanggan baru berhasil.');
								redirect('member/all');
							}
						}
						else
						{
							$data_form	=	array(
												'username'			=> set_value('hp'),
												'password'			=> sha1(set_value('hp')),
												'created_time'		=> date('Y-m-d H:i:s',now()),
												'created_by'		=> $user_id,
												'full_name'			=> set_value('full_name'),
												'hp'				=> set_value('hp'),
												'email'				=> set_value('email'),
												'saldo'				=> set_value('saldo'),
												'group_id'			=> 8,
												'member_id'			=> set_value('member_id'),
												'member_group_id'	=> $member_group_id
												);
						
							$this->member_model->create($data_form);
							$this->session->set_flashdata('message_success','Penambahan Pelanggan baru berhasil.');
							redirect('member/all');
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
	
	function edit()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{
				$data['content']		= 'member/edit';
				$data['title']			= 'Member';
				$data['sub_title']		= 'Edit Member';
				
				$this->form_validation->set_rules('full_name','Nama Lengkap', 'trim|required|min_length[3]');
				//$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
				
				if ($this->form_validation->run() == FALSE)
				{
					if ($this->uri->segment(3) === FALSE)
					{
						$member_id = $this->input->post('member_id');
					}
					else
					{
						$member_id = $this->uri->segment(3);
					}
					$data['members']	= $this->member_model->get_member_by_user_id($member_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('user_id');
					$member_id	= $this->input->post('member_id');
					$full_name	= $this->input->post('full_name');
					$hp			= $this->input->post('hp');
					$email		= $this->input->post('email');
					$saldo		= $this->input->post('saldo');
					$group		= $this->input->post('group');
										
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
												'edited_time'		=> date('Y-m-d H:i:s',now()),
												'edited_by'			=> $user_id,
												'full_name'			=> $full_name,
												'hp'				=> $hp,
												'email'				=> $email,
												'saldo'				=> $saldo,
												'image'				=> $pic['file_name'],
												'member_group_id'	=> $group
												);
						
							$this->member_model->update($member_id,$data_form);
							$this->session->set_flashdata('message_success','Edit Pelanggan berhasil.');
							redirect('member/all');
						}
					}
					else
					{
						$data_form	=	array(
											'edited_time'		=> date('Y-m-d H:i:s',now()),
											'edited_by'			=> $user_id,
											'full_name'			=> $full_name,
											'hp'				=> $hp,
											'email'				=> $email,
											'saldo'				=> $saldo,
											'member_group_id'	=> $group
											);
					
						$this->member_model->update($member_id,$data_form);
						$this->session->set_flashdata('message_success','Edit Pelanggan berhasil.');
						redirect('member/all');
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
	
	function delete($member_id)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1')
			{
				$this->members_model->delete($member_id);
				redirect('member/all');
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
				$data['grouprecord'] = $this->member_model->get_group();	
				
				$data['content']		= 'member/group';
				$data['title']			= 'Member';
				$data['sub_title']		= 'Data Group';
				
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
				$data['content']		= 'member/group_create';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Tambah Group';
				
				$this->form_validation->set_rules('member_group_name','Nama Group', 'trim|required');
				$this->form_validation->set_rules('member_group_discount','Discount', 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$member_group_name		= $this->input->post('member_group_name');
					$member_group_discount	= $this->input->post('member_group_discount');
				
					$data	=	array(
								'member_group_name'		=> $member_group_name,
								'member_group_discount'	=> $member_group_discount
								);
				
					$this->member_model->group_create($data);
					$this->session->set_flashdata('message_success','Penambahan Group baru berhasil.');
					redirect('member/group');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function group_edit($member_group_id)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2'  OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{
				$data['content']		= 'member/group_edit';
				$data['title']			= 'Pelanggan';
				$data['sub_title']		= 'Edit Group';
				
				$this->form_validation->set_rules('member_group_name','Nama Group', 'trim|required|');
				$this->form_validation->set_rules('member_group_discount','Discount', 'trim|required|');
				
				if ($this->form_validation->run() == FALSE)
				{
					$data['group']	= $this->member_model->get_group_by_group_id($member_group_id);
					$this->load->view('template',$data);
				}
				else
				{
					$member_group_name		= $this->input->post('member_group_name');
					$member_group_discount	= $this->input->post('member_group_discount');
					
					$data	=	array(
									'member_group_name'		=> $member_group_name,
									'member_group_discount'	=> $member_group_discount
									);
				
					$this->member_model->group_update($member_group_id,$data);
					$this->session->set_flashdata('message_success','Edit Group berhasil.');
					redirect('member/group');
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

}

/* End of file member.php */
/* Location: ./application/controllers/member.php */