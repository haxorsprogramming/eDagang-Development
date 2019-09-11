<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Finance extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		 $this->load->library('cart');
		// Your own constructor code
	}

	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3'  OR $group_id == '4')
			{
				$this->se_summary();
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

	function se_summary($param1='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' or $group_id == '4')
			{
				if($param1=='search'){
					$first_day_this_month = $this->input->post('start_date');
					$last_day_this_month = $this->input->post('end_date');
					$data['tglawal'] = $first_day_this_month;
					$data['tglakhir'] = $last_day_this_month;
					$data['serecord'] 		= $this->finance_model->se_summary($first_day_this_month,$last_day_this_month);
					$data['content']		= 'finance/se_summary';
					$data['title']			= 'Keuangan';
					$data['sub_title']		= 'Rekap Kasir';
				}else{
					$first_day_this_month = date('Y-m-01');
					$last_day_this_month  = date('Y-m-t');
					$data['tglawal'] = $first_day_this_month;
					$data['tglakhir'] = $last_day_this_month;
					$data['serecord'] 		= $this->finance_model->se_summary($first_day_this_month,$last_day_this_month);
					$data['content']		= 'finance/se_summary';
					$data['title']			= 'Keuangan';
					$data['sub_title']		= 'Rekap Kasir';
				}

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

	public function se_detail($se_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['serecord'] 		= $this->finance_model->se_summary_by_se_id($se_id);
				$data['account']	    = $this->finance_model->get_account();

				$data['content']		= 'finance/se_detail';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Serah Terima Kasir';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function printse_detail($se_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['serecord'] 		= $this->finance_model->se_summary_by_se_id($se_id);
				$this->load->view('report/v_printkasir',$data);
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function se_verified($se_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{

					$akun1  	=$this->input->post('akun1');
					$debit1 	=$this->input->post('debit1');
					$kredit1	=$this->input->post('kredit1');
					$ket1		=$this->input->post('ket1');
					$akun2  	=$this->input->post('akun2');
					$debit2 	=$this->input->post('debit2');
					$kredit2	=$this->input->post('kredit2');
					$ket2		=$this->input->post('ket2');
					$finance_journal_number = $this->input->post('finance_journal_number');
					$finance_journal_date=date("Y-m-d",strtotime($this->input->post('finance_journal_date')));

				$user_id			= $this->session->userdata('user_id');
				if($finance_journal_number==""  ){
					$this->session->set_flashdata('message_error','No Bukti belum diisi');
					//exit();
					redirect('finance/se_detail/'.$se_id);
				}else{

				$this->finance_model->se_history($se_id);
				$data_form	=	array(
							'verified_time'	=> date('Y-m-d H:i:s'),
							'verified_by'	=> $user_id,
							'closed_shift_notes'	=> $this->input->post('catatan'),
							'margin'	=> $this->input->post('selisih'),
							'actual_money'	=> str_replace(".","",$this->input->post('uangdikasir')),
							'total_cash'	=> str_replace(".","",$this->input->post('totaluangtunai')),
							'capital_money'	=> str_replace(".","",$this->input->post('saldoawal')),
							'income_cash'	=> str_replace(".","",$this->input->post('pendapatantunai')),
							'income_noncash'	=> str_replace(".","",$this->input->post('pendapatannontunai')),
							//'total_income'	=> str_replace(".","",$this->input->post('v_total')),
                            'dptunai'	=> str_replace(".","",$this->input->post('dptunai')),
							'dptunainon'	=> str_replace(".","",$this->input->post('dptunainon'))
							);
							//print_r($data_form);exit();

				$this->finance_model->se_verified($se_id,$data_form);
				$po_number=$se_id;
				$this->finance_model->faktur_insert_jurnal_umum($user_id,$finance_journal_number,$finance_journal_date,$akun1,$debit1,$kredit1,$akun2,$debit2,$kredit2,$po_number,$ket1,$ket2);



				$datausers	= $this->account_model->get_user_by_user_id($user_id);
				foreach($datausers as $user)
				{
					$from_email	= $user->email;
					$from_name	= $user->full_name;
				}

				$datase		= $this->finance_model->se_summary_by_se_id($se_id);
				foreach($datase as $row)
				{
					$created_by			= $row->created_by;
					$open_shift_time	= $row->open_shift_time;
					$capital_money		= $row->capital_money;
					$closed_shift_time	= $row->closed_shift_time;
					$income_cash		= $row->income_cash;
					$income_noncash		= $row->income_noncash;
					$total_cash			= $row->total_cash;
					$total_income		= $row->total_income;
					$actual_money		= $row->actual_money;
					$margin				= $row->margin;
					$closed_shift_notes	= $row->closed_shift_notes;
					$verified_time		= $row->verified_time;
					$verified_by		= $row->verified_by;
				}

				$get_cashier_name = $this->account_model->get_user_by_user_id($created_by);
				foreach($get_cashier_name as $cashier)
				{
					$cashier_full_name	= $cashier->full_name;
				}

				$get_verified_name = $this->account_model->get_user_by_user_id($verified_by);
				foreach($get_verified_name as $verified)
				{
					$verified_full_name	= $verified->full_name;
				}

				$emailto 	= array('palti.sir@gmail.com');

				$config = Array(
							'protocol' 	=> 'smtp',
							'smtp_host' => 'mail.aci.web.id',
							'smtp_port' => 26,
							'smtp_user' => 'aci_resto@aci.web.id',
							'smtp_pass' => 'KeceBadai2*16',
							'mailtype'  => 'html',
							'charset' 	=> 'utf-8',
							'wordwrap' 	=> TRUE
							);
				$this->load->library('email', $config);

				$this->email->set_newline("\r\n");
				$this->email->from($from_email, $from_name);
				$this->email->reply_to($from_email, $from_name);
				$this->email->to($emailto);
				//$this->email->cc($from_email);
				$this->email->bcc('yafiz.nasution@gmail.com');

				$this->email->subject('Closing Cashier Verified');
				$this->email->message('
					<table>
						<tr>
							<td colspan=3><h3>Closing Statement Cashier</h3></td>
						</tr>
						<tr>
							<td width=\'300\'>No. SE</td>
							<td> : </td>
							<td>'.$se_id.'</td>
						</tr>
						<tr>
							<td>Nama Kasir</td>
							<td> : </td>
							<td>'.$cashier_full_name.'</td>
						</tr>
						<tr>
							<td>Buka Kasir</td>
							<td> : </td>
							<td>'.$open_shift_time.'</td>
						</tr>
						<tr>
							<td>Tutup Kasir</td>
							<td> : </td>
							<td>'.$closed_shift_time.'</td>
						</tr>
						<tr>
							<td>Saldo Awal</td>
							<td> : </td>
							<td>'.number_format($capital_money,0,',','.').'</td>
						</tr>
						<tr>
							<td>Pendapatan Tunai</td>
							<td> : </td>
							<td>'.number_format($income_cash,0,',','.').'</td>
						</tr>
						<tr>
							<td>Pendapatan Non Tunai</td>
							<td> : </td>
							<td>'.number_format($income_noncash,0,',','.').'</td>
						</tr>
						<tr>
							<td>Total Pendapatan Tunai + Non Tunai</td>
							<td> : </td>
							<td>'.number_format($total_income,0,',','.').'</td>
						</tr>
						<tr>
							<td>Total Uang Tunai</td>
							<td> : </td>
							<td>'.number_format($total_cash,0,',','.').'</td>
						</tr>
						<tr>
							<td>Uang di Kasir</td>
							<td> : </td>
							<td>'.number_format($actual_money,0,',','.').'</td>
						</tr>
						<tr>
							<td>Selisih</td>
							<td> : </td>
							<td>'.number_format($margin,0,',','.').'</td>
						</tr>
						<tr>
							<td>Catatan</td>
							<td> : </td>
							<td>'.$closed_shift_notes.'</td>
						</tr>
						<tr>
							<td>Waktu Verifikasi</td>
							<td> : </td>
							<td>'.date('Y-m-d H:i:s').'</td>
						</tr>
						<tr>
							<td>Di Verifikasi Oleh</td>
							<td> : </td>
							<td>'.$from_name.'</td>
						</tr>
					<tr>
				</table>');

				$this->email->send();

				//echo $this->email->print_debugger();
				$this->session->set_flashdata('message_success','Data Berhasil Disimpan');
					redirect('finance/se_summary');

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

	function se_edit($se_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/se_edit';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Edit Serah Terima Kasir';

				$this->form_validation->set_rules('capital_money','Saldo Awal', 'trim|required');
				$this->form_validation->set_rules('income_cash','Pendapatan Tunai', 'trim|required');
				$this->form_validation->set_rules('income_noncash','Pendapatan Non Tunai', 'trim|required');
				$this->form_validation->set_rules('total_cash','Total Uang Tunai', 'trim|required');
				$this->form_validation->set_rules('total_income','Total Pendapatan', 'trim|required');
				$this->form_validation->set_rules('actual_money','Uang Di Kasir', 'trim|required');
				$this->form_validation->set_rules('margin','Selisih', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['serecord'] 	= $this->finance_model->se_summary_by_se_id($se_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$se_id			= $this->input->post('se_id');

					$data_form	=	array(
									'edited_time'			=> date('Y-m-d H:i:s'),
									'edited_by'				=> $user_id,
									'capital_money'			=> set_value('capital_money'),
									'income_cash'			=> set_value('income_cash'),
									'income_noncash'		=> set_value('income_noncash'),
									'total_cash'			=> set_value('total_cash'),
									'total_income'			=> set_value('total_income'),
									'actual_money'			=> set_value('actual_money'),
									'margin'				=> set_value('margin'),
									'closed_shift_notes'	=> set_value('closed_shift_notes')
									);

					$this->finance_model->se_update($se_id,$data_form);
					redirect('finance');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function se_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/se_create';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Tambah Serah Terima Kasir';

				$this->form_validation->set_rules('capital_money','Saldo Awal', 'trim|required');
				$this->form_validation->set_rules('income_cash','Pendapatan Tunai', 'trim|required');
				$this->form_validation->set_rules('income_noncash','Pendapatan Non Tunai', 'trim|required');
				$this->form_validation->set_rules('total_cash','Total Uang Tunai', 'trim|required');
				$this->form_validation->set_rules('total_income','Total Pendapatan', 'trim|required');
				$this->form_validation->set_rules('actual_money','Uang Di Kasir', 'trim|required');
				$this->form_validation->set_rules('margin','Selisih', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['cashiers']	= $this->account_model->get_cashiers();
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$se_id			= $this->input->post('se_id');

					$data_form	=	array(
									'edited_time'			=> date('Y-m-d H:i:s'),
									'edited_by'				=> $user_id,
									'capital_money'			=> set_value('capital_money'),
									'income_cash'			=> set_value('income_cash'),
									'income_noncash'		=> set_value('income_noncash'),
									'total_cash'			=> set_value('total_cash'),
									'total_income'			=> set_value('total_income'),
									'actual_money'			=> set_value('actual_money'),
									'margin'				=> set_value('margin'),
									'closed_shift_notes'	=> set_value('closed_shift_notes')
									);

					$this->finance_model->se_update($se_id,$data_form);
					redirect('finance');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function pr_summary()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['prrecord'] 		= $this->finance_model->pr_summary();

				$data['content']		= 'finance/pr_summary';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Rekap PR';

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

	function pr_create_number()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{

				$data['title']			= 'Keuangan';

				$this->form_validation->set_rules('pr_number','Nomor PR ', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['content']		= 'finance/pr_create';
					$data['sub_title']		= 'Tambah PR';

					$this->load->view('template',$data);
				}
				else
				{
					$pr_number		= $this->input->post('pr_number');

					$this->session->set_userdata('pr_number',$pr_number);
					redirect('finance/pr_create');
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

	function pr_select_product()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/pr_select_product';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Tambah PR';

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



	function pr_add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$item_id		= $this->input->post('item_id');
				$qty			= $this->input->post('qty');

				$items = $this->logistics_model->find($item_id);
				foreach($items as $item)
				{
					$data_form = array(
							   'id' 		=> $item_id,
							   'qty'     	=> $qty,
							   'name'    	=> $item->item_name
							);
				}

				$this->cart->insert($data_form);

				redirect('order/select_drink');
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

	function pr_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/pr_create';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Tambah PR';

				$this->form_validation->set_rules('capital_money','Saldo Awal', 'trim|required');
				$this->form_validation->set_rules('income_cash','Pendapatan Tunai', 'trim|required');
				$this->form_validation->set_rules('income_noncash','Pendapatan Non Tunai', 'trim|required');
				$this->form_validation->set_rules('total_cash','Total Uang Tunai', 'trim|required');
				$this->form_validation->set_rules('total_income','Total Pendapatan', 'trim|required');
				$this->form_validation->set_rules('actual_money','Uang Di Kasir', 'trim|required');
				$this->form_validation->set_rules('margin','Selisih', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['cashiers']	= $this->account_model->get_cashiers();
					$this->load->view('template',$data);
				}
				elseif($$this->session->userdata('pr_number') == FALSE)
				{
					$user_id		= $this->session->userdata('user_id');
					$se_id			= $this->input->post('se_id');

					$data_form	=	array(
									'edited_time'			=> date('Y-m-d H:i:s'),
									'edited_by'				=> $user_id,
									'capital_money'			=> set_value('capital_money'),
									'income_cash'			=> set_value('income_cash'),
									'income_noncash'		=> set_value('income_noncash'),
									'total_cash'			=> set_value('total_cash'),
									'total_income'			=> set_value('total_income'),
									'actual_money'			=> set_value('actual_money'),
									'margin'				=> set_value('margin'),
									'closed_shift_notes'	=> set_value('closed_shift_notes')
									);

					$this->finance_model->se_update($se_id,$data_form);
					redirect('finance');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function tax_profile()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/tax_profile';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Data Wajib Pajak';

				$this->form_validation->set_rules('capital_money','Saldo Awal', 'trim|required');
				$this->form_validation->set_rules('income_cash','Pendapatan Tunai', 'trim|required');
				$this->form_validation->set_rules('income_noncash','Pendapatan Non Tunai', 'trim|required');
				$this->form_validation->set_rules('total_cash','Total Uang Tunai', 'trim|required');
				$this->form_validation->set_rules('total_income','Total Pendapatan', 'trim|required');
				$this->form_validation->set_rules('actual_money','Uang Di Kasir', 'trim|required');
				$this->form_validation->set_rules('margin','Selisih', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['taxprofile']	= $this->finance_model->get_tax_profile();
					$this->load->view('template',$data);
				}
				elseif($$this->session->userdata('pr_number') == FALSE)
				{
					$user_id		= $this->session->userdata('user_id');
					$se_id			= $this->input->post('se_id');

					$data_form	=	array(
									'edited_time'			=> date('Y-m-d H:i:s'),
									'edited_by'				=> $user_id,
									'capital_money'			=> set_value('capital_money'),
									'income_cash'			=> set_value('income_cash'),
									'income_noncash'		=> set_value('income_noncash'),
									'total_cash'			=> set_value('total_cash'),
									'total_income'			=> set_value('total_income'),
									'actual_money'			=> set_value('actual_money'),
									'margin'				=> set_value('margin'),
									'closed_shift_notes'	=> set_value('closed_shift_notes')
									);

					$this->finance_model->se_update($se_id,$data_form);
					redirect('finance');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

    	function account_group()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{

				$data['accountrecord']	= $this->finance_model->get_group_account();
				$data['content']		= 'finance/account_group';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Akun Group';

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

	function account()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['accountrecord'] 		= $this->finance_model->get_account();

				$data['content']		= 'finance/account';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Akun';

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


    	function account_create_group()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/account_create_group';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Tambah Group Akun';

				$this->form_validation->set_rules('account_name','Nama Akun', 'trim|required');
				$this->form_validation->set_rules('account_code','Kode Akun', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
				//	$data['groupaccount']	= $this->finance_model->get_group_account();
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$group_account	= $this->input->post('group_account');

					$data_form	=	array(
									'finance_group_account_name'			=> $this->input->post('account_name'),
									'finance_group_account_code'			=> $this->input->post('account_code'),
									'finance_group_account_explanation'	=> $this->input->post('access_explanation')
									);

					$this->finance_model->account_create_group($data_form);
					redirect('finance/account_group');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function account_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/account_create';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Tambah Akun';

				$this->form_validation->set_rules('account_name','Nama Akun', 'trim|required');
				$this->form_validation->set_rules('account_code','Kode Akun', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['groupaccount']	= $this->finance_model->get_group_account();
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$group_account	= $this->input->post('group_account');

					$data_form	=	array(
									'created_time'					=> date('Y-m-d H:i:s'),
									'created_by'					=> $user_id,
									'finance_account_name'			=> set_value('account_name'),
									'finance_account_code'			=> set_value('account_code'),
									'finance_group_account_id'		=> $group_account,
									'finance_account_explanation'	=> set_value('access_explanation')
									);

					$this->finance_model->account_create($data_form);
					redirect('finance/account');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}


    	function account_edit_group($account_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
                $data['accounts'] 		= $this->finance_model->get_account_by_account_id_group($account_id);
				$data['content']		= 'finance/account_edit_group';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Edit Group Akun';
                $data['account_id']     =$account_id;


				$this->form_validation->set_rules('account_name','Nama Akun', 'trim|required');
				$this->form_validation->set_rules('account_code','Kode Akun', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
				//	$data['groupaccount']	= $this->finance_model->get_group_account();
					$this->load->view('template',$data);
                   // redirect('finance/account_edit/'.$account_id);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$group_account	= $this->input->post('group_account');

					$data_form	=	array(

									'finance_group_account_name'			=> $_POST['account_name'],
									'finance_group_account_code'			=> $_POST['account_code'],
									'finance_group_account_id'		=> $_POST['group_account'],
									'finance_group_account_explanation'	=> $_POST['account_explanation']
									);

					$this->finance_model->account_update_group($account_id,$data_form);
                    $this->session->set_flashdata('message_success','Data berhasil diubah');
					redirect('finance/account_group');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function account_edit($account_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
                $data['accounts'] 		= $this->finance_model->get_account_by_account_id($account_id);
				$data['content']		= 'finance/account_edit';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Edit Akun';
                $data['account_id']     =$account_id;


				$this->form_validation->set_rules('account_name','Nama Akun', 'trim|required');
				$this->form_validation->set_rules('account_code','Kode Akun', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['groupaccount']	= $this->finance_model->get_group_account();
					$this->load->view('template',$data);
                   // redirect('finance/account_edit/'.$account_id);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$group_account	= $this->input->post('group_account');
					$ga=explode("#",$group_account);
					$data_form	=	array(
									'created_time'					=> date('Y-m-d H:i:s'),
									'created_by'					=> $user_id,
									'finance_account_name'			=> $_POST['account_name'],
									'finance_account_code'			=> $_POST['account_code'],
									'finance_group_account_id'		=> $ga[0],
                                    'finance_parent_group_account_id'		=> $ga[1],
									'finance_account_explanation'	=> $_POST['account_explanation']
									);

					$this->finance_model->account_update($account_id,$data_form);
                    $this->session->set_flashdata('message_success','Data berhasil diubah');
					redirect('finance/account');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

    function balance_start_simpanjurnal()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
			         $user_id		= $this->session->userdata('user_id');
			         $ids=$_POST['acid'];
                     $debit=$_POST['debit'];
                     $kredit=$_POST['kredit'];
                     $finance_journal_date=date('Y-m-d',strtotime($this->input->post('finance_journal_date')));

				    $length = count($ids);
					for($i = 0; $i < $length; $i++) {
					//	if($debit[$i] != '0' or $kredit[$i] !='0'){
					       if($debit[$i] != '0'){
					           $tdk="1";
                               $nom1=$debit[$i];
					       }elseif($kredit[$i] != '0'){
					           $tdk="0";
                               $nom1=$kredit[$i];
					       }
                           $po_data = array(
							'created_by'			=> $user_id,
							'created_time'				=> date('Y-m-d H:i:s'),
							'finance_journal_number'	=> "",
							'finance_journal_date'		=> $finance_journal_date,
							'finance_journal_type_id'		=> "1",
							'finance_journal_explanation'		=> 'SALDO AWAL'

							);

		                  $status=$this->db->insert('finance_journal',$po_data);
                          	$po_id	= $this->db->insert_id();

	                   	$this->db->trans_start();

					   $po_data_detail = array(
										'finance_journal_id'	=> $po_id,
										'item'			=> 0,
										'finance_account_id'			=> $ids[$i],
										'debit_kredit'			=> $tdk,
										'nominal'			=> $nom1,
										'ket'			=> "SALDO AWAL"
										);

                     $this->db->insert('finance_journal_detail',$po_data_detail);

		              $this->db->trans_complete();


						//}
					}
                $this->session->set_flashdata('message_success','Data berhasil diubah');
				redirect('finance/balance_start');
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

    	function balance_start_simpan()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
			         $ids=$_POST['acid'];
                     $ini=$_POST['ini'];
                     $ubah=$_POST['ubah'];
                     $ubahhidden=$_POST['ubahhidden'];
				    $length = count($ids);
					for($i = 0; $i < $length; $i++) {
						if($ubah[$i] != $ubahhidden[$i]){
					       $this->finance_model->account_update_start($ids[$i],$ubah[$i]);
						}
					}
                $this->session->set_flashdata('message_success','Data berhasil diubah');
				redirect('finance/balance_start');
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

	function balance_start()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['balancestartrecord'] 		= $this->finance_model->get_balance_start();

				$data['content']		= 'finance/balance_start';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Saldo Awal';

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

	function general_journal($param1='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '6')
			{
				if($param1=='search')
				{
					$first_day_this_month = $this->input->post('start_date');
					$last_day_this_month = $this->input->post('end_date');
					$data['tglawal'] = $first_day_this_month;
					$data['tglakhir'] = $last_day_this_month;
					$data['glrecord'] 		= $this->finance_model->get_general_journal($first_day_this_month,$last_day_this_month);
				}else{
					$first_day_this_month = date('Y-m-01');
					$last_day_this_month  = date('Y-m-d');
					$data['tglawal'] = $first_day_this_month;
					$data['tglakhir'] = $last_day_this_month;
					$data['glrecord'] 		= $this->finance_model->get_general_journal($first_day_this_month,$last_day_this_month);
				}
				$data['content']		= 'finance/general_journal';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Jurnal Umum';
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

	function delete_general_journal($finance_journal_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2')
			{
				if($this->finance_model->delete_general_journal($finance_journal_id) == TRUE);
				{
					redirect('finance/general_journal');
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

	function general_journal_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '6')
			{
				$data['content']		= 'finance/general_journal_create';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Posting Jurnal Umum';

				$this->form_validation->set_rules('account_name','Nama Akun', 'trim|required');
				$this->form_validation->set_rules('account_code','Kode Akun', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['account']	= $this->finance_model->get_account();
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$group_account	= $this->input->post('group_account');

					$data_form	=	array(
									'created_time'					=> date('Y-m-d H:i:s'),
									'created_by'					=> $user_id,
									'finance_account_name'			=> set_value('account_name'),
									'finance_account_code'			=> set_value('account_code'),
									'finance_group_account_id'		=> $group_account,
									'finance_account_explanation'	=> set_value('access_explanation')
									);

					$this->finance_model->account_create($data_form);
					redirect('finance/account');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}
    
    public function add_journal()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$created_by			= $this->session->userdata('user_id');
				$finance_journal_number= $this->input->post('finance_journal_number');
				$finance_journal_date= $this->input->post('finance_journal_date');
				$finance_journal_type_id= $this->input->post('finance_journal_type_id');
				$keterangan= $this->input->post('keterangan');

				$akun1		= $this->input->post('account1');
				$debit1		= $this->input->post('debit1');
				$kredit1	= $this->input->post('kredit1');
				$ket1		= $this->input->post('ket1');
				$akun2		= $this->input->post('account2');
				$debit2		= $this->input->post('debit2');
				$kredit2	= $this->input->post('kredit2');
				$ket2		= $this->input->post('ket2');

				$po_data = array(
							'created_by'			=> $created_by,
							'created_time'				=> date('Y-m-d H:i:s'),
							'finance_journal_number'				=> $finance_journal_number,
							'finance_journal_date'		=> date('Y-m-d',strtotime($finance_journal_date)),
							'finance_journal_type_id'		=> $finance_journal_type_id,
							'finance_journal_explanation'		=> $keterangan

							);

				$status=$this->db->insert('finance_journal',$po_data);

				//return $po_data;
				$po_id	= $this->db->insert_id();
				$length = count($akun1)-1;
			for($i = 0; $i < $length; $i++) {
				$this->db->trans_start();
				if($debit1[$i]>0 and ($kredit1[$i]==0 or $kredit1[$i]=='')){
					$dk="1";
					$nom1=$debit1[$i];
				}elseif(($debit1[$i]==0 or $debit1[$i]=='') and $kredit1[$i]>0){
					$dk="0";
					$nom1=$kredit1[$i];
				}
							 $po_data_detail = array(
												'finance_journal_id'	=> $po_id,
												'item'			=> 0,
												'finance_account_id'			=> $akun1[$i],
												'debit_kredit'			=> $dk,
												'nominal'			=> $nom1,
												'ket'			=> $ket1[$i]
												);

					$this->db->insert('finance_journal_detail',$po_data_detail);

					$this->db->trans_start();
					if($debit2[$i]>0 and ($kredit2[$i]==0 or $kredit2[$i]=='')){
						$dk2="1";
						$nom2=$debit2[$i];
					}elseif(($debit2[$i]==0 or $debit2[$i]=='') and $kredit2[$i]>0){
						$dk2="0";
						$nom2=$kredit2[$i];
					}
								 $po_data_detail = array(
													'finance_journal_id'	=> $po_id,
													'item'					=> 0,
													'finance_account_id'	=> $akun2[$i],
													'debit_kredit'			=> $dk2,
													'nominal'				=> $nom2,
													'ket'					=> $ket2[$i]
													);

						$this->db->insert('finance_journal_detail',$po_data_detail);

					$this->db->trans_complete();
					if ($dk=="1"){
						$this->db->reconnect();
						$sql = "update finance_account set finance_account_saldo=finance_account_saldo+".$nom1." where finance_account_id=".$akun1[$i];
						$this->db->query($sql);
					}elseif($dk=="0"){
						$this->db->reconnect();
						$sql = "update finance_account set finance_account_saldo=finance_account_saldo-".$nom1." where finance_account_id=".$akun1[$i];
						$this->db->query($sql);

					}

					if ($dk2=="1"){
						$this->db->reconnect();
						$sql = "update finance_account set finance_account_saldo=finance_account_saldo+".$nom2." where finance_account_id=".$akun2[$i];
						$this->db->query($sql);
					}elseif($dk2=="0"){
						$this->db->reconnect();
						$sql = "update finance_account set finance_account_saldo=finance_account_saldo-".$nom2." where finance_account_id=".$akun2[$i];
						$this->db->query($sql);

					}
			}

				//$data['content']		= 'purchase/pr_test';
//				$data['status']			= $data_form;
//				$data['ok']			= $ok;
//					$data['title']			= 'Purchase';
//					$data['sub_title']		= 'Detail PR';
//
//					$this->load->view('template',$data);
				$this->session->set_flashdata('message_success','Data Update');
				if($finance_journal_type_id==1){
					redirect('finance/general_journal');
				}elseif($finance_journal_type_id==2){
					redirect('finance/adjusting_journal');
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

	function adjusting_journal()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['ajrecord'] 		= $this->finance_model->get_adjusting_journal();

				$data['content']		= 'finance/adjusting_journal';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Jurnal Penyesuaian';

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

	function delete_adjusting_journal($finance_journal_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2')
			{
				if($this->finance_model->delete_general_journal($finance_journal_id) == TRUE);
				{
					redirect('finance/adjusting_journal');
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

	function adjusting_journal_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'finance/adjusting_journal_create';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Tambah Jurnal Penyesuaian';

				$this->form_validation->set_rules('account_name','Nama Akun', 'trim|required');
				$this->form_validation->set_rules('account_code','Kode Akun', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['account']	= $this->finance_model->get_account();
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$group_account	= $this->input->post('group_account');

					$data_form	=	array(
									'created_time'					=> date('Y-m-d H:i:s'),
									'created_by'					=> $user_id,
									'finance_account_name'			=> set_value('account_name'),
									'finance_account_code'			=> set_value('account_code'),
									'finance_group_account_id'		=> $group_account,
									'finance_account_explanation'	=> set_value('access_explanation')
									);

					$this->finance_model->account_create($data_form);
					redirect('finance/account');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}


	function tutup_buku()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$puser			= $this->session->userdata('user_id');
				$ptgl			= $this->input->post('finance_journal_date');
				$this->finance_model->tutup_buku($puser,$ptgl);


				$this->session->set_flashdata('message_success','Tutup Buku Berhasil');
				redirect('finance/balance_sheet');
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

    function bs_detail_account($id,$bln)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['sk'] 		= $this->finance_model->detail_account($id,$bln);
				$this->load->view('finance/bs_detail_account',$data);
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

	function balance_sheet()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['bsrecord'] 		= $this->finance_model->get_balance_sheet();
                $data['tgl1']		= "01-".date('m-Y');
                $data['tgl2']		= date('d-m-Y');

				$data['content']		= 'finance/balance_sheet';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Buku Besar';

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

    function balance_sheet_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['bsrecord'] 		= $this->finance_model->get_balance_sheet();
                $data['tgl1']		= $_POST['tgl1'];
                $data['tgl2']		= $_POST['tgl2'];

				$data['content']		= 'finance/balance_sheet';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Buku Besar';

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

	function lapbukubesar()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['bsrecord'] 		= $this->finance_model->get_balance_sheet();

				$data['content']		= 'finance/lapbukubesar';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Buku Besar';

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

	function lapbukubesarperiode()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$bln= $this->input->post('bln');
				$thn= $this->input->post('thn');
				$periode=$thn.$bln;
				$data['bsrecord'] 		= $this->finance_model->lapbukubesar($periode);

				$data['content']		= 'finance/lapbukubesar';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Buku Besar';

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

	function profit_losslama()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{

				//$data['parentgroupaccount']	=	$this->finance_model->get_parent_group_account();
                $data['g4']	=	$this->finance_model->kode_account('410');

				$data['content']		= 'finance/profit_loss_statement';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Laporan Rugi Laba';

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

	function labarugi()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$bln= $this->input->post('bln');
				$thn= $this->input->post('thn');
				$periode=$thn.$bln;
				$data['parentgroupaccount']	=	$this->finance_model->get_parent_group_account();

				$data['content']		= 'finance/labarugi';
				$data['periode']			= $periode;
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Laporan Rugi Laba';

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

    	function balance_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				//$data['aktiva']	=	$this->finance_model->get_aktiva();
				//$data['pasiva']	=	$this->finance_model->get_pasiva();

                $data['dt11']	=	$this->finance_model->kode_account('11');
                $data['dt13']	=	$this->finance_model->kode_account('13');
                $data['dt2']	=	$this->finance_model->kode_account('2');
                $data['dt3']	=	$this->finance_model->kode_account('3');
                $data['tgl1']		= $_POST['tgl1'];
                $data['tgl2']		= $_POST['tgl2'];
				$data['content']		= 'finance/balance';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Laporan Neraca';

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

      	function profit_loss_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3'  OR $group_id == '4')
			{
				//$data['aktiva']	=	$this->finance_model->get_aktiva();
				//$data['pasiva']	=	$this->finance_model->get_pasiva();

                $data['dt11']	=	$this->finance_model->kode_account('4');
                $data['dt13']	=	$this->finance_model->kode_account('5');
                $data['dt2']	=	$this->finance_model->kode_account('6');
                //$data['dt3']	=	$this->finance_model->kode_account('3');
                $data['tgl1']		= $_POST['tgl1'];
                $data['tgl2']		= $_POST['tgl2'];
				$data['content']		= 'finance/profit_loss_statement';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Laporan Laba Rugi';

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

    	function profit_loss()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3'  OR $group_id == '4')
			{
				//$data['aktiva']	=	$this->finance_model->get_aktiva();
				//$data['pasiva']	=	$this->finance_model->get_pasiva();

                $data['dt11']	=	$this->finance_model->kode_account('4');
                $data['dt13']	=	$this->finance_model->kode_account('5');
                $data['dt2']	=	$this->finance_model->kode_account('6');
                //$data['dt3']	=	$this->finance_model->kode_account('3');
                $data['tgl1']		= "01-".date('m-Y');
                $data['tgl2']		= date('d-m-Y');
				$data['content']		= 'finance/profit_loss_statement';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Laporan Laba Rugi';

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

	function balance()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3'  OR $group_id == '4')
			{
				//$data['aktiva']	=	$this->finance_model->get_aktiva();
				//$data['pasiva']	=	$this->finance_model->get_pasiva();

                $data['dt11']	=	$this->finance_model->kode_account('11');
                $data['dt13']	=	$this->finance_model->kode_account('13');
                $data['dt2']	=	$this->finance_model->kode_account('2');
                $data['dt3']	=	$this->finance_model->kode_account('3');
                $data['tgl1']		= "01-".date('m-Y');
                $data['tgl2']		= date('d-m-Y');
				$data['content']		= 'finance/balance';
				$data['title']			= 'Keuangan';
				$data['sub_title']		= 'Laporan Neraca';

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

}

/* End of file finance.php */
/* Location: ./application/controllers/finance.php */
