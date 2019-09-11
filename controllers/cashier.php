<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Controller {
	
	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->setting_model->index();
			
			// cek status group kasir atau tidak
			$group_id = $this->session->userdata('group_id');
			if($group_id == '6')
			{
				// cek status kasir sudah tutup atau belum
				$closed_shift = $this->cashier_model->closed_shift_check($this->session->userdata('user_id'));
				foreach($closed_shift as $row)
				if($row->closed > 0 )
				{
					$this->session->set_userdata('closed_shift','closed');
					$this->closed_receipt();
				}
				else
				{
					$this->open_shift();
				}
			}
			else
			{
				redirect('account');
			}
		}
	}
	
		function mbarang()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				//$this->cart->destroy();
				$dbarang = $this->cashier_model->select_zselectbarang($group_id);
				$data['usersrecord']			= $dbarang ;
				$data['content']		= 'cashier/mbarang';
				$data['title']			= 'Barang';
				$data['sub_title']		= 'Daftar Barang';
				
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
	
	function laptransaksi_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				$date1=$this->input->post('start_date');
				$date2=$this->input->post('end_date');	
				$dbarang = $this->cashier_model->select_ztransaksi($group_id,$date1,$date2);
				$data['dbarang']			= $dbarang ;
				$data['content']		= 'cashier/laptransaksi';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Laporan Transaksi';
				
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
			function laptransaksi()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				$date1=date("d-m-Y");
				$date2=date("d-m-Y");	
				$dbarang = $this->cashier_model->select_ztransaksi($group_id,$date1,$date2);
				$data['dbarang']			= $dbarang ;
				$data['content']		= 'cashier/laptransaksi';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Laporan Transaksi';
				
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	function edit_mbarang($id_barang)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				
				$kon = $this->cashier_model->select_kontransaksi($id_barang);
				if($kon>0){
					$this->session->set_flashdata('message_error','Data Sudah ada di Transaksi');
					redirect('cashier/mbarang');
				}else{
					$dbarang = $this->cashier_model->select_zselectbarangid($id_barang);
					$db		 = $this->cashier_model->select_zselectbarangdetailid($id_barang);
					
					$data['usersrecord']= $dbarang ;
					$data['db']			= $db ;
					$data['content']	= 'cashier/edit_mbarang';
					$data['title']		= 'Barang';
					$data['sub_title']	= 'Edit Barang';
					
					$this->load->view('template',$data);
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
		function transaksi_cart_remove($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);
			redirect('cashier/transaksi');
		}
		else
		{
			redirect('account/login');
		}
	}
		function transaksi_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');
			
			$group_id = $this->session->userdata('group_id');
			if($group_id == '12' OR $group_id == '13' )
			{
				$this->form_validation->set_rules('po_material_qty','QTY', 'trim|required');
				$this->form_validation->set_rules('po_material_price','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('cashier/transaksi');
				}
				else
				{
					$material_id		= $this->input->post('po_material_id');
					$mid=explode("#",$material_id);
					$qty				= $this->input->post('po_material_qty');
					$price				= $this->input->post('po_material_price');
					
	/*				$materialsrecords	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materialsrecords AS $materials)
					{
						$material_name	= $materials->material_name;
					}*/
								
					$data_form = array(
							   'id' 		=> $mid[0],
							   'qty'     	=> $qty,
							   'price'   	=> $price,
							   'name'    	=> $mid[1],
							   'options' 	=> ''
							);
					
					$this->cart->insert($data_form);
					redirect('cashier/transaksi_cart');
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
	
	function transaksi_baru()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');
			
			$group_id = $this->session->userdata('group_id');
			if($group_id == '12' OR $group_id == '13' )
			{
				
					$session_data	= array(
											'statustransaksi'			=> '',
											'idkasir' =>''
											);
						$this->session->set_userdata($session_data);
						$this->cart->destroy();
					redirect('cashier/transaksi');
				//}
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
	
		function transaksi_save()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');
			
			$group_id = $this->session->userdata('group_id');
			if($group_id == '12' OR $group_id == '13' )
			{
				if($group_id==12){
					$kode="TSL";
				}else{
					$kode="TSP";
				}
					$m=$this->cashier_model->maxkodetransaksi($kode);
					foreach($m as $row){
						$mkt=$row->msg;
					}
				
					$this->db->trans_start();
					foreach($this->cart->contents() as $item)
					{
						$po_data_detail = array(
													'kode_transaksi'				=> $mkt,
													'created_by'				=> $user_id,
													'id_barang'	=> $item['id'],
													'qty_transaksi'			=> $item['qty'],
													'harga_transaksi'			=> $item['price']
													);
						$this->db->insert('z_transaksi',$po_data_detail);
					}
					$this->db->trans_complete();
					$session_data	= array(
											'statustransaksi'			=> 'sukses',
											'idkasir' =>$user_id
											);
						$this->session->set_userdata($session_data);
						$this->session->set_flashdata('message_success','Data Update');
					redirect('cashier/transaksi');
				//}
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
	
	function transaksi()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				
				$dbarang = $this->cashier_model->select_zselectbarangtrans($group_id);
				
				//$data['kodebarang']			= $kodebarang;
				$data['dbarang']			= $dbarang ;
				$data['content']		= 'cashier/transaksi';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Transaksi';
				
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
		function tambah_stok()
	{
		$k="";
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				$created_by=$this->session->userdata('username');
				$stok=$_POST['v_stok'];
				$id_barang=$_POST['id_barang'];
				$k=$this->cashier_model->insert_stok($id_barang,$stok,$created_by);
				$this->session->set_flashdata('message_success','Stok Update');
				//echo $k;
				//return $k;
				//redirect('cashier/mbarang');
			}
		}
		else
		{
			redirect('account/login');
		}
		//echo $k;
	}
	
	function tambah_mbarang()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
				
				$dbarang = $this->cashier_model->select_zselectbarang($group_id);
				$kodebarang = $this->cashier_model->select_kodebarang($group_id);
				$data['kodebarang']			= $kodebarang;
				$data['usersrecord']			= $dbarang ;
				$data['content']		= 'cashier/tambah_mbarang';
				$data['title']			= 'Barang';
				$data['sub_title']		= 'Tambah Barang';
				
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
		function update_mbarang($id_barang)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
					$this->form_validation->set_rules('nama_barang','Nama Barang', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('message_error','Nama barang masih kosong');
					redirect('cashier/tambah_mbarang');
				}else{
					$kode_barang=$this->input->post('kode_barang');
					$nama_barang=$this->input->post('nama_barang');
					$harga_barang=$this->input->post('harga_barang');
					$created_by=$this->session->userdata('user_id');
					$v_nama=$this->input->post('v_nama');
					$v_qty=$this->input->post('v_qty');
					$v_harga=$this->input->post('v_harga');
					$ok=$this->cashier_model->update_zbarang($kode_barang,$nama_barang,$harga_barang,$created_by,$id_barang,$v_nama,$v_qty,$v_harga);
					//echo $ok;
					$this->session->set_flashdata('message_success','Data Update');
					redirect('cashier/mbarang');
				}
				//$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
		function insert_mbarang()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
					$this->form_validation->set_rules('nama_barang','Nama Barang', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->session->set_flashdata('message_error','Nama barang masih kosong');
					redirect('cashier/tambah_mbarang');
				}else{
					$kode_barang=$this->input->post('kode_barang');
					$nama_barang=$this->input->post('nama_barang');
					$harga_barang=$this->input->post('harga_barang');
					$qty_stok=$this->input->post('stok_awal');
					$created_by=$this->session->userdata('user_id');
					$v_nama=$this->input->post('v_nama');
					$v_qty=$this->input->post('v_qty');
					$v_harga=$this->input->post('v_harga');
					$ok=$this->cashier_model->insert_zbarang($kode_barang,$nama_barang,$harga_barang,$group_id,$created_by,$qty_stok,$v_nama,$v_qty,$v_harga);
					//echo $ok;
					$this->session->set_flashdata('message_success','Data Update');
					redirect('cashier/mbarang');
				}
				//$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function hapus_mbarang($id_barang)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '12' or $group_id == '13' )
			{
					$kon = $this->cashier_model->select_kontransaksi($id_barang);
				if($kon>0){
					$this->session->set_flashdata('message_error','Data Sudah ada di Transaksi');
					redirect('cashier/mbarang');
				}else{

					$ok=$this->cashier_model->delete_zbarang($id_barang);
					//echo $ok;
					$this->session->set_flashdata('message_success','Data dihapus');
					redirect('cashier/mbarang');
				}
				
				//$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function open_shift()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{		
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			// cek status group kasir atau tidak
			$group_id = $this->session->userdata('group_id');
			if($group_id == '6')
			{
				// cek status buka kasir
				if($this->cashier_model->open_shift_check($this->session->userdata('user_id')) == FALSE)
				{
					$data['content']		= 'cashier/open_shift';
					$data['title']			= 'Kasir';
					$data['sub_title']		= 'Saldo Awal';
					
					$this->form_validation->set_rules('capital_money','Kas Awal', 'trim|required');

					if ($this->form_validation->run() == FALSE)
					{
						$this->session->unset_userdata('capital_money');
						$this->session->set_userdata('open_shift','open');
						$this->load->view('template',$data);
					}
					else
					{
						$data_form	=	array(
										'created_by'		=> $this->session->userdata('user_id'),
										'open_shift_time'	=> date("Y-m-d H:i:s"),
										'capital_money'		=> set_value('capital_money')
										);
										
						$this->cashier_model->capital_money($data_form);
										
						$this->session->set_userdata('capital_money',set_value('capital_money'));
						$this->session->unset_userdata('open_shift');
						
						redirect('transaction');
					}
				}
				else
				{
					$open_shift	= $this->cashier_model->open_shift_check($this->session->userdata('user_id'));
					foreach($open_shift as $row)
					{
						$capital_money	= $row->capital_money;
					}
					$this->session->set_userdata('capital_money',$capital_money);
					redirect('transaction');
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
	
	function closed_shift()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if($group_id == '6')
			{
				if($this->cashier_model->open_shift_check($this->session->userdata('user_id')) == TRUE)
				{
					$data['content']		= 'cashier/closed_shift';
					$data['title']			= 'Kasir';
					$data['sub_title']		= 'Tutup Kasir';
					
					$this->form_validation->set_rules('actual_money','Uang di Kasir', 'trim|required|min_length[5]');
                    $data['dp'] 	= $this->cashier_model->dp_cashier_id($this->session->userdata('user_id'));
					$data['open_shift'] 	= $this->cashier_model->open_shift_check($this->session->userdata('user_id'));
					$data['incomecash']		= $this->cashier_model->income_cash_by_cashier_id($this->session->userdata('user_id'));
					$data['incomenoncash']	= $this->cashier_model->income_noncash_by_cashier_id($this->session->userdata('user_id'));
                    $data['rpt']	= $this->cashier_model->income_cashcc_by_cashier_id($this->session->userdata('user_id'));
                    
					
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('template',$data);
					}
					else
					{
						$income_cash		= 0;
						$income_noncash		= 0;
						
						$se_id				= $this->input->post('se_id');
						$closed_shift_time	= date("Y-m-d H:i:s");
						$income_cash		= $this->input->post('income_cash');
						$income_noncash		= $this->input->post('income_noncash');
						$total_cash			= $this->input->post('total_cash');
						$total_income		= $this->input->post('total_income');
						$actual_money		= $this->input->post('actual_money');
						$margin				= $total_cash - $actual_money;
						$closed_shift_notes	= $this->input->post('closed_shift_notes');
						$dptunai		= $this->input->post('dptunai');
                        $dptunainon		= $this->input->post('dptunainon');
						if($income_cash	== '')
						{
							$income_cash		= 0;
						}
						if($income_noncash == '')
						{
							$income_noncash		= 0;
						}
						
						$data_form	=	array(
										'closed_shift_time'		=> $closed_shift_time,
										'income_cash'			=> $income_cash,
										'income_noncash'		=> $income_noncash,
										'total_cash'			=> $total_cash,
										'total_income'			=> $total_income,
										'actual_money'			=> $actual_money,
										'closed_shift_notes'	=> $closed_shift_notes,
										'margin'				=> $margin,
                                        'dptunai'				=> $dptunai,
                                        'dptunainon'				=> $dptunainon
										);
										
						$this->cashier_model->actual_money($se_id,$data_form);
						$this->session->set_userdata('closed_shift','closed');
						redirect('cashier/closed_receipt');
					}
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
			redirect('access/login');
		}
	}
	
	function closed_receipt()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '6')
			{
				$closed_shift = $this->cashier_model->closed_shift_check($this->session->userdata('user_id'));
				foreach($closed_shift as $row)
				if ($row->closed > 0)
				{
					$this->session->set_userdata('closed_shift','closed');
					$this->session->unset_userdata('capital_money');
					
					$data['content']		= 'cashier/closed_receipt';
					$data['title']			= 'Kasir';
					$data['sub_title']		= 'Kasir Tutup';
					
					$data['data_shift'] 	= $this->cashier_model->get_shift($this->session->userdata('user_id'));
					$data['income_cash']	= $this->cashier_model->income_cash_by_cashier_id($this->session->userdata('user_id'));
					$data['income_noncash']	= $this->cashier_model->income_noncash_by_cashier_id($this->session->userdata('user_id'));
					
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
	
	function exchange_receipt()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '6')
			{
				$data['data_shift'] = $this->cashier_model->get_shift($this->session->userdata('user_id'));
				$data['data_orders'] 	= $this->cashier_model->sales_by_cashier_id($this->session->userdata('user_id'));
				
				$this->load->view('cashier/closed_shift_receipt',$data);
				$this->creceipt();
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function creceipt()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '6')
			{
				//$data_shift		= $this->cashier_model->get_shift($this->session->userdata('user_id'));
				//$data_orders 	= $this->cashier_model->sales_by_cashier_id($this->session->userdata('user_id'));
				
				try {
					  $this->receipt->creceipt();
					}
				catch (Exception $e) {
					  log_message("error", "Error: Could not print. Message ".$e->getMessage());
					  $this->receipt->close_after_exception();
					}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

}



/* End of file cashier.php */
/* Location: ./application/controllers/cashier.php */