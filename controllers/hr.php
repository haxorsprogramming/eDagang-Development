<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->employee();
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

	public function employee()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['employeerecord'] = $this->hr_model->get_all_employee();
				$data['departmentrecord']	= $this->hr_model->get_department();
				$data['positionrecord']		= $this->hr_model->get_position();
				$data['group'] = $this->hr_model->get_general('user_group');

				$data['content']		= 'hr/employee';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Data Karyawan';

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

	public function employee_edit($employee_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->form_validation->set_rules('employee_code','Kode Karyawan', 'trim|required');
				$this->form_validation->set_rules('employee_name','Nama Karyawan', 'trim|required');
				$this->form_validation->set_rules('employee_address','Alamat', 'trim|required');
				$this->form_validation->set_rules('employee_join_date','Tgl Gabung', 'trim|required');
				$this->form_validation->set_rules('employee_department','Departemen', 'trim|required');
				$this->form_validation->set_rules('employee_position','Posisi', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					$data['employeerecord'] = $this->hr_model->get_all_employee();
					$data['departmentrecord']	= $this->hr_model->get_department();
					$data['positionrecord']		= $this->hr_model->get_position();
					$data['content']		= 'hr/employee';
					$data['title']			= 'HR';
					$data['sub_title']		= 'Karyawan';
					$this->load->view('template',$data);
				}
				else
				{
					$employees = $this->hr_model->get_employee_by_employee_code($employee_code);
					if($employees == TRUE)
					{
						redirect('hr/employee');
					}
					$user_id					= $this->session->userdata('user_id');
					$employee_code				= $this->input->post('employee_code');
					$employee_name				= $this->input->post('employee_name');
					$employee_address			= $this->input->post('employee_address');
					$employee_join_date			= $this->input->post('employee_join_date');
					$employee_department		= $this->input->post('employee_department');
					$employee_position			= $this->input->post('employee_position');
					$employee_birth_date			= $this->input->post('employee_birth_date');
					$employee_sex			= $this->input->post('employee_sex');
					$employee_greeting			= $this->input->post('employee_greeting');
					$employee_first_finger_id = $this->input->post('employee_first_finger_id');
					$employee_second_finger_id = $this->input->post('employee_second_finger_id');
					$employee_third_finger_id = $this->input->post('employee_third_finger_id');
					$employee_user_id = $this->input->post('employee_user_id');
					$employee_basic_salary = $this->input->post('employee_basic_salary');
					$employee_position_allowance = $this->input->post('employee_position_allowance');
					$username = $this->input->post('username');
					$group = $this->input->post('group');

					$employee_data	=	array(
									'created_by'				=> $user_id,
									'created_time'				=> date('Y-m-d H:i:s'),
									'employee_code'				=> $employee_code,
									'employee_name'				=> $employee_name,
									'employee_address'			=> $employee_address,
									'employee_join_date'		=> date('Y-m-d', strtotime($employee_join_date)),
									'employee_department_id'	=> $employee_department,
									'employee_position_id'		=> $employee_position,
									'employee_birth_date' => date('Y-m-d',strtotime($employee_birth_date)),
									'employee_sex' => $employee_sex,
									'employee_greeting' => $employee_greeting,
									'employee_first_finger_id' => $employee_first_finger_id,
									'employee_second_finger_id' => $employee_second_finger_id,
									'employee_third_finger_id' => $employee_third_finger_id,
									'employee_user_id' => $employee_user_id,
									'employee_basic_salary' => $employee_basic_salary,
									'employee_position_allowance' => $employee_position_allowance
									);

					if($this->hr_model->employee_edit($employee_id,$employee_data)==TRUE){
						$datauser = array(
							'username' => $username,
							'group_id' => $group,
						);

						if($this->hr_model->update_general('user','user_id',$employee_user_id,$datauser)==TRUE){
							$this->session->set_flashdata('message_success','Edit karyawan berhasil dilakukan');
							redirect('hr/employee');
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

	function check_username()
	{
		$username = $this->input->post('username');
		if($this->hr_model->get_by_id_general('user','username',$username)==TRUE)
		{
			echo '0';
		}else{
			echo "1";
		}
	}

	public function employee_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->form_validation->set_rules('employee_code','Kode Karyawan', 'trim|required');
				$this->form_validation->set_rules('employee_name','Nama Karyawan', 'trim|required');
				$this->form_validation->set_rules('employee_address','Alamat', 'trim|required');
				$this->form_validation->set_rules('employee_join_date','Tgl Gabung', 'trim|required');
				$this->form_validation->set_rules('employee_department','Departemen', 'trim|required');
				$this->form_validation->set_rules('employee_position','Posisi', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
                    $data['content']		= 'hr/employee_create';
                    $data['title']			= 'HR';
                    $data['sub_title']		= 'Tambah Karyawan';
                    
					$data['user_group'] = $this->hr_model->get_general('user_group');
					$data['departmentrecord']	= $this->hr_model->get_department();
					$data['positionrecord']		= $this->hr_model->get_position();
                    
					$this->load->view('template',$data);
				}
				else
				{
					$user_id					= $this->session->userdata('user_id');
					$employee_code				= $this->input->post('employee_code');
					$employee_name				= $this->input->post('employee_name');
					$employee_address			= $this->input->post('employee_address');
					$employee_join_date			= $this->input->post('employee_join_date');
					$employee_department		= $this->input->post('employee_department');
					$employee_position			= $this->input->post('employee_position');
					$employee_birth_date			= $this->input->post('employee_birth_date');
					$employee_sex			= $this->input->post('employee_sex');
					$employee_greeting			= $this->input->post('employee_greeting');
					$employee_first_finger_id = $this->input->post('employee_first_finger_id');
					$employee_second_finger_id = $this->input->post('employee_second_finger_id');
					$employee_third_finger_id = $this->input->post('employee_third_finger_id');
					$employee_basic_salary = $this->input->post('employee_basic_salary');
					$employee_position_allowance = $this->input->post('employee_position_allowance');
                    $employee_bpjstk                = $this->input->post('employee_bpjstk');
                    
					$username = $this->input->post('username');
					$user_group_id = $this->input->post('group_id');
					$email = $this->input->post('email');
					$no_hp = $this->input->post('hp');

					$config['upload_path'] = 'assets/img/user/';
					$config['allowed_types']        = 'jpg|jpeg|png';
					$config['max_size']             = 2000;
					$config['file_name'] = $username;
					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('image'))
					{
						$data_user = array(
							'created_by'	=> $user_id,
							'email' => $email,
							'hp' => $no_hp,
							'group_id' => $user_group_id,
							'username' => $username,
							'password' => sha1($username),
							'full_name' => $employee_name,
						);
					}else {
						$data_user = array(
							'created_by'	=> $user_id,
							'email' => $email,
							'hp' => $no_hp,
							'image'			=> $config['upload_path'].$this->upload->data('file_name'),
							'group_id' => $user_group_id,
							'username' => $username,
							'password' => sha1($username),
							'full_name' => $username,
						);
					}

					$employees = $this->hr_model->get_employee_by_employee_code($employee_code);
					if($employees == TRUE)
					{
						redirect('hr/employee_create',$data);
					}

					$this->hr_model->create_general('user',$data_user);
					$employee_user_id = $this->db->insert_id();

					$employee_data	=	array(
									'created_by'				=> $user_id,
									'created_time'				=> date('Y-m-d H:i:s'),
									'employee_code'				=> $employee_code,
									'employee_name'				=> $employee_name,
									'employee_address'			=> $employee_address,
									'employee_join_date'		=> date('Y-m-d', strtotime($employee_join_date)),
									'employee_department_id'	=> $employee_department,
									'employee_position_id'		=> $employee_position,
									'employee_birth_date' => date('Y-m-d',strtotime($employee_birth_date)),
									'employee_sex' => $employee_sex,
									'employee_greeting' => $employee_greeting,
									'employee_first_finger_id' => $employee_first_finger_id,
									'employee_second_finger_id' => $employee_second_finger_id,
									'employee_third_finger_id' => $employee_third_finger_id,
									'employee_user_id' => $employee_user_id,
									'employee_basic_salary' => $employee_basic_salary,
									'employee_position_allowance' => $employee_position_allowance,
                                    'employee_bpjstk'               => $employee_bpjstk
								);

					$this->hr_model->employee_create($employee_data);
					redirect('hr/employee');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function department($param1='',$param2='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				if ($param1=='1') {
					$data['edit_status'] = 0;
					$data['departmentrecord'] = $this->hr_model->get_by_id_general('employee_department','employee_departement_status',$param1);
				}else {
					$data['edit_status'] = 1;
					$data['departmentrecord'] = $this->hr_model->get_by_id_general('employee_department','employee_departement_status',$param1);
				}

				$data['content']		= 'hr/department';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Departemen';

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

	function department_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['content']		= 'hr/department_create';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Tambah Departemen';

				$this->form_validation->set_rules('department_name','Nama Departemen', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$department_name	= $this->input->post('department_name');

					$data	=	array(
									'employee_department_name'	=> $department_name
									);

					$this->hr_model->department_create($data);
					redirect('hr/department');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function department_edit($department_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['content']		= 'hr/department_edit';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Edit Departemen';

				$this->form_validation->set_rules('department_name','Nama Departemen', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['department'] = $this->hr_model->get_department_by_employee_department_id($department_id);
					$this->load->view('template',$data);
				}
				else
				{
					$department_name	= $this->input->post('department_name');

					$data	=	array(
									'employee_department_name'	=> set_value('department_name')
									);

					$this->hr_model->department_update($department_id,$data);
					redirect('hr/department');
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

	function department_edit_status($param1='',$param2='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$department = array(
					'employee_departement_status' => $param1,
				);

				if ($this->hr_model->update_general('employee_department','employee_department_id',$param2,$department)) {
					$this->session->set_flashdata('message_success','status department berhasil di ubah');
					redirect('hr/department/'.$param1);
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

	function position($param1='',$param2='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				if ($param1=='1') {
					$data['edit_status'] = 0;
					$data['positionrecord'] = $this->hr_model->get_by_id_general('employee_position','employee_position_status',$param1);
				}else {
					$data['edit_status'] = 1;
					$data['positionrecord'] = $this->hr_model->get_by_id_general('employee_position','employee_position_status',$param1);
				}

				$data['content']		= 'hr/position';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Posisi';

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

	function position_edit_status($param1='',$param2='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$position = array(
					'employee_position_status' => $param1,
				);

				if ($this->hr_model->update_general('employee_position','employee_position_id',$param2,$position)) {
					$this->session->set_flashdata('message_success','status position berhasil di ubah');
					redirect('hr/position/'.$param1);
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

	function position_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['content']		= 'hr/position_create';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Tambah Posisi';

				$this->form_validation->set_rules('position_name','Nama Posisi', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$position_name	= $this->input->post('position_name');

					$data	=	array(
									'employee_position_name'	=> $position_name
									);

					$this->hr_model->position_create($data);
					redirect('hr/position');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function position_edit($position_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['content']		= 'hr/position_edit';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Edit Posisi';

				$this->form_validation->set_rules('position_name','Nama Posisi', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['position'] = $this->hr_model->get_position_by_employee_position_id($position_id);
					$this->load->view('template',$data);
				}
				else
				{
					$position_name	= $this->input->post('position_name');

					$data	=	array(
									'employee_position_name'	=> set_value('position_name')
									);

					$this->hr_model->position_update($position_id,$data);
					redirect('hr/position');
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

	public function salary()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$month	= date('m');
				$year	= date('Y');

				$data['salaryrecord'] = $this->hr_model->get_salary_search($month,$year);
                
                $data['month']	= $month;
				$data['year']	= $year;

				$data['content']		= 'hr/salary_summary';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Gaji';

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

	public function salary_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$month	= $this->input->get('month');
				$year	= $this->input->get('year');

				$data['salaryrecord'] = $this->hr_model->get_salary_search($month,$year);

				$data['month']	= $month;
				$data['year']	= $year;

				$data['content']		= 'hr/salary_summary';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Gaji';

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
    
    public function config()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
                $this->form_validation->set_rules('overtime_fare_per_hour','Lembur Per Jam', 'trim|required');
                $this->form_validation->set_rules('overtime_meal_fare_per_day','Uang Makan Lembur Per Hari', 'trim|required');
                $this->form_validation->set_rules('attendance_multiple_late_minutes','Kelipatan Keterlambatan (Menit)', 'trim|required');
                $this->form_validation->set_rules('attendance_late_fare','Potongan Keterlambatan', 'trim|required');
                
                if ($this->form_validation->run() == FALSE)
				{
                    $data['settings']       = $this->setting_model->get_settings();

                    $data['content']		= 'hr/hr_config';
                    $data['title']			= 'HR';
                    $data['sub_title']		= 'Pengaturan HRM';

                    $this->load->view('template',$data);
                }
                else
                {
                    $overtime_fare_per_hour             = $this->input->post('overtime_fare_per_hour');
                    $overtime_meal_fare_per_day         = $this->input->post('overtime_meal_fare_per_day');
                    $attendance_multiple_late_minutes   = $this->input->post('attendance_multiple_late_minutes');
                    $attendance_late_fare               = $this->input->post('attendance_late_fare');
                    
                    $update_hr_config_data = array(
                        'overtime_fare_per_hour'            => $overtime_fare_per_hour,
                        'overtime_meal_fare_per_day'        => $overtime_meal_fare_per_day,
                        'attendance_multiple_late_minutes'  => $attendance_multiple_late_minutes,
                        'attendance_late_fare'              => $attendance_late_fare
                    );
                    
                    $this->hr_model->hr_config_update('1', $update_hr_config_data);
                    
                    $this->session->set_flashdata('message_success','Pengaturan berhasil di simpan');
                    redirect('hr/config');
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

	function salary_export_to_excel($month,$year)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{

				$salaryrecord = $this->hr_model->get_salary_search($month,$year);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Salary Report")
											 ->setSubject("Salary Report")
											 ->setDescription("Salary Report")
											 ->setKeywords("Salary Report")
											 ->setCategory("Salary Report");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'Nama Karyawan')
							->setCellValue('C1', 'Tgl Masuk Kerja')
							->setCellValue('D1', 'Hari Kerja')
							->setCellValue('E1', 'Gaji Pokok')
							->setCellValue('F1', 'T. Jabatan')
							->setCellValue('G1', 'Jam Lembur')
							->setCellValue('H1', 'Upah Lembur')
							->setCellValue('I1', 'BPJS')
							->setCellValue('J1', 'Kas Bon')
							->setCellValue('K1', 'Uang Baju')
							->setCellValue('L1', 'Waktu Telat')
							->setCellValue('M1', 'Potongan Telat')
							->setCellValue('N1', 'Alpa')
							->setCellValue('O1', 'Izin')
							->setCellValue('P1', 'Sakit')
							->setCellValue('Q1', 'Gaji Pokok Bersih');

				// Add data
				$no=1;
				$i=1;
				foreach($salaryrecord as $row)
				{
					$employee_basic_salary = $row->employee_basic_salary;
					$employee_allowance = $row->employee_allowance;

					$gpb 	= $employee_basic_salary + $row->employee_salary_loan + $employee_allowance + ($row->employee_salary_overtime_hour * $this->session->userdata('overtime_fare_per_hour')) - ($row->employee_salary_bpjs + $row->employee_salary_loan + $row->employee_salary_uniforms + ($row->employee_salary_late_minutes * $this->session->userdata('late_fare_per_minute')));
					$panjang = strlen($gpb);
					$ribuan	= substr($gpb, -3);
					if($ribuan < 500)
					{
						$depan	= substr($gpb,0,($panjang - 3));
						$gpb 	= $depan . '000';
					}
					elseif($ribuan >= 500)
					{
						$depan	= substr($gpb,0,($panjang - 3)) + 1;
						$gpb 	= $depan . '000';
					}
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, $row->employee_name)
							->setCellValue('C'.$i, date("d-m-Y",strtotime($row->employee_join_date)))
							->setCellValue('D'.$i, $row->employee_salary_attendance)
							->setCellValue('E'.$i, $employee_basic_salary)
							->setCellValue('F'.$i, $employee_allowance)
							->setCellValue('G'.$i, $row->employee_salary_overtime_hour)
							->setCellValue('H'.$i, $row->employee_salary_overtime_hour * $this->session->userdata('overtime_fare_per_hour'))
							->setCellValue('I'.$i, $row->employee_salary_bpjs)
							->setCellValue('J'.$i, $row->employee_salary_loan)
							->setCellValue('K'.$i, $row->employee_salary_uniforms)
							->setCellValue('L'.$i, $row->employee_salary_late_minutes)
							->setCellValue('M'.$i, $row->employee_salary_late_minutes * $this->session->userdata('late_fare_per_minute'))
							->setCellValue('N'.$i, $row->employee_salary_not_present)
							->setCellValue('O'.$i, $row->employee_salary_leave)
							->setCellValue('P'.$i, $row->employee_salary_sick)
							->setCellValue('Q'.$i, $gpb);
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Salary Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="salary_report.xlsx"');
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

	public function salary_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->form_validation->set_rules('employee_id','Nama Karyawan', 'trim|required');
				$this->form_validation->set_rules('salary_month','Bulan', 'trim|required');
				/* $this->form_validation->set_rules('salary_year','Tahun', 'trim|required');
				$this->form_validation->set_rules('salary_receipt_date','Tgl Terima', 'trim|required');
				$this->form_validation->set_rules('salary_attendance','Kehadiran', 'trim|required');
				$this->form_validation->set_rules('salary_not_present','Tidak Hadir', 'trim|required');
				$this->form_validation->set_rules('salary_sick','Sakit', 'trim|required');
				$this->form_validation->set_rules('salary_leave','Cuti', 'trim|required');
				$this->form_validation->set_rules('salary_meal_allowance','Uang Makan', 'trim|required');
				$this->form_validation->set_rules('salary_money_transport','Uang Transport', 'trim|required');
				$this->form_validation->set_rules('salary_thr','THR', 'trim|required');
				$this->form_validation->set_rules('salary_overtime_hour','Jam Lembur', 'trim|required');
				$this->form_validation->set_rules('salary_uniforms','Uang Baju', 'trim|required');
				$this->form_validation->set_rules('salary_late_minutes','Telat Hadir', 'trim|required');
				$this->form_validation->set_rules('salary_bpjs','BPJS', 'trim|required');
				$this->form_validation->set_rules('employee_basic_salary','Gaji Pokok', 'trim|required');
				$this->form_validation->set_rules('employee_allowance',' Tunjangan', 'trim|required');
                */

				if ($this->form_validation->run() == FALSE)
				{
                    $data['content']		= 'hr/salary_create';
                    $data['title']			= 'HR';
                    $data['sub_title']		= 'Input Gaji';
                    
					$data['employeerecord']	= $this->hr_model->get_employee();
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$employee_id	= $this->input->post('employee_id');
                    $salary_month   = $this->input->post('salary_month');
                    
                    $employee_data = $this->hr_model->get_employee_by_employee_id($employee_id);
                    foreach ($employee_data AS $employee)
                    {
                        $employee_basic_salary          = $employee->employee_basic_salary;
                        $employee_position_allowance    = $employee->employee_position_allowance;
                        $employee_meal_transport        = $employee->employee_meal_transport;
                        $employee_bpjstk                = $employee->employee_bpjstk;
                        $employee_additional_allowance  = $employee->employee_additional_allowance;
                    }
                    
                    $attendance_config = $this->hr_model->get_attendance_config();
                    
                    foreach ($attendance_config AS $key)
                    {
                        $masuk[] = $key->ac_present_times;
                        $max_late[] = $key->ac_late_maximum;
                        $tolerant_times[] = $key->ac_tolerant_times;
                        $working_hours[] = $key->ac_working_hours;
                    }
                    
                    $masuk_pagi = $masuk[0];
                    $masuk_sore = $masuk[1];
                    $jam_pulang_pagi = strtotime($masuk_pagi) + $working_hours[0]*60*60;
                    $jam_pulang_sore = strtotime($masuk_sore) + $working_hours[1]*60*60;
                    $maksimum_telat_pagi = $max_late[0];
                    $maksimum_telat_sore = $max_late[1];
                    $toleransi_kehadiran_pagi = $tolerant_times[0];
                    $toleransi_kehadiran_sore = $tolerant_times[1];
                    
                    $start_date = date('Y-'.$salary_month.'-01');
                    $end_date   = date('Y-'.$salary_month.'-t');
                    
                    $attendance_data = $this->hr_model->get_attendance_recap_by_employee_id($start_date,$end_date,$employee_id);
                    
                    $total_jam = 0;
                    $total_menit = 0;
                    $total_jam_datang_cepat_pagi = 0;
                    $total_menit_datang_cepat_pagi = 0;
                    $total_jam_datang_cepat_sore = 0;
                    $total_menit_datang_cepat_sore = 0;
                    $total_jam_datang_telat_pagi = 0;
                    $total_jam_datang_telat_sore = 0;
                    $total_jam_pulang_cepat_pagi = 0;
                    $total_menit_pulang_cepat_pagi = 0;
                    $total_jam_pulang_cepat_sore = 0;
                    $total_menit_pulang_cepat_sore = 0;
                    $total_jam_pulang_lewat_pagi = 0;
                    $total_jam_pulang_lewat_sore = 0;
                    $total_jam_pulang_lewat_pagi_lembur = 0;
                    $total_jam_pulang_lewat_sore_lembur = 0;
                    $total_jam_telat = 0;
                    $total_jam_lembur = 0;
                    $total_jam_datang_cepat = 0;
                    $total_jam_pulang_lewat = 0;
                    $total_uang_lembur_bersih = 0;
                    
                    foreach ($attendance_data AS $attendance)
                    {
                        $jam_absen_datang = strtotime(date('H:i:s',strtotime($attendance->attendance_recap_time_in)));
                        $jam_absen_pulang = strtotime(date('H:i:s',strtotime($attendance->attendance_recap_time_out)));
                    
                        // Datang cepat pagi
                        if ($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore))
                        {
                            unset($menit_datang_cepat_sore);
                            $jam_masuk = strtotime($masuk_pagi);
                            $diff = $jam_masuk - $jam_absen_datang;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                              
                            $menit_datang_cepat_pagi = $menit / 60;
                            $jam_datang_cepat_pagi = $jam;
                              
                            if ($key->attendance_recap_time_in_overtime_approve_by > 0)
                            {
                                $total_jam_datang_cepat_pagi_lembur = $jam_datang_cepat_pagi;
                                  //echo $total_jam_datang_cepat_pagi_lembur;
                            }

                            $menit_datang_cepat_sore=0;
                            unset($jam_datang_cepat_sore);
                            $jam_datang_cepat_sore=0;
                        }
                        // Datang cepat sore
                        elseif ($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                        $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                        {
                            unset($jam_datang_cepat_sore_lembur);
                            $jam_datang_cepat_sore_lembur=0;
                            unset($menit_datang_cepat_sore);

                            $jam_masuk = strtotime($masuk_sore);
                            $diff = $jam_masuk - $jam_absen_datang;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                              
                            $menit_datang_cepat_sore = $menit / 60;
                            $jam_datang_cepat_sore = $jam;
                              
                            if ($key->attendance_recap_time_in_overtime_approve_by > 0)
                            {
                                $jam_datang_cepat_sore_lembur = $jam_datang_cepat_sore;
                            }
                        }
                        // Telat pagi
                        elseif ($jam_absen_datang > strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          )
                        {
                            $jam_pulang_cepat_pagi=0;
                            $jam_datang_cepat_sore=0;
                            $jam_datang_cepat_pagi=0;
                            $menit_datang_cepat_sore=0;
                            unset($menit_datang_cepat_pagi);
                              $menit_datang_cepat_pagi=0;
                            
                            $jam_masuk = strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi));
                            $diff = $jam_absen_datang - $jam_masuk;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            
                            $total_menit += floor($menit / 60);
                            $total_menit_to_jam = $total_menit / 60;
                            
                            $jam_datang_telat_pagi = $jam;
                        }
                        // Telat sore
                        elseif ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore)))
                          {
                            $jam_masuk = strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore));
                            $diff = $jam_absen_datang - $jam_masuk;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            
                            $total_menit += floor($menit / 60);
                            $total_menit_to_jam = $total_menit / 60;
                            
                            $jam_datang_telat_sore = $jam;
                        }
                        // Lebih pagi
                        elseif (($jam_absen_datang <= strtotime($masuk_pagi) && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) && $jam_absen_datang < strtotime($masuk_sore)) OR ($jam_absen_datang <= strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))) OR ($jam_absen_datang > strtotime("+".$toleransi_kehadiran_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          ) && $jam_absen_pulang > $jam_pulang_pagi && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                        {
                            $jam_pulang_lewat_sore_lembur=0;
                            $jam_pulang_lewat_pagi_lembur=0;
                            $menit_pulang_cepat_sore=0;
                            unset($jam_pulang_cepat_pagi);
                            $jam_pulang_cepat_pagi=0;
                            $menit_pulang_cepat_pagi=0;
                            $jam_pulang_cepat_sore=0;
                            
                            $diff =  $jam_absen_pulang - $jam_pulang_pagi;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - $jam * (60 * 60);
                            $total_menit = $menit / 60;
                              
                            $jam_pulang_lewat_pagi = $jam;
                              
                            if ($key->attendance_recap_time_out_overtime_approve_by > 0)
                            {
                                $jam_pulang_lewat_pagi_lembur = $jam_pulang_lewat_pagi;
                            }

                            unset($jam_pulang_lewat_sore);
                            $jam_pulang_lewat_sore = 0;
                        }
                        // Lebih sore
                        elseif (($jam_absen_datang <= strtotime($masuk_sore) && $jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi)) &&
                        $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang <= strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) OR ($jam_absen_datang > strtotime("+".$maksimum_telat_pagi." minutes",strtotime($masuk_pagi))
                          && $jam_absen_datang > strtotime("+".$toleransi_kehadiran_sore." minutes",strtotime($masuk_sore))
                          && $jam_absen_datang < strtotime("+".$maksimum_telat_sore." minutes",strtotime($masuk_sore))) && $jam_absen_pulang > $jam_pulang_sore && $key->attendance_recap_time_out !== '0000-00-00 00:00:00')
                        {
                              unset($jam_pulang_lewat_pagi);
                            
                              $diff =  $jam_absen_pulang - $jam_pulang_sore;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              
                              $total_menit = $menit / 60;
                              
                              $jam_pulang_lewat_sore = $jam;
                              
                              if ($key->attendance_recap_time_out_overtime_approve_by > 0)
                              {
                                $jam_pulang_lewat_sore_lembur = $jam_pulang_lewat_sore;
                              }
                        }
                        
                        $total_jam_pulang_lewat_pagi += $jam_pulang_lewat_pagi;
                        $total_jam_pulang_lewat_sore += $jam_pulang_lewat_sore;
                            
                        $total_menit_datang_cepat_pagi    += $menit_datang_cepat_pagi;
                        $total_menit_datang_cepat_sore    += $menit_datang_cepat_sore;
                          
                        $total_jam_datang_cepat_pagi  += $jam_datang_cepat_pagi;
                        $total_jam_datang_cepat_sore  += $jam_datang_cepat_sore;
                          
                        $total_jam_pulang_cepat_pagi += $jam_pulang_cepat_pagi;
                        $total_jam_pulang_cepat_sore += $jam_pulang_cepat_sore;
                          
                        $total_menit_pulang_cepat_pagi    += $menit_pulang_cepat_pagi;
                        $total_menit_pulang_cepat_sore    += $menit_pulang_cepat_sore;
                              
                        $total_jam_pulang_lewat_pagi_lembur += $jam_pulang_lewat_pagi_lembur;
                        $total_jam_pulang_lewat_sore_lembur += $jam_pulang_lewat_sore_lembur;
                    }
                      
                    $total_jam_datang_cepat = round(($total_menit_datang_cepat_pagi + $total_menit_datang_cepat_sore) / 60) + $total_jam_datang_cepat_pagi + $total_jam_datang_cepat_sore;
                      
                    $total_jam_pulang_cepat = round(($total_jam_pulang_cepat_pagi + $total_jam_pulang_cepat_sore) / 60);
                      
                    $total_jam_datang_telat = $total_jam_datang_telat_pagi + $total_jam_datang_telat_sore;
                      
                    $total_jam_pulang_lewat = $total_jam_pulang_lewat_pagi + $total_jam_pulang_lewat_sore;
                    
                    $total_jam_lembur       = $total_jam_pulang_lewat_pagi_lembur + $total_jam_pulang_lewat_sore_lembur;
                    
                    if ($total_jam_lembur > 0)
                    {
                        $total_uang_lembur_bersih = $total_jam_lembur * $this->session->userdata('overtime_fare_per_hour');
                    }
                    
                    //$total_jam_lembur = $total_jam_datang_cepat_pagi_lembur + $total_jam_datang_cepat_sore_lembur + $total_jam_pulang_lewat_pagi_lembur + $total_jam_pulang_lewat_sore_lembur;
                    
                    
                    
					$salary_year				    = date('Y');
					$employee_position_allowance	= $employee_position_allowance;
					$salary_receive_date		    = $this->input->post('salary_receive_date');
					$salary_attendance			    = COUNT($attendance_data);
					$salary_not_present			    = 0;
					$salary_sick				    = 0;
					$salary_leave				    = 0;
                    $salary_money_transport         = 0;
					$salary_meal_allowance		    = 0;
					$salary_meal_transport		    = $employee_meal_transport;
					$salary_thr					    = $this->input->post('salary_thr');
                    $salary_overtime_day            = $salary_overtime_day_qty;
					$salary_overtime_hour		    = $total_jam_lembur;
                    $salary_overtime_nominal	    = $total_uang_lembur_bersih;
					$salary_uniforms			    = 0;
					$salary_late_minutes		    = 0;
					$salary_bpjstk				    = $employee_bpjstk;
					$employee_loan                  = $this->input->post('employee_loan');
                    $employee_incentive             = $this->input->post('employee_incentive');

					$salary_data	=	array(
                        'created_by'						    => $user_id,
                        'created_time'						    => date('Y-m-d H:i:s'),
                        'employee_id'						    => $employee_id,
                        'employee_salary_month'				    => $salary_month,
                        'employee_salary_year'				    => $salary_year,
                        'employee_salary_receive_date'		    => date('Y-m-d', strtotime($salary_receive_date)),
                        'employee_salary_attendance'		    => $salary_attendance,
                        'employee_salary_not_present'		    => $salary_not_present,
                        'employee_salary_sick'				    => $salary_sick,
                        'employee_salary_leave'				    => $salary_leave,
                        'employee_salary_meal_allowance'	    => $salary_meal_allowance,
                        'employee_salary_meal_transport'	    => $salary_meal_transport,
                        'employee_salary_money_transport'	    => $salary_money_transport,
                        'employee_salary_thr'				    => $salary_thr,
                        'salary_overtime_hour'                  => $salary_overtime_hour,
                        'employee_salary_overtime_hour'		    => $salary_overtime_hour,
                        'employee_salary_uniforms'			    => $salary_uniforms,
                        'employee_salary_late_minutes'		    => $salary_late_minutes,
                        'employee_salary_bpjstk'				=> $salary_bpjstk,
                        'employee_basic_salary'		            => $employee_basic_salary,
                        'employee_salary_position_allowance'    => $employee_position_allowance,
                        'employee_salary_loan'                  => $employee_loan,
                        'employee_salary_incentive'             => $employee_incentive,
                        'employee_salary_additional_allowance'  => $employee_additional_allowance
                    );

					$this->hr_model->salary_create($salary_data);
					redirect('hr/salary');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}
    
    public function salary_remove($employee_salary_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
                $this->hr_model->salary_remove($employee_salary_id);
                redirect('hr/salary');
            }
        }
        else
        {
            redirect('account/login');
        }
    }
    
    public function slip($salary_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{

				$data['sliprecord'] = $this->hr_model->get_salary_by_salary_id($salary_id);

				$this->load->view('hr/slip',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function delete_employee($param1='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$this->hr_model->delete_general('employee','employee_id',$param1);
				$this->session->set_flashdata('message_success','Karyawan berhasil dihapus');
				redirect('hr/employee');
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

	public function attendance()
	{
				$data['content']		= 'hr/attendance';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Absensi';
				$this->load->view('template',$data);
	}

	public function attendance_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$month	= $this->input->post('month');
				$year	= $this->input->post('year');

				$data['salaryrecord'] = $this->hr_model->get_salary_search($month,$year);

				$data['month']	= $month;
				$data['year']	= $year;

				$data['content']		= 'hr/salary_summary';
				$data['title']			= 'HR';
				$data['sub_title']		= 'Absensi';

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

	function attendance_export_to_excel($month,$year)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{

				$salaryrecord = $this->hr_model->get_salary_search($month,$year);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("eDagang.id")
											 ->setLastModifiedBy("eDagang.id")
											 ->setTitle("Salary Report")
											 ->setSubject("Salary Report")
											 ->setDescription("Salary Report")
											 ->setKeywords("Salary Report")
											 ->setCategory("Salary Report");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'Nama Karyawan')
							->setCellValue('C1', 'Tgl Masuk Kerja')
							->setCellValue('D1', 'Hari Kerja')
							->setCellValue('E1', 'Gaji Pokok')
							->setCellValue('F1', 'T. Jabatan')
							->setCellValue('G1', 'Jam Lembur')
							->setCellValue('H1', 'Upah Lembur')
							->setCellValue('I1', 'BPJS')
							->setCellValue('J1', 'Kas Bon')
							->setCellValue('K1', 'Uang Baju')
							->setCellValue('L1', 'Waktu Telat')
							->setCellValue('M1', 'Potongan Telat')
							->setCellValue('N1', 'Alpa')
							->setCellValue('O1', 'Izin')
							->setCellValue('P1', 'Sakit')
							->setCellValue('Q1', 'Gaji Pokok Bersih');

				// Add data
				$no=1;
				$i=1;
				foreach($salaryrecord as $row)
				{
					$employee_basic_salary = $row->employee_basic_salary;
					$employee_allowance = $row->employee_allowance;
					$gpb 	= $employee_basic_salary + $row->employee_salary_loan + $employee_allowance + ($row->employee_salary_overtime_hour * $this->session->userdata('employee_salary_overtime_hour')) - ($row->employee_salary_bpjs + $row->employee_salary_loan + $row->employee_salary_uniforms + ($row->employee_salary_late_minutes * $this->session->userdata('late_fare_per_minute')));
					$panjang = strlen($gpb);
					$ribuan	= substr($gpb, -3);
					if($ribuan < 500)
					{
						$depan	= substr($gpb,0,($panjang - 3));
						$gpb 	= $depan . '000';
					}
					elseif($ribuan >= 500)
					{
						$depan	= substr($gpb,0,($panjang - 3)) + 1;
						$gpb 	= $depan . '000';
					}
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, $row->employee_name)
							->setCellValue('C'.$i, date("d-m-Y",strtotime($row->employee_join_date)))
							->setCellValue('D'.$i, $row->employee_salary_attendance)
							->setCellValue('E'.$i, $employee_basic_salary)
							->setCellValue('F'.$i, $employee_allowance)
							->setCellValue('G'.$i, $row->employee_salary_overtime_hour)
							->setCellValue('H'.$i, ($row->employee_salary_overtime_hour * $this->session->userdata('overtime_fare_per_hour')))
							->setCellValue('I'.$i, $row->employee_salary_bpjs)
							->setCellValue('J'.$i, $row->employee_salary_loan)
							->setCellValue('K'.$i, $row->employee_salary_uniforms)
							->setCellValue('L'.$i, $row->employee_salary_late_minutes)
							->setCellValue('M'.$i, $row->employee_salary_late_minutes * $this->session->userdata('late_fare_per_minute'))
							->setCellValue('N'.$i, $row->employee_salary_not_present)
							->setCellValue('O'.$i, $row->employee_salary_leave)
							->setCellValue('P'.$i, $row->employee_salary_sick)
							->setCellValue('Q'.$i, $employee_basic_salary + $row->employee_salary_loan + $employee_allowance + ($row->employee_salary_overtime_hour * $this->session->userdata('overtime_fare_per_hour')) - ($row->employee_salary_bpjs + $row->employee_salary_loan + $row->employee_salary_uniforms + ($row->employee_salary_late_minutes * $this->session->userdata('late_fare_per_minute'))));
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Salary Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="salary_report.xlsx"');
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

	public function attendance_create()
	{     
        $today = date("Y-m-d");
        $data['attendancerecord'] = $this->hr_model->get_attendance($today);
        $data['ip_finger_print'] = $this->hr_model->get_by_id_general('production_devices','production_devices_type',3);
        
        $this->attendance_reconcile();
        
        $this->load->view('hr/attendance_create',$data);
	}
    
    public function attendance_original_data()
	{
        $data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

        $group_id = $this->session->userdata('group_id');
        if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
        {
            $data['attendance'] = $this->hr_model->get_all_attendance();
            
            $data['content']		= 'hr/attendance_original_data';
            $data['title']			= 'HR';
            $data['sub_title']		= 'Data Absensi Asli';
            
            $this->load->view('template',$data);
        }
        else
        {
            redirect('account/login');
        }
	}
    
    private function attendance_reconcile()
	{
        $attendance_data = $this->hr_model->get_general('attendance');
        //var_dump($attendance_data);
        foreach ($attendance_data AS $attendancedata)
        {
            $finger_id = $attendancedata->finger_id;
            $attendance_date = date('Y-m-d', strtotime($attendancedata->attendance_times));
            
            $employee = $this->hr_model->get_employee_by_finger_id($finger_id);
            if ($employee)
            {
                $employee_id = $employee->employee_id;
                
                $absen_datang = $this->hr_model->get_attendance_in_by_employee_id($attendance_date,$employee_id);
                
                if ($absen_datang)
                {
                    $jam_absen_datang = $absen_datang->attendance_times;
                    
                    $attendance_recap = $this->hr_model->get_attendance_recap_by_employee_id($attendance_date,$attendance_date,$employee_id);
                    
                    if ($attendance_recap)
                    {
                        foreach ($attendance_recap AS $recap)
                        {
                            if ($recap->attendance_recap_time_out == '0000-00-00 00:00:00')
                            {
                                //$absen_pulang = $this->hr_model->get_attendance_out_by_employee_id($attendance_date,$employee_id);
                                $absen_pulang = $this->hr_model->get_attendance_out_by_employee_id($jam_absen_datang,$employee_id);
                                
                                if ($absen_pulang)
                                {
                                    $jam_absen_pulang = $absen_pulang->attendance_times;
                                    if ($jam_absen_pulang > $jam_absen_datang)
                                    {
                                        $update_reconcile_data = array(
                                            'attendance_recap_time_out' => $jam_absen_pulang
                                        );
                                        $this->hr_model->attendance_recap_update($recap->attendance_recap_id, $update_reconcile_data);
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        $new_reconcile_data = array(
                            'attendance_recap_employee_id'  => $employee_id,
                            'attendance_recap_date'         => $attendance_date,
                            'attendance_recap_time_in'      => $jam_absen_datang
                        );
                        $this->hr_model->attendance_recap_create($new_reconcile_data);
                    }
                }
            }
        }
        echo "success";
    }
    
    public function attendance_action_overtime()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
            $group_id = $this->session->userdata('group_id');
            if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '18')
            //if ($group_id == '1')
			{
                $attendance_recap_id    = $this->input->post('attendance_recap_id');
                $events                 = $this->input->post('events');
                
                if ($attendance_recap_id && $events)
                {
                    if ($events == 'approve_in')
                    {
                        $update_attendance_data = array(
                            'attendance_recap_time_in_overtime_approve_by'   => $this->session->userdata('user_id'),
                            'attendance_recap_time_in_overtime_approve_at'   => date('Y-m-d H:i:s')
                        );
                        $this->hr_model->attendance_recap_update($attendance_recap_id,$update_attendance_data);
                        echo "success";
                    }
                    if ($events == 'reject_in')
                    {
                        $update_attendance_data = array(
                            'attendance_recap_time_in_overtime_reject_by'    => $this->session->userdata('user_id'),
                            'attendance_recap_time_in_overtime_reject_at'    => date('Y-m-d H:i:s')
                        );
                        $this->hr_model->attendance_recap_update($attendance_recap_id,$update_attendance_data);
                        echo "success";
                    }
                    if ($events == 'approve_out')
                    {
                        $update_attendance_data = array(
                            'attendance_recap_time_out_overtime_approve_by'   => $this->session->userdata('user_id'),
                            'attendance_recap_time_out_overtime_approve_at'   => date('Y-m-d H:i:s')
                        );
                        $this->hr_model->attendance_recap_update($attendance_recap_id,$update_attendance_data);
                        echo "success";
                    }
                    if ($events == 'reject_out')
                    {
                        $update_attendance_data = array(
                            'attendance_recap_time_out_overtime_reject_by'    => $this->session->userdata('user_id'),
                            'attendance_recap_time_out_overtime_reject_at'    => date('Y-m-d H:i:s')
                        );
                        $this->hr_model->attendance_recap_update($attendance_recap_id,$update_attendance_data);
                        echo "success";
                    }
                }
                else
                {
                    echo "failed";
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

	function attendance_config($param1='',$param2='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				if ($param1=='') {
					$data['content']		= 'hr/attendance_config/index';
					$data['title']			= 'HR';
					$data['sub_title']		= 'Pengaturan absensi';
					$data['attendance_config'] = $this->hr_model->get_general('attendance_config');
					$this->load->view('template',$data);
				}elseif($param1=='do_update') {
						$attendance_config = array(
							'ac_present_times' => $this->input->post('ac_present_times'),
							'ac_tolerant_times' => $this->input->post('ac_tolerant_times'),
							'ac_working_hours' => $this->input->post('ac_working_hours'),
							'ac_description' => $this->input->post('ac_description'),
							'ac_late_maximum' => $this->input->post('ac_late_maximum')
						);
					if($this->hr_model->update_general('attendance_config','ac_id',$param2,$attendance_config)==TRUE){
						$this->session->set_flashdata('message_success','Pengaturan absensi berhasil di edit');
						redirect('hr/attendance_config');
					}
				}
				if ($param1=='update') {
					$data['content']		= 'hr/attendance_config/update';
					$data['title']			= 'HR';
					$data['sub_title']		= 'Pengaturan absensi';
					$data['attendance_config'] = $this->hr_model->get_by_id_general('attendance_config','ac_id',$param2);

					$this->load->view('template',$data);
				}
				if ($param1=='create') {
					$data['content']		= 'hr/attendance_config/create';
					$data['title']			= 'HR';
					$data['sub_title']		= 'Pengaturan absensi';
					$data['attendance_config'] = $this->hr_model->get_general('attendance_config');

					$this->load->view('template',$data);
				}
				if ($param1=='do_create') {
						$attendance_config = array(
							'ac_present_times' => $this->input->post('ac_present_times'),
							'ac_tolerant_times' => $this->input->post('ac_tolerant_times'),
							'ac_working_hours' => $this->input->post('ac_working_hours'),
							'ac_description' => $this->input->post('ac_description'),
							'ac_late_maximum' => $this->input->post('ac_late_maximum')
						);
					if($this->hr_model->create_general('attendance_config',$attendance_config)==TRUE){
						$this->session->set_flashdata('message_success','Pengaturan absensi berhasil di buat');
						redirect('hr/attendance_config');
					}
			 }
			 if ($param1=='hapus') {
					$this->hr_model->delete_general('attendance_config','ac_id',$param2);
					$this->session->set_flashdata('message_success','Pengaturan absensi berhasil di hapus');
					redirect('hr/attendance_config');
			 }
			}else{
					redirect('account/login');
				}
			}
			else{
					redirect('account/login');
			}
		}

	public function attendance_rekap($param1='',$param2=''){
			if ($this->session->userdata('is_logged_in') == TRUE)
			{
				$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
				$group_id = $this->session->userdata('group_id');
				if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
				{
					if ($param2=='search') {
						$start_date = date('Y-m-d', strtotime($this->input->get('start_date')));
						$end_date = date('Y-m-d', strtotime($this->input->get('end_date')));
					}else {
						$date = date('Y-m-d');
						$start_date = date('Y-m-01', strtotime($date));
						$end_date = date('Y-m-t', strtotime($date));
					}
						$data['link'] = 'attendance_rekap';
						$data['start_date'] = date('d-m-Y', strtotime($start_date));
						$data['end_date'] = date('d-m-Y', strtotime($end_date));
						$data['employee_id'] = $param1;
						$data['title']			= 'HR';
						$employee = $this->hr_model->get_by_id_general('employee','employee_id',$param1);
						foreach ($employee as $key) {
							$nama_karyawan = $key->employee_name;
							$NIP = $key->employee_code;
						}
						$data['sub_title']		= 'Absensi Per Karyawan';
						$data['panel_info']		= 'Absensi Per Karyawan ('.$NIP.' - '.$nama_karyawan.')';
						//$data['employee'] = $this->hr_model->get_attendance_employee($start_date,$end_date,$param1);
                        $data['employee'] = $this->hr_model->get_attendance_recap_by_employee_id($start_date,$end_date,$param1);
						$data['attendance_config'] = $this->hr_model->get_general('attendance_config');
						$data['content']		= 'hr/attendance_rekap/detail';
						$this->load->view('template',$data);
				}else{
					redirect('account/login');
				}
			}
			else{
					redirect('account/login');
			}
		}

		public function attendance_all($param1='')
		{
			if ($this->session->userdata('is_logged_in') == TRUE)
			{
				$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
				$group_id = $this->session->userdata('group_id');
				if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '18')
				{
					if ($param1=='search') {
						$start_date = date('Y-m-d', strtotime($this->input->get('start_date')));
						$end_date = date('Y-m-d', strtotime($this->input->get('end_date')));
					}else {
						$date = date('Y-m-d');
						$start_date = date('Y-m-d');
						$end_date = date('Y-m-d');
					}
						$data['link'] = 'attendance_all';
						$data['start_date'] = date('d-m-Y', strtotime($start_date));
						$data['end_date'] = date('d-m-Y', strtotime($end_date));
						$data['title']			= 'HR';
						$data['sub_title']		= 'Absensi Karyawan';
						$data['panel_info']	    = 'Absensi Karyawan';
						$data['employee_id'] = '';
						//$data['employee'] = $this->hr_model->get_attendance_employee_all($start_date,$end_date);
                        $data['employee'] = $this->hr_model->get_attendance_recap($start_date,$end_date);
						$data['attendance_config'] = $this->hr_model->get_general('attendance_config');
						$data['content']		= 'hr/attendance_rekap/index';
						$this->load->view('template',$data);
				}else{
					redirect('account/login');
				}
			}
			else{
					redirect('account/login');
			}
		}
        
    public function salary_create_detail_employee()
	{
        if ($this->session->userdata('is_logged_in') == TRUE)
        {
            $data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

            $group_id = $this->session->userdata('group_id');
            if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
            {
                $data['salaryrecord'] = $this->hr_model->get_salary();

                $this->load->view('salary_create_detail_employee',$data);
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

/* End of file hr.php */
/* Location: ./application/controllers/hr.php */
