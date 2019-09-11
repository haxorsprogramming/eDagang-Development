<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->setting_model->index();
			$group_id = $this->session->userdata('group_id');

			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '99')
			{
				redirect('dashboard');
			}
			elseif($group_id == '4')
			{
				redirect('finance');
			}
			elseif($group_id == '5')
			{
				redirect('transaction');
			}
			elseif($group_id == '6')
			{
				redirect('cashier');
			}
			elseif($group_id == '7' or $group_id == '15' or $group_id == '17')
			{
				redirect('order');
			}
			elseif($group_id == '8' or $group_id == '18')
			{
				redirect('purchase/pr_list');
			}
			elseif($group_id == '9')
			{
				redirect('logistic');
			}
			elseif($group_id == '10' OR $group_id == '11')
			{
				redirect('production');
			}
			elseif($group_id == '12' or $group_id == '13')
			{
				redirect('cashier/mbarang');
			}elseif($group_id == '14' or $group_id == '16'){
			     redirect('product');
			}
			else
			{
				$this->login();
				//redirect('account/login');
			}
		}
		else
		{
			$this->login();
			//redirect('account/login');
		}
	}

	function login()
	{
		if ($this->session->userdata('is_logged_in') == FALSE)
		{
			$this->setting_model->index();

			/*$vals = array(
				'img_path'		=> './assets/img/captcha/',
				'img_url'		=> base_url() . 'assets/img/captcha/',
				'word'  		=> random_string('numeric',6),
				//'font_path' 	=> './assets/fonts/consolab.ttf',
				'img_width' 	=> '200',
				'img_height' 	=> '40',
				'expiration' 	=> '90'
				);*/

			//$cap = create_captcha($vals);
			//$data['image'] = $cap['image'];

			//$this->session->set_userdata('acicaptcha', $cap['word']);
			//$this->load->view('login',$data);
			$this->load->view('login');
		}
		else
		{
			$this->index();
			//redirect('account');
		}
	}

	function generateRandomString($length ) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

	function validate_login()
	{
		if ($this->session->userdata('is_logged_in') == FALSE)
		{
			$this->form_validation->set_rules('username','Username', 'trim|required|min_length[1]|max_length[20]');
			$this->form_validation->set_rules('password','Password', 'trim|required|min_length[1]|max_length[20]');

			$captcha = $this->input->post('captcha');

			//if ($this->form_validation->run() == TRUE && $captcha == $this->session->userdata('acicaptcha'))
			if ($this->form_validation->run() == TRUE)
			{
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));

				if ($this->account_model->account_check($username,$password) == TRUE)
				{
					//echo "masuk sni 11";exit();
					$this->setting_model->index();

					$group	= $this->account_model->get_group_by_username($username);
					foreach($group AS $row)
					{
						$group_id	= $row->group_id;
						$group_name	= $row->group_name;
					}

					$user	= $this->account_model->get_user_by_username($username);
					foreach($user AS $row)
					{
						$user_id	= $row->user_id;
						$full_name	= $row->full_name;
						$division	= $row->division;
					}

					$session 		= array('user_id' => $user_id, 'username' => $username, 'group_id' => $group_id, 'group_name' => $group_name, 'full_name' => $full_name, 'division' => $division,'is_logged_in' => TRUE);
					$this->account_model->update_status_login($username);
					$this->account_model->create_log_login($user_id);

					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
					{
						$this->session->set_userdata($session);
						if($group_id == '1' OR $group_id == '2' OR $group_id == '3' ){
							$v_pin=$this->generateRandomString(6);
							$dbpin=$this->account_model->create_pin($v_pin ,$user_id);
							//echo "masuk sni $v_pin".$dbpin;exit();
							$sesdb=array('dbpin' => $dbpin);
							$this->session->set_userdata($sesdb);
						}
						//redirect('dashboard');
					}
					elseif($group_id == '5')
					{
						$this->session->set_userdata($session);
						redirect('transaction');
					}
					elseif($group_id == '6')
					{
						$this->session->set_userdata($session);
						$this->session->unset_userdata('closed_shift');

						$closed_shift = $this->cashier_model->closed_shift_check($user_id);
						foreach($closed_shift as $row)
						if ($row->closed > 0 )
						{
							$this->session->set_userdata('closed_shift','closed');
							redirect('cashier/closed_receipt');
						}
						else
						{
							redirect('cashier/open_shift');
						}
					}
					elseif($group_id == '7' or $group_id == '15' or $group_id == '17')
					{
						$this->session->set_userdata($session);
						redirect('order');
					}
					elseif($group_id == '8' or $group_id == '18')
					{
						$this->session->set_userdata($session);
						redirect('purchase');
					}
					elseif($group_id == '9')
					{
						$this->session->set_userdata($session);
						redirect('logistic');
					}elseif($group_id == '14' or $group_id == '16'){
					   $this->session->set_userdata($session);
						redirect('product');
					}
					elseif($group_id == '10' OR $group_id == '11')
					{
						$this->session->set_userdata($session);
						redirect('production');
					}elseif($group_id == '12' OR $group_id == '13'){
						$this->session->set_userdata($session);
						redirect('cashier/mbarang');
					}
					else
					{
						$this->session->set_flashdata('message_error','Anda tidak berhak mengakses menu ini.');
						redirect('account/login');
					}
				}
				else
				{
					$this->session->set_flashdata('message_error','Username dan atau Password Anda salah');
					redirect('account/login');
				}
			}
			else
			{
				//$this->session->set_flashdata('message','Kode Captcha Salah');
				redirect('account/login');
			}
		}
		else
		{
			redirect('account');
		}
	}

	function logout()
	{
		$username = $this->session->userdata('username');
		$this->account_model->update_status_logout($username);
		$this->session->sess_destroy();
		redirect('account/login');
	}

	function all()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				if($group_id == '1')
				{
					$data['usersrecord'] = $this->account_model->get_users();
				}
				elseif($group_id == '2' OR $group_id == '3')
				{
					$data['usersrecord'] = $this->account_model->get_users_non_admin();
				}

				$data['content']		= 'user/list';
				$data['title']			= 'Pengguna';
				$data['sub_title']		= 'Pengguna';

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
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['dgroup']=$this->account_model->get_user_group();
				$data['content']		= 'user/create';
				$data['title']			= 'Pengguna';
				$data['sub_title']		= 'Tambah Pengguna';

				$this->form_validation->set_rules('full_name','Nama Lengkap', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('username','Username', 'trim|required|min_length[1]');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('');
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
												'username'		=> set_value('username'),
												'password'		=> sha1(set_value('username')),
												'created_time'	=> date('Y-m-d H:i:s'),
												'created_by'	=> $user_id,
												'full_name'		=> set_value('full_name'),
												'hp'			=> set_value('hp'),
												'email'			=> set_value('email'),
												'image'			=> $pic['file_name'],
												'group_id'		=> $group
												);

							$this->account_model->create($data_form);
							$this->session->set_flashdata('message_success','Penambahan Pengguna baru berhasil.');
							redirect('account/all');
						}
					}
					else
					{
						$data_form	=	array(
											'username'		=> set_value('username'),
											'password'		=> sha1(set_value('username')),
											'created_time'	=> date('Y-m-d H:i:s'),
											'created_by'	=> $user_id,
											'full_name'		=> set_value('full_name'),
											'hp'			=> set_value('hp'),
											'email'			=> set_value('email'),
											'group_id'		=> $group
											);

						$this->account_model->create($data_form);
						$this->session->set_flashdata('message_success','Penambahan Pengguna baru berhasil.');
						redirect('account/all');
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
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['dgroup']=$this->account_model->get_user_group();
				$data['content']		= 'user/edit';
				$data['title']			= 'Pengguna';
				$data['sub_title']		= 'Edit Pengguna';

				$this->form_validation->set_rules('full_name','Nama Lengkap', 'trim|required|min_length[3]');

				if ($this->form_validation->run() == FALSE)
				{
					if ($this->uri->segment(3) === FALSE)
					{
						$id_user = $this->input->post('id_user');
					}
					else
					{
						$id_user = $this->uri->segment(3);
					}
					$data['users']		= $this->account_model->get_user_by_user_id($id_user);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('user_id');
					$username	= $this->session->userdata('username');
					$id_user	= $this->input->post('id_user');
					$group		= $this->input->post('group');
					$id_finger = $this->input->post('id_finger');

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
												'edited_time'	=> date('Y-m-d H:i:s'),
												'edited_by'		=> $user_id,
												'full_name'		=> set_value('full_name'),
												'hp'			=> set_value('hp'),
												'email'			=> set_value('email'),
												'image'			=> $pic['file_name'],
												'group_id'		=> $this->input->post('group_id'),
												'id_finger' => $id_finger,
												'username' => $username
												);

							$this->account_model->update($id_user,$data_form);
							$this->session->set_flashdata('message_success','Edit Pengguna berhasil.');
							redirect('account/all');
						}
					}
					else
					{
						$data_form	=	array(
											'edited_time'	=> date('Y-m-d H:i:s'),
											'edited_by'		=> $user_id,
											'full_name'		=> set_value('full_name'),
											'hp'			=> set_value('hp'),
											'email'			=> set_value('email'),
											'group_id'		=> $this->input->post('group_id'),
											'id_finger' => $id_finger,
											'username' => $username
											);

						$this->account_model->update($id_user,$data_form);
						$this->session->set_flashdata('message_success','Edit Pengguna berhasil.');
						redirect('account/all');
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

	function select_pin()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$ok=$this->account_model->select_pin($_POST['txtpin']);
				echo $ok;
				//redirect('account/all');
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

	function delete($id_user)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->account_model->delete($id_user);
				redirect('account/all');
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

	public function change_password()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$data['content']		= 'user/change_password';
			$data['title']			= 'Profil';
			$data['sub_title']		= 'Ganti Password';

			$this->form_validation->set_rules('new_password','Password Baru', 'trim|required|min_length[3]|matches[cnew_password]');
			$this->form_validation->set_rules('cnew_password','Konfirmasi Password Baru', '');

			$user_id	= $this->session->userdata('user_id');

			if ($this->form_validation->run() == FALSE)
			{
				$data['users'] = $this->account_model->get_user_by_user_id($user_id);
				$this->load->view('template',$data);
			}
			else
			{
				$new_password	= sha1($this->input->post('new_password'));

				$this->account_model->change_password($user_id,$new_password);
				$this->session->set_flashdata('message_success','Ganti Password berhasil.');
				redirect('account/change_password');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	public function reset_password($id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id=='1'||$group_id=='2')
            {
                $this->form_validation->set_rules('new_password','Password Baru', 'trim|required|min_length[3]|matches[cnew_password]');
                $this->form_validation->set_rules('cnew_password','Konfirmasi Password Baru', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

                    $data['content']		= 'user/reset_password';
                    $data['title']			= 'Pengguna';
                    $data['sub_title']		= 'Reset Password';
                    
                    $data['id_user'] = $id;
                    $data['users'] = $this->account_model->get_user_by_user_id($id);
                    //$users = $this->account_model->get_user_by_user_id($id);
                    // foreach ($users as $row) {
                    // 		$user_id = $row->user_id;
                    // }
                    $this->load->view('template',$data);
                }
                else
                {
                    $new_password	= sha1($this->input->post('new_password'));

                    $this->account_model->change_password($id,$new_password);
                    $this->session->set_flashdata('message_success','Ganti Password berhasil.');
                    redirect('account/reset_password/'.$id);
				}
			}
            else
            {
				redirect('dashboard');
            }
		}
		else
		{
			redirect('account/login');
		}
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
