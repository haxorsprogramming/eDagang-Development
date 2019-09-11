<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}

	public function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			// Jika yang login adalah divisi Kafe
			if($this->session->userdata('division') == 1)
			{
				$this->input_table();
			}
			// Jika yang login adalah divisi Studio atau Beauty Salon
			elseif ($this->session->userdata('division') == (2 OR 3))
			{
				$this->input_customer();
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

	function input_table()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			if($this->session->userdata('table') == FALSE || $this->session->userdata('customer_id') == FALSE || $this->session->userdata('visitor') == FALSE || $this->session->userdata('remark_table') == FALSE)
			{
				$this->session->unset_userdata('table_id');
				$this->session->unset_userdata('table');
				$this->session->unset_userdata('order_status');
				$this->session->unset_userdata('customer_id');
				$this->session->unset_userdata('visitor');
				$this->session->unset_userdata('remark_table');

				$data['title']			= 'Order';

				$input_table_type	= $this->session->userdata('input_table_type');

				if($input_table_type == 1)
				{
					$data['content']		= 'order/input_table';
					$data['sub_title']		= 'Input Meja';
				}
				elseif($input_table_type == 2)
				{
					$data['tableunlock']	= $this->order_model->get_table_list();
					$data['content']		= 'order/select_table';
					$data['sub_title']		= 'Pilih Meja';
				}
				elseif($input_table_type == 3)
				{
					$data['tablecategory']	= $this->order_model->get_table_category();
					$data['tableunlock']	= $this->order_model->get_table_list();
					$data['content']		= 'order/block_table';
					$data['sub_title']		= 'Pilih Meja';
				}
				$this->load->view('template',$data);
			}
			else
			{
				redirect('order/select_menu');
				//redirect('order/select_food');
			}
		}
		elseif($this->session->userdata('table') == TRUE)
		{

		}
		else
		{
			redirect('account/login');
		}
	}

	function input_detail_table($table_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$tableavailable	= $this->order_model->get_table_unlock_by_table_id($table_id);

			if($tableavailable == TRUE)
			{
				//$this->session->set_userdata('table',$table);
				$this->session->set_userdata('table_id',$table_id);

				$data['content']		= 'order/input_detail_table';
				$data['sub_title']		= 'Input Detail';

				$this->load->view('template',$data);
			}
			else
			{
				redirect('order/input_table');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

		function modalava()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$data="";
				$this->load->view('order/modalava',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	function all_reservation_list(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
				$data['reservasi']=$this->transaction_model->load_data_reservasi();
				$this->load->view('order/list_reservasi',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	function customer_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$p=$this->input->post('p');
			if($p=='daftar'){
			$nama=$this->input->post('resname');
			$hp=$this->input->post('reshp');
			$wa=$this->input->post('reswa');
			$email=$this->input->post('resemail');
			$pax=$this->input->post('rpax');
			$makanan=$this->input->post('makanan');
			$ruang=$this->input->post('ruang');
			$customer_group=$this->input->post('customer_group');
			$created_time=date('Y-m-d H:i:s',now());
			$layout=$this->input->post('layout');
			$waktudari=$this->input->post('waktudari');
			$waktusampai=$this->input->post('waktusampai');
			$uang_muka=$this->input->post('uang_muka');
			$data_form = array(
												 'customer_full_name' => $nama,
		 										 'customer_email'=> $email,
											 	 'customer_group_id'=> $customer_group,
											 	 'customer_wa'=> $wa,
											 	 'customer_hp'=> $hp,
											 	 'created_time'=>$created_time,
											 );
			$this->customer_model->create($data_form);
			$cs = $this->customer_model->get_customer_by_fullname($nama);
			foreach ($cs as $key => $cd) {
				$customer_id = $cd->customer_id;
			}
			$customer = array('customer_id'=>$customer_id,'nama' => $nama, 'hp'=>$hp, 'wa'=>$wa, 'email'=>$email, 'pax'=>$pax,'penyajian'=>$makanan,'table_category_id'=>$ruang,'waktu_dari'=> $waktudari,'waktu_sampai'=>$waktusampai,'uang_muka'=>$uang_muka,'layout'=>$layout);
		}if($p=='select'){
			$customer_id=$this->input->post('customer_id');
			$pax=$this->input->post('rpax');
			$makanan=$this->input->post('makanan');
			$ruang=$this->input->post('ruang');
			$waktudari=$this->input->post('waktudari');
			$waktusampai=$this->input->post('waktusampai');
			$uang_muka=$this->input->post('uang_muka');
			$layout=$this->input->post('layout');
			$cs = $this->customer_model->get_customer_by_customer_id($customer_id);
			foreach ($cs as $cd) {
				$nama = $cd->customer_full_name;
			}
			$customer = array('customer_id'=>$customer_id,'nama'=>$nama,'pax'=>$pax,'penyajian'=>$makanan,'table_category_id'=>$ruang,'waktu_dari'=> $waktudari,'waktu_sampai'=>$waktusampai,'uang_muka'=>$uang_muka,'layout'=>$layout);
		}
			$this->session->set_userdata($customer);
			redirect('order/select_menu');
		}
		else
		{
			redirect('account/login');
		}
	}

	function reservation(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$this->session->set_userdata('reservation','reservation');
			$this->session->set_flashdata('success','<div class="alert alert-info">Status Pemesanan Reservasi, silahkan masukkan detail Reservasi</div>');
			$data['tablecategory']	= $this->order_model->get_table_category();
			$data['content']		= 'order/reservasi';
			$data['title']			= 'Reservasi';
			$data['sub_title']		= 'Reservasi';
			$this->load->view('template',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

		function subkat($pci,$div)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$data['subcategoryrecord']		= $this->product_model->categorydefault($pci,$div);
			$this->load->view('order/subkat',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

			function subkatkat($cid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$data['subcategoryrecord']		= $this->product_model->get_product_by_category_id($cid);
			$this->load->view('order/subkatkat',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	function select_menu()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			if($this->session->userdata('reservation')){
				$customer_id = $this->session->userdata('customer_id');
				$order_status 	= $this->session->userdata('reservation');
				$visitor 		= $this->session->userdata('pax');
			}else{
			$customer_id 	= $this->input->post('customer_id');
			$order_status 	= $this->input->post('order_status');
			$visitor 		= $this->input->post('visitor');
			}
			$remark_table 	= $this->input->post('remark_table');
			if($visitor == TRUE)
			{
				$this->session->set_userdata('order_status',$order_status);
				$this->session->set_userdata('customer_id',$customer_id);
				$this->session->set_userdata('visitor',$visitor);
				$this->session->set_userdata('remark_table',$remark_table);
			}
			if($this->session->userdata('reservation'))
			{
				$table = $this->session->userdata('table_category_id');
				$this->session->set_userdata('table_id',$table);
			}
			if($this->session->userdata('table_id') == FALSE)
			{
				redirect('order/input_table');
			}
			else
			{
				if($this->session->userdata('template_waiter') == '1')
				{
					$data['menurecord']			= $this->product_model->get_sub_category();
				}
				elseif($this->session->userdata('template_waiter') == '2')
				{
					$data['subcategoryrecord'] 	= $this->product_model->categorydefault('1','1');
					$data['category0'] 			= $this->product_model->category0();
				}
				$data['content']		= 'order/select_menu';
				$data['title']			= 'Order';
				$data['sub_title']		= 'Pilih Menu';
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$product_id		= $this->input->post('product_id');
			$products	= $this->product_model->cekstok($product_id	);
			foreach($products as $p)
			{
				if($p->material_stock==0)
				{
					echo "Out of Stock";
				}
				else
				{
					$qty			= $this->input->post('qty');
					$remark			= $this->input->post('remark');
					$rowid	= "";
					$id		= "";
					$jlh	= "";
					foreach($this->cart->contents() AS $items) :
							$rowid	= $items['rowid'];
							$id		= $items['id'];
							$jlh	= $items['qty'];
					endforeach;
					if($product_id == $id)
					{
						$data = array(
								   'rowid' => $rowid,
								   'qty'   => $jlh + $qty
									);
						$this->cart->update($data);
					}
					else
					{
						$products = $this->product_model->find($product_id);
						foreach($products as $product)
						{
							$data_form = array(
									   'id' 		=> $product_id,
									   'qty'     	=> $qty,
									   'price'   	=> '10',
									   'name'    	=> $product->product_name,
									   'options' 	=> array('remark'=>$remark)
									);
						}
						$this->cart->insert($data_form);
					}
					// Hapus saja, redirect ini tidak berguna jika sudah pakai AJAX
					//redirect('order/select_menu');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function remove_from_cartno()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $_POST['rowid'],
					   'qty'   => "0"
						);
			$k=$this->cart->update($data);
			// Duplicate call from method reviewkat()
			//$this->load->view('order/reviewkat');
		}
		else
		{
			redirect('account/login');
		}
	}

	function remove_from_cart($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => "0"
						);
			$this->cart->update($data);
			redirect('order/review');
		}
		else
		{
			redirect('account/login');
		}
	}


	function review()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			if($this->session->userdata('table_id') == TRUE)
			{
				$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$data['content']		= 'order/review';
				$data['title']			= 'Order';
				$data['sub_title']		= 'Pesanan Sementara';
				$this->load->view('template',$data);
			}
			else
			{
				redirect('order/input_table');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function reviewkat()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$this->load->view('order/reviewkat',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	public function submit()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			if ($this->cart->total_items() == FALSE)
			{
				$this->session->set_flashdata('message','Proses Order Gagal, Silakan coba kembali');
				redirect('order/review');
			}
			else
			{
				$is_processed = $this->order_model->process();
				if($is_processed)
				{
					$res_id=$this->order_model->get_latest_reservation_id();
					$code='';
					foreach($res_id as $row){
						$code = $row->reservation_id;
					}
					$req_code_beauty='KPWHB'.($code+1);
					$req_code_music='KPWHM'.($code+1);
					$req_code_decor='KPWHD'.($code+1);
					$req_code_photo='KPWHPO'.($code+1);
					$customer_id = $this->session->userdata('customer_id');
					$layout = $this->session->userdata('layout');
                    $reservation_proses=$this->order_model->create_reservation($customer_id,$req_code_beauty,$req_code_music,$req_code_decor,$req_code_photo,$layout);
					if(isset($_POST['detail_music'])){
						$detail_music=$this->input->post('detail_music');
						$detail_harga_music=$this->input->post('detail_harga_music');
						$this->order_model->create_request_music($req_code_music,$detail_music,$detail_harga_music);
					}
					$trb=$this->input->post('totalb');
					$trd=$this->input->post('totalde');
					$trp=$this->input->post('totalpo');
                    if($trb!=0){
                        $this->order_model->create_request_beauty($trb,$req_code_beauty);
                    }if($trd!=0){
                        $this->order_model->create_request_dekor($trd,$req_code_decor);
                    }if($trp!=0){
                        $this->order_model->create_request_photo($trp,$req_code_photo);
                    }
					if($this->session->userdata('order_status') == 'on_the_spot')
					{
						$this->order_model->set_lock_table($this->session->userdata('table_id'));
					}
					$this->cart->destroy();
					$jmlh_photo=$this->session->userdata('j');
					$jmlh_beauty=$this->session->userdata('d');
					$jmlh_dekor=$this->session->userdata('de');
					for($i=0;$i<=$jmlh_photo;$i++){
						$data[$i] = array(
							'rpr'.$i => '',
							'rpp'.$i => '');
						$this->session->unset_userdata($data[$i]);
					}
					for($s=0;$s<=$jmlh_beauty;$s++){
						$data[$s] = array(
							'rbr'.$s => '',
							'rbp'.$s => '');
						$this->session->unset_userdata($data[$s]);
					}
					for($d=0;$d<=$jmlh_dekor;$d++){
						$data[$d] = array(
							'rdr'.$d => '',
							'rdp'.$d => '');
						$this->session->unset_userdata($data[$d]);
					}
					$session_data	= array(
						'j' => '',
						'd' => '',
						'de' => '',
						'table'						=> '',
						'table_id'					=> '',
						'order_status'				=> '',
						'customer_id'				=> '',
						'visitor'					=> '',
						'remark_table'				=> '',
						'transaction_code'			=> '',
						'reqphoto'=>'',
						'reqbeauty'=>'',
						'reqmusic'=>'',
						'reqdekor'=>'',
						'reservation'=>'',
						'layout'=>''
					);
					$this->session->unset_userdata($session_data);
					$this->session->set_flashdata('message_success','Transaksi telah berhasil!');
					redirect('order/success');
				}
				else
				{
					$this->session->set_flashdata('message_error','Proses Order Gagal, Silakan coba kembali');
					redirect('order/review');
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function delete_photo_request(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$id_photo = $_POST['id'];
			$this->order_model->delete_photo_request($id_photo);
		}else{
			redirect('account/login');
		}
	}

	function delete_music_request(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$id_music = $_POST['id'];
			$this->order_model->delete_music_request($id_music);
		}else{
			redirect('account/login');
		}
	}

	function delete_dekor_request(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$id_dekor = $_POST['id'];
			$this->order_model->delete_dekor_request($id_dekor);
		}else{
			redirect('account/login');
		}
	}

	function delete_beauty_request(){
		if ($this->session->userdata('is_logged_in') == TRUE){
			$id_beauty = $_POST['id'];
			$this->order_model->delete_beauty_request($id_beauty);
		}else{
			redirect('account/login');
		}
	}

	function success()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$data['content']		= 'order/success';
			$data['title']			= 'Order';
			$data['sub_title']		= 'Konfirmasi Sukses';

			$this->load->view('template',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	function history()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$data['historyrecord'] = $this->order_model->get_history();
			$data['content']		= 'order/history';
			$data['title']			= 'Order';
			$data['sub_title']		= 'Histori Pesanan';
			$this->load->view('template',$data);
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
			$data['userrecord'] 		= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
			$data['ordersrecord'] 		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
			$data['content']		= 'order/detail';
			$data['title']			= 'Order';
			$data['sub_title']		= 'Detail Pesanan';
			$this->load->view('template',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

	function edit($transaction_code)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id = $this->session->userdata('group_id');
			if($group_id == '6')
			{
				$data['transactionrecord']	= $this->transaction_model->get_transaction_by_transaction_code($transaction_code);
				$data['ordersrecord'] 		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
				$data['tableavailable']		= $this->order_model->get_table_available();
				$data['content']		= 'order/edit';
				$data['title']			= 'Order';
				$data['sub_title']		= 'Edit Pesanan';
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

	function dekor_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->load->view('order/dekor_request');
			if(isset($_POST['proses'])){
				$totalde = $this->input->post('totalde');
				$this->session->set_userdata('reqdekor','reqdekor');
				if($this->session->userdata('de')){
				$i=$this->session->userdata('de');
				}else{
				$i=1;
				}
			for($i;$i<=$totalde;$i++){
				$rdr=$this->input->post('rdr'.$i);
				$rdp=$this->input->post('rdp'.$i);
				$this->session->set_userdata('rdr'.$i,$rdr);
				$this->session->set_userdata('rdp'.$i,$rdp);
				$a++;
					}
				$this->session->set_userdata('de',$i);
				redirect('order/select_menu');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function unset_dekor_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$i=$_POST['id'];
			$this->session->unset_userdata('rdr'.$i);
			$this->session->unset_userdata('rdp'.$i);
			redirect('order/select_menu');
		}
		else
		{
			redirect('account/login');
		}
	}

	function music_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->load->view('order/music_request');
			if(isset($_POST['proses'])){
			$this->session->set_userdata('reqmusic','reqpmusic');
			$rmr=$this->input->post('rmr');
			$rmp=$this->input->post('rmp');
			$this->session->set_userdata('rmr',$rmr);
			$this->session->set_userdata('rmp',$rmp);
			redirect('order/select_menu');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function unset_music_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->session->unset_userdata('rmr');
			$this->session->unset_userdata('rmp');
			$this->session->unset('reqmusic');
			redirect('order/select_menu');
		}
		else
		{
			redirect('account/login');
		}
	}

	function photo_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->load->view('order/photo_request');
			if(isset($_POST['proses'])){
				$total = $this->input->post('total');
				$this->session->set_userdata('reqphoto','reqphoto');
				if($this->session->userdata('j')){
				$i=$this->session->userdata('j');
				}else{
				$i=1;
				}
			for($i;$i<=$total;$i++){
				$rpr=$this->input->post('rpr'.$i);
				$rpp=$this->input->post('rpp'.$i);
				$this->session->set_userdata('rpr'.$i,$rpr);
				$this->session->set_userdata('rpp'.$i,$rpp);
			}
				$this->session->set_userdata('j',$i);
				redirect('order/select_menu');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function unset_photo_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$i=$_POST['id'];
			$this->session->unset_userdata('rpr'.$i);
			$this->session->unset_userdata('rpp'.$i);
		}
		else
		{
			redirect('account/login');
		}
	}

	function beauty_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->load->view('order/beauty_request');
			if(isset($_POST['proses'])){
				$totalb = $this->input->post('totalb');
				$this->session->set_userdata('reqbeauty','reqbeauty');
				if($this->session->userdata('d')){
				$i=$this->session->userdata('d');
				}else{
				$i=1;
				}
			for($i;$i<=$totalb;$i++){
				$rbr=$this->input->post('rbr'.$i);
				$rbp=$this->input->post('rbp'.$i);
				$this->session->set_userdata('rbr'.$i,$rbr);
				$this->session->set_userdata('rbp'.$i,$rbp);
				$a++;
			}
			$this->session->set_userdata('d',$i);
			redirect('order/select_menu');
		}

		}
		else
		{
			redirect('account/login');
		}
	}

	function unset_beauty_request(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$i=$_POST['id'];
			$this->session->unset_userdata('rbr'.$i);
			$this->session->unset_userdata('rbp'.$i);
			redirect('order/select_menu');
		}
		else
		{
			redirect('account/login');
		}
	}

	function cancel()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->cart->destroy();
			$this->session->unset_userdata('table');
			if($this->session->userdata('reservation')){
				$this->session->set_flashdata('success','<div class="alert alert-danger">Proses Reservasi Berhasil dibatalkan</div>');
				$this->session->unset_userdata('reservation');
				$this->session->unset_userdata('j');
				$this->session->unset_userdata('d');
				$this->session->unset_userdata('de');
				$this->session->unset_userdata('reqphoto');
				$this->session->unset_userdata('reqmusic');
				$this->session->unset_userdata('reqdekor');
				$this->session->unset_userdata('reqbeauty');
				$this->session->unset_userdata('status_reservasi');
				$this->session->unset_userdata('table_category_id');
			}
				$this->session->unset_userdata('penyajian');
				$this->session->unset_userdata('table_id');
				$this->session->unset_userdata('order_status');
				$this->session->unset_userdata('customer_id');
				$this->session->unset_userdata('remark_table');
				$this->session->unset_userdata('visitor');
				$this->session->unset_userdata('transaction_code');
				redirect('order');
		}
		else
		{
			redirect('account/login');
		}
	}

	function add_order($transaction_code,$table_id)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$session_data	= array(
								'transaction_code'	=> $transaction_code,
								'table_id'			=> $table_id
								);
			$this->session->set_userdata($session_data);
			redirect('order/select_menu');
		}
		else
		{
			redirect('account/login');
		}
	}

	function add_order_reservation($transaction_code,$table_id,$status,$edit,$waktu)
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$waktu = str_replace("%20"," ",$waktu);
			$session_data	= array(
								'transaction_code'	=> $transaction_code,
								'table_category_id'			=> $table_id,
								'reservation' => $status,
								'status_reservasi' => $edit,
								'waktu_dari' => $waktu
								);
			$this->session->set_userdata($session_data);
			$this->select_menu();
		}
		else
		{
			redirect('account/login');
		}
	}

	function update()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$is_processed = $this->order_model->process();
			if($is_processed)
			{
				foreach($this->cart->contents() AS $item)
				{
					$product_id		= $item['id'];
					$qty			= $item['qty'];
					$this->order_model->update_stock($product_id,$qty);
				}
				$this->cart->destroy();
				$this->session->unset_userdata('table');
				if($this->session->userdata('transaction_code'))
				{
					$this->session->unset_userdata('transaction_code');
				}
				$this->session->set_flashdata('message','Transaksi telah berhasil!');
				redirect('order/success');
			}
			else
			{
				$this->session->set_flashdata('message','Proses Order Gagal, Silakan coba kembali');
				redirect('order/review');
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function input_customer()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			if($this->session->userdata('customer_name') == FALSE OR $this->session->userdata('customer_email') == FALSE OR $this->session->userdata('customer_phone_number') == FALSE)
			{
				$this->session->unset_userdata('customer_name');
				$this->session->unset_userdata('customer_email');
				$this->session->unset_userdata('customer_phone_number');
				$data['title']			= 'Order';
				$data['content']		= 'order/input_customer';
				$data['sub_title']		= 'Input Data Pelanggan';
				$this->load->view('template',$data);
			}
			else
			{
				redirect('order/select_product');
			}
		}
			elseif($this->session->userdata('table') == TRUE)
			{

			}
		else
		{
			redirect('account/login');
		}
	}

	function select_product()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$customer_name 			= $this->input->post('customer_name');
			$customer_email			= $this->input->post('customer_email');
			$customer_phone_number 	= $this->input->post('customer_phone_number');
			if($this->session->userdata('customer_name') == FALSE AND $this->session->userdata('customer_email') == FALSE AND $this->session->userdata('customer_phone_number') == FALSE)
			{
				redirect('order');
			}
			else
			{
				$data['menurecord']			= $this->product_model->get_sub_category();
				$data['subcategoryrecord'] 	= $this->product_model->get_sub_category();
				$data['content']		= 'order/select_product';
				$data['title']			= 'Order';
				$data['sub_title']		= 'Pilih Produk';
				$this->load->view('template',$data);
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
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7')
			{
					$data['transactionrecord'] 	= $this->transaction_model->get_transaction_detail_by_transaction_code($transaction_code);
					$data['ordersrecord'] 		= $this->transaction_model->get_orders_by_transaction_code($transaction_code);
					$this->load->view('order/receipt',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

}

/* End of file order.php */
/* Location: ./application/controllers/order.php */
