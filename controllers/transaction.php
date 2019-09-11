<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}

    	function rekap_transaksi_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
				//$data['transactionsrecord'] = $this->transaction_model->get_transaction();
				$tgl1=$_POST['tgl1'];
				$tgl2=$_POST['tgl2'];
				$data['pcash'] = $this->transaction_model->payment_by_cash($tgl1,$tgl2);
				$data['pnoncash'] = $this->transaction_model->payment_by_non_cash($tgl1,$tgl2);
				$data['tglrec'] = $this->transaction_model->select_tgltrans($tgl1,$tgl2);
				$data['content']		= 'transaction/rekap_transaksi';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Rekap Transaksi';
				$data['tgl1']		= $tgl1;
				$data['tgl2']		= $tgl2;
				$this->load->view('template',$data);
            }
		}
		else
		{
			redirect('account/login');
		}
	}

	function rekap_transaksi()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
				//$data['transactionsrecord'] = $this->transaction_model->get_transaction();
				$tgl1=date("d-m-Y");
				$tgl2=date("d-m-Y");
				$data['pcash'] = $this->transaction_model->payment_by_cash($tgl1,$tgl2);
				$data['pnoncash'] = $this->transaction_model->payment_by_non_cash($tgl1,$tgl2);
				$data['tglrec'] = $this->transaction_model->select_tgltrans($tgl1,$tgl2);
				$data['content']		= 'transaction/rekap_transaksi';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Rekap Transaksi';
				$data['tgl1']		= $tgl1;
				$data['tgl2']		= $tgl2;
				$this->load->view('template',$data);
      }
		}
		else
		{
			redirect('account/login');
		}
	}


	function list_reservasi()
{
if ($this->session->userdata('is_logged_in') == TRUE)
{
	$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
		$tglawal=date("d-m-Y");
								$tglakhir=date("d-m-Y");
	$group_id = $this->session->userdata('group_id');
	if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
	{
		//$data['transactionsrecord'] = $this->transaction_model->get_transaction();
						//$tglawal=$_POST['tglawal'];
					 // $tglakhir=$_POST['tglakhir'];
						//if($tglawal=="" or $tglakhir==""){

						//}

		$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaytgl($tglawal,$tglakhir);
	}
	elseif(  $group_id == '7' or $group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15' or $group_id == '16' or $group_id == '17')
	{
		$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaynonlunas();
	}
	else
	{
		redirect('account/login');
	}

	$data['content']		= 'transaction/list_reservasi';
	$data['title']			= 'List Reservasi';
	$data['sub_title']		= 'List Reservasi';
				$data['tglawal']		= $tglawal;
				$data['tglakhir']		= $tglakhir;

	$this->load->view('template',$data);
}
else
{
	redirect('account/login');
}
}

	function list_reservasi_search()
{
if ($this->session->userdata('is_logged_in') == TRUE)
{
	$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$tglawal=$_POST["start_date"];
								$tglakhir=$_POST["end_date"];
	$group_id = $this->session->userdata('group_id');
	if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
	{
		//$data['transactionsrecord'] = $this->transaction_model->get_transaction();
						//$tglawal=$_POST['tglawal'];
					 // $tglakhir=$_POST['tglakhir'];
						//if($tglawal=="" or $tglakhir==""){

						//}

		$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaytgl($tglawal,$tglakhir);
	}
	elseif(  $group_id == '7' or $group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15' or $group_id == '16' or $group_id == '17')
	{
		$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaynonlunas();
	}
	else
	{
		redirect('account/login');
	}

	$data['content']		= 'transaction/list_reservasi';
	$data['title']			= 'List Reservasi';
	$data['sub_title']		= 'List Reservasi';
				$data['tglawal']		= $tglawal;
				$data['tglakhir']		= $tglakhir;

	$this->load->view('template',$data);
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
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$tglawal=date("d-m-Y");
      $tglakhir=date("d-m-Y");
			$this->session->unset_userdata('reservation');
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' or $group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15')
			{
				//$data['transactionsrecord'] = $this->transaction_model->get_transaction();
                //$tglawal=$_POST['tglawal'];
               // $tglakhir=$_POST['tglakhir'];
                //if($tglawal=="" or $tglakhir==""){

                //}

				$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaytgl($tglawal,$tglakhir);
			}
			elseif(  $group_id == '7' or $group_id == '16' or $group_id == '17')
			{
				$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaynonlunas();
			}
			else
			{
				redirect('account/login');
			}

			if($group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15')
			{
				$data['content']		= 'transaction/summary_beauty';
				$data['title']			= 'Transaksi Beauty';
				$data['sub_title']		= 'Transaksi Beauty';
	            $data['tglawal']		= $tglawal;
	            $data['tglakhir']		= $tglakhir;
			}else{

			$data['content']		= 'transaction/summary';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'Transaksi';
            $data['tglawal']		= $tglawal;
            $data['tglakhir']		= $tglakhir;
			}
			$this->load->view('template',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

    	function transaction_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				    $tglawal=$_POST["start_date"];
                    $tglakhir=$_POST["end_date"];
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
				//$data['transactionsrecord'] = $this->transaction_model->get_transaction();
                //$tglawal=$_POST['tglawal'];
               // $tglakhir=$_POST['tglakhir'];
                //if($tglawal=="" or $tglakhir==""){

                //}

				$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaytgl($tglawal,$tglakhir);
			}
			elseif(  $group_id == '7' or $group_id == '12' or $group_id == '13' or $group_id == '14' or $group_id == '15' or $group_id == '16' or $group_id == '17')
			{
				$data['transactionsrecord'] = $this->transaction_model->get_transaction_todaynonlunas();
			}
			else
			{
				redirect('account/login');
			}

			$data['content']		= 'transaction/summary';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'Data Transaksi';
            $data['tglawal']		= $tglawal;
            $data['tglakhir']		= $tglakhir;

			$this->load->view('template',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

    	function submit_dp()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
            $user_id	= $this->session->userdata('user_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{

			//insert_dp( $v_nama ,$v_ket,$v_total,$v_tglacara,$v_rpdp,$v_status,$v_userid)
             $m=$this->transaction_model->maxiddp();
             $k=$this->transaction_model->insert_dp($_POST['nama_dp'],$_POST['ket_dp'],$_POST['total_bayar'],$_POST['tgl_acara'],$_POST['rp_dp'],$_POST['v_status'],$user_id,$_POST['v_pm'],$_POST['v_bank'],$_POST['v_nocc'],$_POST['v_jcc'],$_POST['v_noref']);
                 if($k=='SUKSES'){
                    $this->session->set_flashdata('message_success','DATA BERHASIL DISIMPAN');
                    	try {
					       $this->receipt->cdp($_POST['nama_dp'],$_POST['ket_dp'],$_POST['total_bayar'],$_POST['tgl_acara'],$_POST['rp_dp'],$_POST['v_status'],$user_id,$m);

						}
					catch (Exception $e) {
						  log_message("error", "Error: Could not print. Message ".$e->getMessage());
						  $this->receipt->close_after_exception();
						}
                 }else{
                   $this->session->set_flashdata('message_error',$k);
                   redirect('transaction/input_dp');
                 }
            }
		}
		else
		{
			redirect('account/login');
		}
	}

    	function input_dp()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
			$data['ltu'] 	= $this->transaction_model->list_trans_unpaid();
			$data['issuerbankrecord'] 	= $this->transaction_model->get_issuer_bank();
			$data['content']		= 'transaction/input_dp';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'Input Uang Muka (DP)';

			$this->load->view('template',$data);
            }
		}
		else
		{
			redirect('account/login');
		}
	}

	function AddReservationInTransaction(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->load->view('transaction/tambah_request');

			$data_reservasi = $this->transaction_model->load_data_reservasi();
			foreach ($data_reservasi as $row) {
				$reservation_id = $row->reservation_id;
				$music_detail_id=$row->reservation_music_detail_id;
				$photo_detail_id=$row->reservation_photo_detail_id;
				$dekor_detail_id=$row->reservation_decor_detail_id;
				$beauty_detail_id=$row->reservation_beauty_detail_id;
			}

			if(isset($_POST['proses_photo'])){
				$laman=$this->input->post('kode_transaksi');
				$photo_request=$this->input->post('request');
				$photo_price=$this->input->post('price');
				$code_photo='KPWHPO'.$reservation_id;
				$total=$this->input->post('total');

				if($photo_detail_id==''){
					$this->transaction_model->update_reservation_photo_detail_id($code_photo,$reservation_id);
				}
				$this->transaction_model->AddReservationPhotoRequest($photo_request,$photo_price,$code_photo,$total);

				redirect(base_url('transaction/detail/'.$laman));
			}
			if(isset($_POST['proses_beauty'])){
				$laman=$this->input->post('kode_transaksi');
				$beauty_request=$this->input->post('request');
				$beauty_price=$this->input->post('price');
				$code_beauty='KPWHB'.$reservation_id;
				$total=$this->input->post('total');

				if($beauty_detail_id==''){
					$this->transaction_model->update_reservation_beauty_detail_id($code_beauty,$reservation_id);
				}
				$this->transaction_model->AddReservationBeautyRequest($beauty_request,$beauty_price,$code_beauty,$total);

				redirect(base_url('transaction/detail/'.$laman));
			}
			if(isset($_POST['proses_dekor'])){
				$laman=$this->input->post('kode_transaksi');
				$dekor_request=$this->input->post('request');
				$dekor_price=$this->input->post('price');
				$code_dekor='KPWHD'.$reservation_id;
				$total=$this->input->post('total');

				if($dekor_detail_id==''){
					$this->transaction_model->update_reservation_dekor_detail_id($code_dekor,$reservation_id);
				}
				$this->transaction_model->AddReservationDekorRequest($dekor_request,$dekor_price,$code_dekor,$total);

				redirect(base_url('transaction/detail/'.$laman));
			}
			if(isset($_POST['proses_music'])){
				$laman=$this->input->post('kode_transaksi');
				$music_request=$this->input->post('music_request');
				$music_price=$this->input->post('music_price');
				$code_music='KPWHM'.$reservation_id;

				if($music_detail_id==''){
					$this->transaction_model->update_reservation_music_detail_id($code_music,$reservation_id);
				}
				$this->transaction_model->AddReservationMusicRequest($music_request,$music_price,$code_music);

				redirect(base_url('transaction/detail/'.$laman));
			}
		}else{
			redirect('account/login');
		}
	}

	function edit_qty_order(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$order_id = $this->input->post('order_id');
			$qty = $this->input->post('qty');

			$this->order_model->EditQtyFromTransaction($order_id,$qty);
		}else{
			redirect('account/login');
		}
	}

    	function insert_dp_detail()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
		    $user_id			= $this->session->userdata('user_id');
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{
			 //insert_dp_detail( $v_iddp,$v_rpdp,$v_status,$v_userid)
			 $k=$this->transaction_model->insert_dp_detail($_POST['v_iddp'],$_POST['rp_dp'],$_POST['v_status'],$user_id,$_POST['v_pm'],$_POST['v_bank'],$_POST['v_nocc'],$_POST['v_jcc'],$_POST['v_noref']);
             if($k=='SUKSES'){
                $this->session->set_flashdata('message_success','DATA BERHASIL DISIMPAN');

                	try {
					       $this->receipt->cdp($_POST['nama_dp'],$_POST['ket_dp'],$_POST['total_bayar'],$_POST['tgl_acara'],$_POST['rp_dp'],$_POST['v_status'],$user_id,$_POST['v_kodedp']);

						}
					catch (Exception $e) {
						  log_message("error", "Error: Could not print. Message ".$e->getMessage());
						  $this->receipt->close_after_exception();
						}

             }else{
                $this->session->set_flashdata('message_error',$k);
             }
             redirect('transaction/detail_dp/'.$_POST['v_iddp']."/".$_POST['v_kodedp']);
            }
		}
		else
		{
			redirect('account/login');
		}
	}

    	function detail_dp($id,$kodedp)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{

			$data['dp'] = $this->transaction_model->select_dpid($id);
            $data['dpdetail'] = $this->transaction_model->select_dp_detail_id($id);
            $data['issuerbankrecord'] 	= $this->transaction_model->get_issuer_bank();

			$data['content']		= 'transaction/detail_dp';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'Detail Uang Muka (DP) '.$kodedp;

			$this->load->view('template',$data);
            }
		}
		else
		{
			redirect('account/login');
		}
	}

     	function listbatal()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' )
			{
			    $tglawal=$this->input->post('start_date');
				$tglakhir=$this->input->post('end_date');
				if($tglawal=='' or $tglakhir==''){
					$tglawal=date('d-m-Y');
					$tglakhir=date('d-m-Y');
				}
			$data['dp'] = $this->transaction_model->select_batal($tglawal,$tglakhir);

			$data['content']		= 'transaction/listbatal';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'History Perubahan Transaksi';
            $data['tglawal']			= $tglawal;
            $data['tglakhir']			= $tglakhir;

			$this->load->view('template',$data);
            }
		}
		else
		{
			redirect('account/login');
		}
	}

    	function listdp()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' or $group_id == '5' or $group_id == '6' )
			{

			$data['dp'] = $this->transaction_model->select_dp();

			$data['content']		= 'transaction/listdp';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'Uang Muka (DP)';

			$this->load->view('template',$data);
            }
		}
		else
		{
			redirect('account/login');
		}
	}

	function services_time()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			 if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5')
			{
                 $tglawal=$this->input->post('start_date');
				$tglakhir=$this->input->post('end_date');
				if($tglawal=='' or $tglakhir==''){
					$tglawal=date('d-m-Y');
					$tglakhir=date('d-m-Y');
				}
				$data['servicesrecord'] = $this->transaction_model->_get_services_timetgl($tglawal,$tglakhir);
			}
			elseif ($group_id == '6' OR $group_id == '7')
			{
				$data['servicesrecord'] = $this->transaction_model->get_services_time_today();
			}
			else
			{
				redirect('account/login');
			}

			$data['content']		= 'transaction/services_time';
			$data['title']			= 'Transaksi';
			$data['sub_title']		= 'Waktu Pelayanan';

			$this->load->view('template',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	public function services_time_ajax()
    {
        $list = $this->transaction_model->get_services_time();
		//print_r($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $services) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $services->order_id;
			$row[] = $services->full_name;
            $row[] = $services->product_name;
            $row[] = $services->created_time;
            $row[] = $services->inprogress_time;
            $row[] = $services->finished_time;
			$row[] = $services->done_time;
			//$row[] = $services->services_time;
			//$date1 = $services->done_time;
			//$date2 = $services->created_time;
			//$row[] = round((strtotime($services->created_time) - strtotime($services->done_time)) /60);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->transaction_model->get_services_time_count_all(),
                        "recordsFiltered" => $this->transaction_model->get_services_time_count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function json(){
        //$this->load->library('datatables');
        $this->datatables->select('*');
        $this->datatables->from('karyawan');
        return print_r($this->datatables->generate());
    }

	function edit($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
				$data['tablelist']			= $this->order_model->get_table_list();

				$data['content']		= 'transaction/edit';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Edit Transaksi';

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

	function table_change()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$user_id			= $this->session->userdata('user_id');
			$transaction_code	= $this->input->post('transaction_code');
			$table				= $this->input->post('table');

			$this->order_model->set_lock_table($table);

			$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
			foreach($table_olds as $table_old)
			{
				$table_old_id	= $table_old->table_id;
			}

			$this->order_model->set_unlock_table($table_old_id);

			$tablelist		= $this->order_model->get_table_by_table_id($table);
			foreach($tablelist as $tbl)
			{
				$table_name	=	$tbl->table_name;
			}

			$this->order_model->table_change($transaction_code,$table_name,$table,$user_id);
            $loid=$this->transaction_model->select_orderid($transaction_code);
            foreach($loid AS $dloid)
			{
             $this->transaction_model->history_batal_order($dloid->order_id,$user_id,'PINDAH MEJA',"MEJA BARU :".$table_name."(".$table.")");
			}
			$this->session->set_flashdata('message_success','Pindah Meja Berhasil.');
			redirect('transaction/edit/'.$transaction_code);
		}
		else
		{
			redirect('account/login');
		}
	}

	function update($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord']		= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);

				$data['content']		= 'transaction_update_success';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Edit Transaksi';

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

	function revoke($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord']		= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '5')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/revoke';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Pembatalan Transaksi';

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

	function edit_tanggal_reservasi(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$dari=$_POST['dari'];
			$sampai=$_POST['sampai'];
			$reservation_id=$_POST['reservation_id'];

			$this->transaction_model->edit_tanggal_reservasi($dari,$sampai,$reservation_id);
		}else{
			redirect('account/login');
		}
	}

	function edit_reservation_photo(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$reservation_photo_id=$_POST['id'];
			$reservation_photo_request=$_POST['detail_photo_request'];
			$reservation_photo_price=$_POST['detail_photo_price'];

			$this->transaction_model->edit_photo_reservasi($reservation_photo_id,$reservation_photo_request,$reservation_photo_price);
		}else{
			redirect('account/login');
		}
	}

	function edit_reservation_beauty(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$reservation_beauty_id=$_POST['id'];
			$reservation_beauty_request=$_POST['detail_beauty_request'];
			$reservation_beauty_price=$_POST['detail_beauty_price'];

			$this->transaction_model->edit_beauty_reservasi($reservation_beauty_id,$reservation_beauty_request,$reservation_beauty_price);
		}else{
			redirect('account/login');
		}
	}

	function edit_reservation_dekor(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$reservation_decor_id=$_POST['id'];
			$reservation_decor_request=$_POST['detail_decor_request'];
			$reservation_decor_price=$_POST['detail_decor_price'];

			$this->transaction_model->edit_decor_reservasi($reservation_decor_id,$reservation_decor_request,$reservation_decor_price);
		}else{
			redirect('account/login');
		}
	}

	function revoke_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$user_id	= $this->session->userdata('user_id');
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '5')
			{
				$transaction_code	= $this->input->post('transaction_code');

				$this->form_validation->set_rules('note','Alasan Pembatalan', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					redirect('transaction/revoke/'.$transaction_code);
				}
				else
				{
					$note	= $this->input->post('note');
					$orders	= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
					foreach($orders as $order)
					{
						$this->transaction_model->update_order_canceled($order->order_id);
					}
					$this->transaction_model->revoke_transaction($transaction_code,$user_id,$note);

					$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
					foreach($table_olds as $table_old)
					{
						$table_old_id	= $table_old->table_id;
					}
					$this->order_model->set_unlock_table($table_old_id);

					$this->session->set_flashdata('message_error','Pembatalan Transaksi Berhasil dilakukan.');
					redirect('transaction');
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

	function revoke_order($transaction_code,$order_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord']		= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '5')
			{
				$data['transaction_code']	= $transaction_code;
				$data['order_id']			= $order_id;

				$data['content']		= 'transaction/revoke_order';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Pembatalan Pesanan';

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

	function revoke_order_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$user_id	= $this->session->userdata('user_id');
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '5')
			{
				$transaction_code		= $this->input->post('transaction_code');
				$order_id				= $this->input->post('order_id');
                $note				= $this->input->post('note');

				$orders	= $this->transaction_model->get_orders_by_order_id($order_id);
				foreach($orders as $order)
				{
					$qty	= $order->qty;
				}
				if($qty = 1)
				{
					$this->transaction_model->update_order_canceled($order->order_id);
				}
				$this->transaction_model->revoke_order($transaction_code,$order_id,$user_id);

                $this->transaction_model->history_batal_order($order_id,$user_id,'BATAL ORDER',$note);

				$this->session->set_flashdata('message_error','Pembatalan Order No. '.$order_id.' Berhasil dilakukan.');
				redirect('transaction/edit/' . $transaction_code);
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

	function detail($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '15' or $group_id == '17' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);

                $data['dp'] = $this->transaction_model->select_dptid($transaction_code);
               // $data['dpdetail'] = $this->transaction_model->select_dp_detail_id($id);

				$data['content']		= 'transaction/detail';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Detail Transaksi';

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

	function closure_bill($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/closure_bill';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Cetak Tagihan';

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

	function closure_bill_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transaction_code		= $this->input->post('transaction_code');
				$customer_id		    = $this->input->post('customer_id');
				$this->transaction_model->closure_bill($transaction_code,$customer_id);

				$this->closure_bill_receipt($transaction_code);
				redirect('transaction/closure_bill/' . $transaction_code);
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

	function closure_bill_receipt($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				/* $data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);

				$this->load->view('transaction/closure_bill_receipt',$data); */

				try {
					  $this->receipt->print_receipt($transaction_code);
					}
				catch (Exception $e) {
					  log_message("error", "Error: Could not print. Message ".$e->getMessage());
					  $this->receipt->close_after_exception();
					}
				//redirect('transaction/closure_bill/' . $transaction_code);
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

	function payment($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/payment';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Pembayaran Tagihan';

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

	function payment_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transaction_code 	= $this->input->post('transaction_code');
				$payment_method		= $this->input->post('payment_method');
				$customer_id		= $this->input->post('customer_id');

				$customerrecord	= $this->customer_model->get_customer_by_customer_id($customer_id);
				$data['customerrecord'] = $customerrecord;

				$data['transactionrecord'] 	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord'] 		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
                $dp=$this->transaction_model->rpdp($transaction_code);
                $rpdp=0;
                foreach($dp AS $ddp)
					{
					   $rpdp=$ddp->$rpdp;
					   }
                $data['rpdp']               = $rpdp;
                //($id)

				$data['title']			= 'Pembayaran';

				if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
				{
					$discount_manual	= $this->input->post('discount_manual');
					if($discount_manual == TRUE)
					{
						$data['discount_manual']= $this->input->post('discount_manual');
					}
				}
				$this->session->set_userdata('payment_method',$payment_method);
				if($payment_method == 'cash')
				{
					$data['content']			= 'transaction/payment_cash';
					$data['sub_title']			= 'Pembayaran Tunai';
					$data['payment_method']		=  $payment_method;
					//$payment_method
				}
				elseif ($payment_method == 'cc')
				{
					$data['issuerbankrecord'] 	= $this->transaction_model->get_issuer_bank();
					$data['content']			= 'transaction/payment_cc';
					$data['sub_title']			= 'Pembayaran dengan Kartu Kredit';
					$data['customer_id']		=$customer_id;
					$data['payment_method']		=  $payment_method;
				}
				elseif ($payment_method == 'cashcc'){
					$data['issuerbankrecord'] 	= $this->transaction_model->get_issuer_bank();
					$data['content']			= 'transaction/payment_cashcc';
					$data['sub_title']			= 'Pembayaran dengan Tunai dan Kartu Kredit/Debit';
					$data['customer_id']		=$customer_id;
					$data['payment_method']		=  $payment_method;
				}
				elseif ($payment_method == 'saldo')
				{
					$data['content']			= 'transaction/payment_saldo';
					$data['sub_title']			= 'Pembayaran dengan Saldo';
					$data['customer_id']		= $customer_id;
					$data['payment_method']		=  $payment_method;
				}

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

	function payment_submit()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$user_id 	= $this->session->userdata('user_id');
			$this->setting_model->index();

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transaction_code	= $this->input->post('transaction_code');
				$payment_method		= $this->input->post('payment_method');
				$grand_total		= $this->input->post('grand_total');
				$customer_id		= $this->input->post('customer_id');
                $discount_customer =$this->input->post('discount_customer');
                //$rpdp =$this->input->post('rpdp');

				$discount_type		= 'normal';
				$discount_value		= $discount_customer;
                $remittance		= str_replace(".","",$this->input->post('remittance'));

				if($payment_method == 'cash')
				{


					if ($remittance < $grand_total)
					{
						$this->session->set_flashdata('message_error','Pembayaran Tunai Gagal! Uang Pembayaran masih kurang. Silakan Coba Kembali.');
						redirect('transaction/detail/'.$transaction_code);
					}
					elseif($remittance > $grand_total)
					{
						$refund = $remittance - $grand_total;
					}
					else
					{
						$refund = '0';
					}

					$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
					foreach($table_olds as $table_old)
					{
						$table_old_id	= $table_old->table_id;
					}
					$this->db->trans_start();
					$this->order_model->set_unlock_table($table_old_id);

					$this->transaction_model->payment_cash($user_id,$transaction_code,$grand_total,$remittance,$refund,$discount_type,$discount_value,$customer_id);

					$products	= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
					foreach($products AS $product)
					{
						$product_id	= $product->product_id;
					}

					$subtotal = 0;
					$finance_accounts	= $this->custom_model->get_finance_account_daily_by_product_id($product_id);
					foreach($finance_accounts AS $financeaccount)
					{
						$finance_account_id	= $financeaccount->finance_account_id;
						$amount				= $financeaccount->amount;
						$subtotal			+= $amount;

						$data_finance	= array(
										'finance_account_saldo'	=> $subtotal
										);
						$this->custom_model->update_finance_account_saldo_by_finance_account_id($finance_account_id,$data_finance);
						$this->db->trans_complete();
					}

					if($refund > '0')
					{
						$this->session->set_flashdata('message_success','Pembayaran Transaksi No. '.$transaction_code.' secara Tunai Berhasil! Kembalian Anda adalah sebesar Rp. ' . number_format($refund,0,',','.'));
					}
					else
					{
						$this->session->set_flashdata('message_success','Pembayaran Transaksi No. '.$transaction_code.' secara Tunai Berhasil!');
					}

					$data	=	array(
							'transaction_code'		=> $transaction_code,
							'company_name'			=> $this->session->userdata('company_name'),
							'company_address'		=> $this->session->userdata('company_address'),
							'company_telp'			=> $this->session->userdata('company_telp'),
							'company_email'			=> $this->session->userdata('company_email'),
							'company_logo'			=> $this->session->userdata('company_logo'),
							'tax_fare'				=> $this->session->userdata('tax_fare'),
							'service_fare'			=> $this->session->userdata('service_fare'),
							'receipt_header'		=> $this->session->userdata('receipt_header'),
							'receipt_footer'		=> $this->session->userdata('receipt_footer'),
							'receipt_promo'			=> $this->session->userdata('receipt_promo'),
							'receipt_print_format'			=> $this->session->userdata('receipt_print_format'),
							'receipt_max_print'		=> $this->session->userdata('receipt_max_print'),
							);

					//$this->transaction_model->create_transaction_setting($data);

					$this->session->set_flashdata('transaction_code',$transaction_code);
					try {
					  $this->receipt->print_receipt($transaction_code);
					  $this->receipt->print_receipt($transaction_code);
					}
				catch (Exception $e) {
					  log_message("error", "Error: Could not print. Message ".$e->getMessage());
					  $this->receipt->close_after_exception();
					}
					redirect('transaction');
				}
				elseif($payment_method == 'cashcc'){

					$cc_trx_no		= $this->input->post('cc_trx_no');
					$issuer_id		= $this->input->post('issuer_id');
					$no_cc			= $this->input->post('no_cc');
					$rptunai			= $this->input->post('rptunai');
					$rpnontunai			= $this->input->post('rpnontunai');
					$jcc			= $this->input->post('jcc');
					$pcc			= $this->input->post('pcc');

					if($cc_trx_no == FALSE OR $issuer_id == FALSE OR $no_cc == FALSE OR $jcc == FALSE OR $pcc == FALSE OR $rptunai == FALSE OR $rpnontunai == FALSE)
					{
						$this->session->set_flashdata('message_error','Penerbit dan Nomor Kartu Kredit/Debit harus diisi.');
						redirect('transaction/detail/'.$transaction_code);
					}
					else
					{
						$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
						foreach($table_olds as $table_old)
						{
							$table_old_id	= $table_old->table_id;
						}
						$this->db->trans_start();
						$this->order_model->set_unlock_table($table_old_id);
						$remitance=$rptunai+$rpnontunai;
                        $refund=$remitance-$grand_total;
						$this->transaction_model->payment_cashcc($user_id,$transaction_code,$grand_total,$cc_trx_no,$issuer_id,$discount_type,$discount_value,$customer_id,$no_cc,$rptunai,$rpnontunai,$jcc,$pcc,$remitance,$refund);
						$this->db->trans_complete();
						$data	=	array(
							'transaction_code'		=> $transaction_code,
							'company_name'			=> $this->session->userdata('company_name'),
							'company_address'		=> $this->session->userdata('company_address'),
							'company_telp'			=> $this->session->userdata('company_telp'),
							'company_email'			=> $this->session->userdata('company_email'),
							'company_logo'			=> $this->session->userdata('company_logo'),
							'tax_fare'				=> $this->session->userdata('tax_fare'),
							'service_fare'			=> $this->session->userdata('service_fare'),
							'receipt_header'		=> $this->session->userdata('receipt_header'),
							'receipt_footer'		=> $this->session->userdata('receipt_footer'),
							'receipt_promo'			=> $this->session->userdata('receipt_promo'),
							'receipt_max_print'		=> $this->session->userdata('receipt_max_print'),
							);

						//$this->transaction_model->create_transaction_setting($data);

						$this->session->set_flashdata('message_success','Pembayaran Transaksi No. '.$transaction_code.' dengan Kartu Kredit/Debit Berhasil!');
						$this->session->set_flashdata('transaction_code',$transaction_code);
						try {
					  $this->receipt->print_receipt($transaction_code);
					  $this->receipt->print_receipt($transaction_code);
						}
					catch (Exception $e) {
						  log_message("error", "Error: Could not print. Message ".$e->getMessage());
						  $this->receipt->close_after_exception();
						}
						redirect('transaction');
					}

				}
				elseif($payment_method == 'cc')
				{
					$cc_trx_no		= $this->input->post('cc_trx_no');
					$issuer_id		= $this->input->post('issuer_id');
					$no_cc			= $this->input->post('no_cc');
					$jcc			= $this->input->post('jcc');
					$pcc			= $this->input->post('pcc');

					if($cc_trx_no == FALSE OR $issuer_id == FALSE OR $no_cc == FALSE OR $jcc == FALSE OR $pcc == FALSE)
					{
						$this->session->set_flashdata('message_error','Penerbit dan Nomor Kartu Kredit/Debit harus diisi.');
						redirect('transaction/detail/'.$transaction_code);
					}
					else
					{
						$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
						foreach($table_olds as $table_old)
						{
							$table_old_id	= $table_old->table_id;
						}
						$this->db->trans_start();
						$this->order_model->set_unlock_table($table_old_id);

						$this->transaction_model->payment_cc($user_id,$transaction_code,$grand_total,$cc_trx_no,$issuer_id,$discount_type,$discount_value,$customer_id,$no_cc,$jcc,$pcc);
						$this->db->trans_complete();

						$data	=	array(
							'transaction_code'		=> $transaction_code,
							'company_name'			=> $this->session->userdata('company_name'),
							'company_address'		=> $this->session->userdata('company_address'),
							'company_telp'			=> $this->session->userdata('company_telp'),
							'company_email'			=> $this->session->userdata('company_email'),
							'company_logo'			=> $this->session->userdata('company_logo'),
							'tax_fare'				=> $this->session->userdata('tax_fare'),
							'service_fare'			=> $this->session->userdata('service_fare'),
							'receipt_header'		=> $this->session->userdata('receipt_header'),
							'receipt_footer'		=> $this->session->userdata('receipt_footer'),
							'receipt_promo'			=> $this->session->userdata('receipt_promo'),
							'receipt_max_print'		=> $this->session->userdata('receipt_max_print'),
							);

						//$this->transaction_model->create_transaction_setting($data);

						$this->session->set_flashdata('message_success','Pembayaran Transaksi No. '.$transaction_code.' dengan Kartu Kredit/Debit Berhasil!');
						$this->session->set_flashdata('transaction_code',$transaction_code);
						try {
					  $this->receipt->print_receipt($transaction_code);
					  $this->receipt->print_receipt($transaction_code);
						}
					catch (Exception $e) {
						  log_message("error", "Error: Could not print. Message ".$e->getMessage());
						  $this->receipt->close_after_exception();
						}
						redirect('transaction');
					}
				}
				elseif($payment_method == 'saldo')
				{
					$saldo	= $this->input->post('saldo');

					if($saldo < $grand_total)
					{
						$this->session->set_flashdata('message_error','Pembayaran Gagal! Saldo tidak mencukupi. Silakan Coba Kembali.');
						redirect('transaction');
					}
					if($saldo > $grand_total)
					{
						$saldo_new = $saldo - $grand_total;
					}

					$this->customer_model->saldo_update($customer_id,$saldo_new);

					$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
					foreach($table_olds as $table_old)
					{
						$table_old_id	= $table_old->table_id;
					}
					$this->db->trans_start();
					$this->order_model->set_unlock_table($table_old_id);

					$this->transaction_model->payment_saldo($user_id,$transaction_code,$grand_total,$customer_id,$discount_value);

					$this->session->set_flashdata('message_success','Pembayaran Transaksi No. '.$transaction_code.' secara Tunai Berhasil!');
					$this->db->trans_complete();
					$data	=	array(
							'transaction_code'		=> $transaction_code,
							'company_name'			=> $this->session->userdata('company_name'),
							'company_address'		=> $this->session->userdata('company_address'),
							'company_telp'			=> $this->session->userdata('company_telp'),
							'company_email'			=> $this->session->userdata('company_email'),
							'company_logo'			=> $this->session->userdata('company_logo'),
							'tax_fare'				=> $this->session->userdata('tax_fare'),
							'service_fare'			=> $this->session->userdata('service_fare'),
							'receipt_header'		=> $this->session->userdata('receipt_header'),
							'receipt_footer'		=> $this->session->userdata('receipt_footer'),
							'receipt_promo'			=> $this->session->userdata('receipt_promo'),
							'receipt_max_print'		=> $this->session->userdata('receipt_max_print'),
							);

					//$this->transaction_model->create_transaction_setting($data);

					$this->session->set_flashdata('transaction_code',$transaction_code);

					try {
					  $this->receipt->print_receipt($transaction_code);
					  $this->receipt->print_receipt($transaction_code);
						}
					catch (Exception $e) {
						  log_message("error", "Error: Could not print. Message ".$e->getMessage());
						  $this->receipt->close_after_exception();
						}

					redirect('transaction');
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
		else
		{
			redirect('account/login');
		}
	}

	function receipt($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transactionrecord 	= $this->transaction_model->get_transaction_detail_by_transaction_code($transaction_code);
				foreach($transactionrecord as $trx)
				{
					$receipt_count_print	= $trx->receipt_count_print;
				}
				if($this->session->userdata('receipt_max_print') == '0' OR $receipt_count_print < $this->session->userdata('receipt_max_print'))
				{
					/* $data['transactionrecord'] 	= $transactionrecord;
					$data['ordersrecord'] 		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
					$data['issuerbankrecord'] 	= $this->transaction_model->get_issuer_bank();

					$this->transaction_model->update_count_print($transaction_code);

					$this->load->view('transaction/receipt',$data); */

					try {
						//var_dump($transaction_code);
						//exit();
					  $this->receipt->print_receipt($transaction_code);
					} catch (Exception $e) {
					  log_message("error", "Error: Could not print. Message ".$e->getMessage());
					  $this->receipt->close_after_exception();
					}
					redirect('transaction/detail/' . $transaction_code);
				}
				else
				{
					redirect('transaction');
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

	function unlock_table($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/unlock_table';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Buka Meja';

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

	function unlock_table_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transaction_code	= $this->input->post('transaction_code');

				$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
				foreach($table_olds as $table_old)
				{
					$table_old_id	= $table_old->table_id;
				}
				$this->order_model->set_unlock_table($table_old_id);

				$user_id		= $this->session->userdata('user_id');
				$note			= $this->input->post('note');
				$table_list_id	= $table_old_id;

				$data	= array
							(
							'table_event_created_time'	=> date('Y-m-d H:i:s',now()),
							'table_event_created_by'	=> $user_id,
							'table_event_table_list_id'	=> $table_list_id,
							'table_event_status'		=> 'unlock',
							'table_event_note'			=> $note
							);

				$this->transaction_model->set_table_event_unlock($data);

				redirect('transaction');
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

	function lock_table($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/lock_table';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Kunci Meja';

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

	function lock_table_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transaction_code	= $this->input->post('transaction_code');

				$table_olds		= $this->order_model->get_table_by_transaction_code($transaction_code);
				foreach($table_olds as $table_old)
				{
					$table_old_id	= $table_old->table_id;
				}
				$this->order_model->set_lock_table($table_old_id);

				$user_id		= $this->session->userdata('user_id');
				$note			= $this->input->post('note');
				$table_list_id	= $table_old_id;

				$data	= array
							(
							'table_event_created_time'	=> date('Y-m-d H:i:s',now()),
							'table_event_created_by'	=> $user_id,
							'table_event_table_list_id'	=> $table_list_id,
							'table_event_status'		=> 'lock',
							'table_event_note'			=> $note
							);

				$this->transaction_model->set_table_event_lock($data);

				redirect('transaction');
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

	function split_bill($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord']		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/split_bill';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Split Bill';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function split_bill_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$transaction_code	= $this->input->post('transaction_code');
				$order_id			= $this->input->post('order_id');

				if($order_id  == TRUE)
				{
					$this->session->set_flashdata('message_success','Split Bill berhasil.');
					$this->transaction_model->split_bill($transaction_code);
				}
				else
				{
					$this->session->set_flashdata('message_error','Split Bill gagal, Item belum dipilih.');
					redirect('transaction/split_bill/' . $transaction_code);
				}
				redirect('transaction/detail/' . $transaction_code);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function combine_bill($transaction_code,$table_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);

				$data['content']		= 'transaction/combine_bill';
				$data['title']			= 'Transaksi';
				$data['sub_title']		= 'Gabung Bill';
				$data['tc']				=$transaction_code;
				$data['tid']			=$table_id;
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function combine_bill_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6')
			{
			     $user_id		= $this->session->userdata('user_id');
				$old_transaction_code	= $this->input->post('old_transaction_code');
				$transaction_code		= $this->input->post('transaction_code');
				$tid					= $this->input->post('tid');

				$this->session->set_flashdata('message_success','Gabung Bill berhasil.');

                $loid=$this->transaction_model->select_orderid($old_transaction_code);
                foreach($loid AS $dloid)
				{
                $this->transaction_model->history_batal_order($dloid->order_id,$user_id,'GABUNG BILL',"KODE TRANSAKSI : ".$old_transaction_code." DIGABUNG : ".$transaction_code);
                }

				$this->transaction_model->combine_bill($old_transaction_code,$transaction_code,$tid);




				redirect('transaction/detail/' . $transaction_code);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

}

/* End of file transaction.php */
/* Location: ./application/controllers/transaction.php */
