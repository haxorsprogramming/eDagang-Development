<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}

        function tmaterial($jen){
        $k="";
        if($jen=='asset'){
            $k="Asset";
        }elseif($jen=='non_stock'){
            $k="Non Produksi";
        }elseif($jen=='stock'){
            $k="Produksi";
        }
        return $k;

    }

	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '18')
			{
				$this->po_list();
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

	public function po_list()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '18')
			{
                
                $start_date	= date('Y-m-01');
				$end_date	= date('Y-m-d');
                
				$data['porecord'] = $this->purchase_model->get_po_list($start_date,$end_date);
				$data['start_date']	= date('d-m-Y');
				$data['end_date']	= date('d-m-Y');
				
				$data['content']		= 'purchase/purchase_order_list';
				$data['title']			= 'Purchase';
				if($group_id == '3'){
					$data['sub_title']		= 'Proses Approval Manager';
				}else{
					$data['sub_title']		= 'Pembelian';
				}

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

		function po_status()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8')
			{
				$jen=$this->uri->segment(3);
				$po_status=$this->uri->segment(4);
				$po_id=$this->uri->segment(5);
				if($po_status==1 and $jen=="manager"){
					$po_status="approved manager";
					$po_detail = $this->purchase_model->get_by_id_general('purchase_order_detail','po_id',$po_id);
					foreach ($po_detail as $key) {
						if($key->purchase_order_status!='rejected'){
							$data_po = array(
								'purchase_order_status' => 'accepted'
							);
							$this->purchase_model->update_general('purchase_order_detail','po_detail_id',$key->po_detail_id,$data_po);
						}
					}
				}elseif($po_status==0 and $jen=="manager"){
					$po_status="reject manager";
					$data_po = array(
						'purchase_order_status' => 'rejected'
					);
					$this->purchase_model->update_general('purchase_order_detail','po_id',$po_id,$data_po);
				}elseif($po_status==1 and $jen=="finance"){
					$po_status="approved finance";
					$po_detail = $this->purchase_model->get_by_id_general('purchase_order_detail','po_id',$po_id);
					foreach ($po_detail as $key) {
						if($key->purchase_order_status!='rejected'){
							$data_po = array(
								'purchase_order_status' => 'accepted'
							);
							$this->purchase_model->update_general('purchase_order_detail','po_detail_id',$key->po_detail_id,$data_po);
						}
					}
				}elseif($po_status==0 and $jen=="finance"){
					$po_status="reject finance";
					$data_po = array(
						'purchase_order_status' => 'rejected'
					);
					$this->purchase_model->update_general('purchase_order_detail','po_id',$po_id,$data_po);
				}
				$user_id_manager=$this->session->userdata('user_id');
				$this->purchase_model->update_po_status($po_id,$po_status,$user_id_manager,$jen);
				$this->session->set_flashdata('success','Status Update');
				$data['content']		= 'purchase/purchase_order_list';
				$data['title']			= 'Purchase';
				if($group_id == '3'){
					$data['sub_title']		= 'Proses Approval Manager';
				}else{
					$data['sub_title']		= 'Purchase';
				}

				redirect('purchase/po_list');
				//$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function po_proses()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '1' OR $group_id == '2')
			{
				$po_id=$this->uri->segment(3);
				$po_number=$this->uri->segment(4);
				$data['porecord'] = $this->purchase_model->get_po_detail($po_id);
				$data['content']		= 'purchase/po_proses';
				$data['title']			= 'Purchase';
				if($group_id == '3'){
					$data['sub_title']		= 'Proses Approval Manager';
				}else{
					$data['sub_title']		= 'PO Number : '.$po_number;
				}
				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function po_update_detail($param1='')
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data = array(
					'purchase_order_status' => $this->input->post('status'),
				);
				$this->purchase_model->update_general('purchase_order_detail','po_detail_id',$param1,$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function po_detail()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '1' or $group_id == '2' or $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '18')
			{
				$po_number=$this->uri->segment(4);
				$po_id=$this->uri->segment(3);
				$data['porecord'] = $this->purchase_model->get_po_detail($po_id);
				$data['content']		= 'purchase/po_detail';
				$data['title']			= 'Purchase';
                $data['con']			= $this;
				if($group_id == '3'){
					$data['sub_title']		= 'Proses Approval Manager';
				}else{
					$data['sub_title']		= 'Detail '.$po_number;
				}
				$data['account']	= $this->finance_model->get_account();

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}


	public function po_proses_faktur()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '1')
			{
				$po_id=$this->uri->segment(3);
				$po_number=$this->uri->segment(4);
                $data['con']			= $this;
				$data['porecord'] = $this->purchase_model->get_po_detail($po_id);
				$data['content']		= 'purchase/po_proses_faktur';
				$data['title']			= 'Purchase';
				if($group_id == '3'){
					$data['sub_title']		= 'Proses Approval Manager';
				}else{
					$data['sub_title']		= 'Faktur PO : '.$po_number;
				}
				$data['account']	= $this->finance_model->get_account();

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	public function do_upload()
	{
	    $config['upload_path']          = './uploads/';
	    $config['allowed_types']        = 'gif|jpg|png';
	    $config['max_size']             = 100;
	    $config['max_width']            = 1024;
	    $config['max_height']           = 768;

	    $this->load->library('upload', $config);

	    if ( ! $this->upload->do_upload('file_faktur'))
	    {
	        $data = array('error' => $this->upload->display_errors());

	        //$this->load->view('upload_form', $error);
	        $this->load->view('template',$data);
	    }
	    else
	    {
	        $data = array('upload_data' => $this->upload->data());

	        //$this->load->view('upload_success', $data);

	        $this->load->view('template',$data);
	    }
	}

	function po_simpan_faktur()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ( $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR  $group_id == '1')
			{
				$no_faktur = $this->input->post('no_faktur');
				$tgl_faktur=date("Y-m-d",strtotime($this->input->post('tgl_faktur')));

				///$file_element_name=$this->input->post('file_faktur');

    				$config['upload_path'] = './uploads/';
    				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
    				/*$config['max_size'] = 1024 * 8;*/
    				$config['encrypt_name'] = TRUE;

    				$this->load->library('upload', $config);
    				//$this->load->library('upload', $config);

    				// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
    				// $this->upload->initialize($config);

    				if (!$this->upload->do_upload('file_faktur'))
    				{
    				    $status = 'error';
    				    $msg = $this->upload->display_errors('', '');
    				    $namafile="";
    				    $filefaktur="";
    				}
    				else
    				{
    				    $data = $this->upload->data();
    				    $filex='./uploads/'.$data['file_name'];
    				    $filefaktur = file_get_contents($filex);
    				    $namafile=$data['file_name'];
    				}



//				$status=$filefaktur;
				//$filefaktur="";
				$po_number 		= $this->input->post('po_number');
				$po_id 			= $this->input->post('po_id');
				$created_id		= $this->session->userdata('user_id');
				$ids 			= $this->input->post('ids');
				$pqty 			= $this->input->post('pqty');
				$pharga 		= $this->input->post('pharga');
				$jumlah = $this->input->post('jumlah');
				//$length = count($ids);
//						for($i = 0; $i < $length; $i++) {
//							if($pqty[$i]=="0" or $pharga[$i]=="0"){
//								$this->session->set_flashdata('message_error','Data');
//							}
//						}
				//if($no_faktur=="" ){
					//$this->session->set_flashdata('message_error','Silahkan Isi No. Faktur');
					//redirect('purchase/po_proses_faktur/'.$po_number.'');
				//}else{

					//$akun1  	=$this->input->post('akun1');
					//$debit1 	=$this->input->post('debit1');
					//$kredit1	=$this->input->post('kredit1');
					//$ket1		=$this->input->post('ket1');
					//$akun2  	=$this->input->post('akun2');
					//$debit2 	=$this->input->post('debit2');
					//$kredit2	=$this->input->post('kredit2');
					//$ket2		=$this->input->post('ket2');

					//if(($debit1 == $kredit1) or ($debit2 == $kredit2) ){
						//$this->session->set_flashdata('message_error','Silahkan Tentukan Debit atau Kredit');
						//redirect('purchase/po_proses_faktur/'.$po_number.'');
					//}else{
					  $status=$this->purchase_model->simpan_faktur($no_faktur,$tgl_faktur,$filefaktur,$po_number,$po_id,$created_id,$ids,$pqty,$pharga,$namafile);
						//$this->db->reconnect();
						$jen="faktur";
						$po_status=$jen;
						$user_id_manager=$created_id;
						$this->purchase_model->update_po_status($po_id,$po_status,$user_id_manager,$jen);

						//$this->db->reconnect();
						//$this->db->trans_start();
						$length = count($ids);
						date_default_timezone_set('Asia/Jakarta');
						for($i = 0; $i < $length; $i++) {

									 $data_form = array(
														'created_time'				=> date('Y-m-d H:i:s'),
														'created_by'			=> $created_id,
														'material_id'			=> $ids[$i],
														'logistic_stock'			=> $pqty[$i],
														'status'			=> 'in',
														'logistic_location_id'			=> '1',
														'po_number'			=> $po_number,
														);

									$this->db->insert('logistic',$data_form);
									$this->material_model->update_materialall($ids[$i],$user_id_manager,$po_number,$pqty[$i],$pharga[$i]);
									//var_dump($data_form[$i]);die;
									$this->purchase_model->update_harga_material($ids[$i],$pharga[$i],$jumlah);
						}
						///JURNAL DI HILANGKAN//
						//$this->db->trans_complete();
						//$puser=$created_id;


						//$this->db->reconnect();
						//$created_by=$created_id;
						//$finance_journal_number=$no_faktur;
						//$finance_journal_date=$tgl_faktur;

						//$this->finance_model->faktur_insert_jurnal_umum($created_by,$finance_journal_number,$finance_journal_date,$akun1,$debit1,$kredit1,$akun2,$debit2,$kredit2,$po_number,$ket1,$ket2);



						//$data['title']			= 'Purchase';
						//$data['sub_title']		= 'Input Faktur';
						//$data['status']		= $status;
						//$data['content']		= 'purchase/pr_test';
						//$this->load->view('template',$data);
						$this->session->set_flashdata('success','Status Update');
						redirect('purchase/po_list');
					//}
				//}

                if($namafile!=""){
                    unlink($filex);
                }

			}
		}
		else
		{
			redirect('account/login');
		}
	}


	function po_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '18' )
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));

				$data['porecord'] = $this->purchase_model->get_po_list($start_date,$end_date);
				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));

				$data['content']		= 'purchase/purchase_order_summary';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Pembelian';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function purchase_export_to_excel($start_date,$end_date)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '7')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$logisticsrecord = $this->logistic_model->get_logistic($start_date,$end_date);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Logistic")
											 ->setSubject("Logistic")
											 ->setDescription("Logistic")
											 ->setKeywords("Logistic")
											 ->setCategory("Logistic");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'Tanggal')
							->setCellValue('C1', 'Oleh')
							->setCellValue('D1', 'Material')
							->setCellValue('E1', 'Keterangan')
							->setCellValue('F1', 'Stok')
							->setCellValue('G1', 'Satuan')
							->setCellValue('H1', 'Status');

				// Add data
				$no=1;
				$i=1;
				foreach($logisticsrecord as $row)
				{
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, date("d-m-Y H:i:s",strtotime($row->created_time)))
							->setCellValue('C'.$i, $row->full_name)
							->setCellValue('D'.$i, $row->item_name)
							->setCellValue('E'.$i, $row->description)
							->setCellValue('F'.$i, $row->stock)
							->setCellValue('G'.$i, $row->unit_name)
							->setCellValue('H'.$i, $row->status);
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Logistic');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="logistic.xlsx"');
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

	function po_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '8' || $group_id == '4')
			{
				if($this->session->userdata('product_recipe_code') == TRUE)
				{
					redirect('purchase/po_cart');
				}
				else
				{
					$data['content']		= 'purchase/po_create';
					$data['title']			= 'Purchase';
					$data['sub_title']		= 'Buat PO';

					$data['countpo']	= $this->purchase_model->get_count_po();
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

	function po_cart()
	{
		//$this->cart->destroy();
				//	$session_data	= array(
//											'purchase_order_number'		=> "",
//											'po_date_required'			=> "",
//											'po_supplier_id'			=> "",
//											'po_note'					=> ""
//											);
//						$this->session->unset_userdata($session_data);
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '8' || $group_id == '4')
			{
				$data['content']		= 'purchase/po_cart';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Tambah Item PO';

				if($this->session->userdata('purchase_order_number') == TRUE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$this->form_validation->set_rules('po_date_required','Tanggal Dibutuhkan', 'trim|required');
					if($this->form_validation->run() == FALSE)
					{
						redirect('purchase/po_create');
					}
					else
					{
						$countpo	= $this->purchase_model->get_count_po();
						foreach($countpo as $po)
						{
							$po_count	= $po->count + 1;
							$po_number	= $this->session->userdata('po_prefix_code') . $po_count;
						}

						$session_data	= array(
											'purchase_order_number'		=> $po_number,
											'po_date_required'			=> date('Y-m-d',strtotime($this->input->post('po_date_required'))),
											'po_supplier_id'			=> $this->input->post('supplier_id'),
											'po_note'					=> $this->input->post('po_note')
											);
						$this->session->set_userdata($session_data);
						redirect('purchase/po_cart');
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




	function po_material_add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '8' || $group_id == '4')
			{
				$this->form_validation->set_rules('po_material_qty','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('purchase/po_cart');
				}
				else
				{
					$material_id		= $this->input->post('po_material_id');
					$qty				= $this->input->post('po_material_qty');
					$price				= $this->input->post('po_material_price');

					$materialsrecords	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materialsrecords AS $materials)
					{
						$material_name	= $materials->material_name;
					}

					$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> $price,
							   'name'    	=> $material_name,
							   'options' 	=> ''
							);

					$this->cart->insert($data_form);
					redirect('purchase/po_cart');
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

	function po_material_remove_from_cart($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);
			redirect('purchase/po_cart');
		}
		else
		{
			redirect('account/login');
		}
	}

	function po_save()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '8' || $group_id == '4')
			{
				$data['content']		= 'purchase/po_create';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Buat PO';

				//$this->form_validation->set_rules('stock','Stok', 'trim|required|numeric|min_length[1]');
				$totalpo=$this->input->post('totalpo');

				if ($totalpo==0)
				{
					$this->session->set_flashdata('Silahkan tambahkan PO','PO');
					redirect('purchase/po_cart');
				}
				else
				{
					$item_id	= $this->input->post('item_id');
					$unit_id	= $this->input->post('unit_id');

//					$data_form	=	array(
//									'created_time'				=> date('Y-m-d H:i:s'),
//									'created_by'				=> $user_id,
//									'logistic_item_id'			=> $item_id,
//									'status'					=> 'in',
//									'logistic_description'		=> set_value('description'),
//									'logistic_item_stock'		=> set_value('stock')
//									);
//
//					$this->logistic_model->logistic_create($data_form);
//
//					$this->session->set_flashdata('message_success','Penambahan Logistik berhasil.');
//					redirect('logistic');
					$this->purchase_model->create_po();
					$this->cart->destroy();
					$session_data	= array(
											'purchase_order_number'		=> "",
											'po_date_required'			=> "",
											'po_supplier_id'			=> "",
											'po_note'					=> ""
											);
						$this->session->unset_userdata($session_data);
					$this->session->set_flashdata('message_success','Data berhasil disimpan');
					redirect('purchase/po_list');
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

	function pr_list_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8' OR $group_id == '9')
			{
				$start_date=date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date=date('Y-m-d',strtotime($this->input->post('end_date')));
				$data['prrecord'] = $this->purchase_model->get_pr_list($start_date,$end_date);
				$data['content']		= 'purchase/purchase_requisition_list';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Permintaan';

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


	function pr_list()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8' OR $group_id == '9' OR $group_id == '18' OR $group_id == '4')
			{
				$data['prrecord'] = $this->purchase_model->get_pr();
				$data['content']		= 'purchase/purchase_requisition_list';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Permintaan';

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

	function pr_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '9' or $group_id == '18')
			{
				if($this->session->userdata('pr_date_required') == TRUE)
				{
					redirect('purchase/pr_cart');
				}
				else
				{
					$data['content']		= 'purchase/pr_create';
					$data['title']			= 'Purchase';
					$data['sub_title']		= 'Buat PR';

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

	function pr_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '9' or $group_id == '18' OR $group_id == '4')
			{
				$data['content']		= 'purchase/pr_cart';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Tambah PR';

				if($this->session->userdata('pr_date_required') == TRUE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$this->form_validation->set_rules('pr_date_required','Tanggal Dibutuhkan', 'trim|required');
					if($this->form_validation->run() == FALSE)
					{
						redirect('purchase/pr_create');
					}
					else
					{
						echo "masuk ni";
						$session_data	= array(
											'pr_date_required'			=> date('Y-m-d',strtotime($this->input->post('pr_date_required'))),
											'pr_note'					=> $this->input->post('po_note') //edit by heru
											);
						$this->session->set_userdata($session_data);
						redirect('purchase/pr_cart');
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


	public function add_journal()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$created_by			= $this->session->userdata('user_id');
                $po_id      = $this->input->post('po_id');
                $po_number  = $this->input->post('po_number');
                
				$finance_journal_number= $this->input->post('finance_journal_number');
				$finance_journal_date= $this->input->post('finance_journal_date');
				$finance_journal_type_id= $this->input->post('finance_journal_type_id');
				$keterangan= $this->input->post('keterangan');

				$akun1		= $this->input->post('account1');
				$debit1		= (int)$this->input->post('debit1');
				$kredit1	= (int)$this->input->post('kredit1');
				$ket1		= $this->input->post('ket1');
				$akun2		= $this->input->post('account2');
				$debit2		= (int)$this->input->post('debit2');
				$kredit2	= (int)$this->input->post('kredit2');
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
				$finance_journal_id	= $this->db->insert_id();
                
                $this->db->trans_start();
                if($debit1 > 0 and ($kredit1 == 0 or $kredit1 == ''))
                {
                    $dk="1";
                    $nom1=$debit1;
                }
                elseif(($debit1==0 or $debit1=='') and $kredit1>0)
                {
                    $dk="0";
                    $nom1=$kredit1;
                }
                 $po_data_detail = array(
                    'finance_journal_id'	=> $finance_journal_id,
                    'item'			=> 0,
                    'finance_account_id'			=> $akun1,
                    'debit_kredit'			=> $dk,
                    'nominal'			=> $nom1,
                    'ket'			=> $ket1
                );
                
                $this->db->insert('finance_journal_detail',$po_data_detail);
                $this->db->trans_complete();
                
                $this->db->trans_start();
                if($debit2 > 0 and ($kredit2 == 0 or $kredit2 == ''))
                {
                    $dk2="1";
                    $nom2=$debit2;
                }
                elseif(($debit2 == 0 or $debit2 =='') and $kredit2 > 0)
                {
                    $dk2="0";
                    $nom2=$kredit2;
                }
                $po_data_detail = array(
                    'finance_journal_id'	=> $finance_journal_id,
                    'item'					=> 0,
                    'finance_account_id'	=> $akun2,
                    'debit_kredit'			=> $dk2,
                    'nominal'				=> $nom2,
                    'ket'					=> $ket2
                );
                $this->db->insert('finance_journal_detail',$po_data_detail);

                $this->db->trans_complete();
                if ($dk=="1"){
                    $this->db->reconnect();
                    $sql = "update finance_account set finance_account_saldo=finance_account_saldo+".$nom1." where finance_account_id=".$akun1;
                    $this->db->query($sql);
                }elseif($dk=="0"){
                    $this->db->reconnect();
                    $sql = "update finance_account set finance_account_saldo=finance_account_saldo-".$nom1." where finance_account_id=".$akun1;
                    $this->db->query($sql);

                }

                if ($dk2=="1"){
                    $this->db->reconnect();
                    $sql = "update finance_account set finance_account_saldo=finance_account_saldo+".$nom2." where finance_account_id=".$akun2;
                    $this->db->query($sql);
                }elseif($dk2=="0"){
                    $this->db->reconnect();
                    $sql = "update finance_account set finance_account_saldo=finance_account_saldo-".$nom2." where finance_account_id=".$akun2;
                    $this->db->query($sql);

                }

				//$data['content']		= 'purchase/pr_test';
//				$data['status']			= $data_form;
//				$data['ok']			= $ok;
//					$data['title']			= 'Purchase';
//					$data['sub_title']		= 'Detail PR';
//
//					$this->load->view('template',$data);

                $update_po_data = array(
                    'po_status' => 'complete'
                );
                
                $this->purchase_model->po_update($po_id,$update_po_data);
                
				$this->session->set_flashdata('message_success','Data Update');
				if($finance_journal_type_id==1){
					redirect('purchase/po_detail/'.$po_id.'/'.$po_number);
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

	function pr_material_add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '9' or $group_id == '18')
			{
				$this->form_validation->set_rules('pr_material_qty','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('purchase/pr_cart');
				}
				else
				{
					$material_id		= $this->input->post('pr_material_id');
					$qty				= $this->input->post('pr_material_qty');
					$pr_supplier		= $this->input->post('pr_supplier');

					$materialsrecords	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materialsrecords AS $materials)
					{
						$material_name				= $materials->material_name;
						$material_purchase_price	= $materials->material_purchase_price;
					}

					$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> $material_purchase_price,
							   'name'    	=> $material_name,
							   'options' 	=> array('pr_supplier' => $pr_supplier)
							);

					$this->cart->insert($data_form);
					redirect('purchase/pr_cart');
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

	function pr_material_remove_from_cart($rowid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);
			redirect('purchase/pr_cart');
		}
		else
		{
			redirect('account/login');
		}
	}

	function pr_cancel()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->cart->destroy();
			$this->session->unset_userdata('pr_date_required');
			$this->session->unset_userdata('pr_note');
			redirect('purchase/pr_list');
		}
		else
		{
			redirect('account/login');
		}
	}

	function pr_save()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '9' or $group_id == '18')
			{
				$this->form_validation->set_rules('pr_date_required','Tanggal Dibutuhkan', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('purchase/pr_cart');
				}
				else
				{
					if($this->purchase_model->create_pr() == TRUE)
					{
						$this->cart->destroy();
						$this->session->unset_userdata('pr_date_required');
						$this->session->unset_userdata('pr_note');
						$this->session->set_flashdata('message_success','Pembuatan PR berhasil.');
						redirect('purchase/pr_list');
					}
					else
					{
						redirect('purchase/pr_cart');
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

    function prdetail_delete($id,$pr_number)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			if(isset($pr_number))
			{
				$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$user_id			= $this->session->userdata('user_id');

				$group_id = $this->session->userdata('group_id');
				if($group_id == '18')
				{

                    $this->purchase_model->delete_prdetail($id);
                    $this->session->set_flashdata('success','Data Berhasil Dihapus');
                    redirect('purchase/pr_view/'.$pr_number);
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


     function prdetail_update($pr_number)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			if(isset($pr_number))
			{
				$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$user_id			= $this->session->userdata('user_id');

				$group_id = $this->session->userdata('group_id');
				if($group_id == '18')
				{

                    $this->purchase_model->update_prdetail($_POST['v_id'],$_POST['v_qty']);
                    $this->session->set_flashdata('message_success','Data Update');
                    echo "SUKSES";
                   // redirect('pr_view/'.$pr_number);
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


	function pr_view($pr_number)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			if(isset($pr_number))
			{
				$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
				$user_id			= $this->session->userdata('user_id');

				$group_id = $this->session->userdata('group_id');
				if($group_id == '18'  or $group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8' OR $group_id == '9' or $group_id == '18' OR $group_id == '4')
				{
					$data['prrecord'] = $this->purchase_model->get_pr_by_pr_number($pr_number);
					$data['con']		= $this;
					$data['content']		= 'purchase/pr_view';
					$data['title']			= 'Purchase';
					$data['sub_title']		= 'Detail '.$pr_number;

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

		function pr_proses_po()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{

				$po_supplier_id = $this->input->post('supplier_id');
				$pr_number = $this->input->post('pr_number');
				$pqty = $this->input->post('pqty');
				$pharga = $this->input->post('pharga');
				if($po_supplier_id=="" ){
					$this->session->set_flashdata('message_error','Silahkan Pilih Supplier');
					redirect('purchase/pr_approve/'.$pr_number.'');
				}else{
					$ids = $this->input->post('material_id');

					$po_number = $this->input->post('po_number');

					$po_note = $this->input->post('pr_note');
					$pr_number = $this->input->post('pr_number');
					$po_date_required=date("Y-m-d",strtotime($this->input->post('po_date_required')));
					$user_id			= $this->session->userdata('user_id');
					$status=$this->purchase_model->approve_po($po_number,$po_date_required,$po_note,$po_supplier_id,$pr_number,$ids ,$pqty,$pharga,$user_id);
					$this->db->reconnect();
					$status="approved";
					$this->purchase_model->update_pr_status($status,$user_id,$pr_number);
	/*				$data['content']		= 'purchase/pr_test';
					$data['title']			= 'Purchase';
					$data['sub_title']		= 'Approve PR';
					$data['status']		= $status;
					$this->load->view('template',$data);*/
					$data['content']		= 'purchase/purchase_order_list';
					$this->session->set_flashdata('success','Status Update');
					redirect('purchase/po_list');
				}


				//print_r($this->input->post('material_id'));
				//$data['title']			= 'Purchase';
				/*$data['title']			= 'Purchase';
				$data['sub_title']		= 'Approve PR';
				$data['po_number']		= $po_number;
				$data['pr_number']		= $pr_number;
				$this->load->view('template',$data);*/
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


	function pr_proses_ponew()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{

				//$po_supplier_id = $this->input->post('supplier_id');
				$pr_number = $this->input->post('pr_number');
				$pqty = $this->input->post('pqty');
				$pharga = $this->input->post('pharga');
				//if($po_supplier_id=="" ){
					//$this->session->set_flashdata('message_error','Silahkan Pilih Supplier');
				//	redirect('purchase/pr_approve/'.$pr_number.'');
				//}else{
					$ids = $this->input->post('material_id');

					$po_number = $this->input->post('po_number');

					$po_note = $this->input->post('pr_note');
					$pr_number = $this->input->post('pr_number');
					$po_date_required=date("Y-m-d",strtotime($this->input->post('po_date_required')));
					$user_id			= $this->session->userdata('user_id');
					//$status=$this->purchase_model->approve_po($po_number,$po_date_required,$po_note,$po_supplier_id,$pr_number,$ids ,$pqty,$pharga,$user_id);
					$this->purchase_model->create_pr_to_po($pr_number,$po_date_required,$po_note,$pr_number,$pharga);
					$this->db->reconnect();
					$status="approved";
					$this->purchase_model->update_pr_status($status,$user_id,$pr_number);
	/*				$data['content']		= 'purchase/pr_test';
					$data['title']			= 'Purchase';
					$data['sub_title']		= 'Approve PR';
					$data['status']		= $status;
					$this->load->view('template',$data);*/
					$data['content']		= 'purchase/purchase_order_list';
					$this->session->set_flashdata('success','Status Update');
					redirect('purchase/po_list');
				//}


				//print_r($this->input->post('material_id'));
				//$data['title']			= 'Purchase';
				/*$data['title']			= 'Purchase';
				$data['sub_title']		= 'Approve PR';
				$data['po_number']		= $po_number;
				$data['pr_number']		= $pr_number;
				$this->load->view('template',$data);*/
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


    function pr_approverejectmp($pr_number,$status)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
            $user_id	= $this->session->userdata('user_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8' OR $group_id == '18')
			{
					//update
                    $this->purchase_model->update_pr_status($status,$user_id,$pr_number);
                    $this->session->set_flashdata('message_success','Status Update');
                    redirect('purchase/pr_list');
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

	function pr_approve($pr_number)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8' OR $group_id == '18')
			{
						$countpo	= $this->purchase_model->get_count_po();
						foreach($countpo as $po)
						{
							$po_count	= $po->count + 1;
							$po_number	= $this->session->userdata('po_prefix_code') . $po_count;
						}
				$pr_number=$this->uri->segment(3);
				//echo "test";
				$data['prrecord'] = $this->purchase_model->get_pr_by_pr_number($pr_number);

				$data['content']		= 'purchase/pr_approve';
				$data['title']			= 'Purchase';
				$data['sub_title']		= 'Approve PR';
                $data['con']		= $this;
				$data['po_number']		= $po_number;
				$data['pr_number']		= $pr_number;
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

	function cupdate_supplier_pr()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '8')
			{

				$pr_detail_id=$_POST['pr_detail_id'];
				$id_supplier=$_POST['id_supplier'];
				$this->purchase_model->update_supplier_pr($pr_detail_id,$id_supplier);

				//$this->session->set_flashdata('message_success','Approved berhasil.');
				//redirect('purchase/pr_view/' . $pr_number);
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


	function pr_approve_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{
				$user_id	= $this->session->userdata('user_id');
				$pr_data	=	array(
									'pr_approved_time'				=> date('Y-m-d H:i:s'),
									'pr_approved_by'				=> $user_id,
									'pr_status'						=> 'approved'
									);

				$this->purchase_model->pr_approved($pr_number,$pr_data);

				$this->session->set_flashdata('message_success','Approved berhasil.');
				redirect('purchase/pr_view/' . $pr_number);
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

	function pr_reject($pr_number)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{
				$user_id	= $this->session->userdata('user_id');
				$pr_data	=	array(
									'pr_rejected_time'				=> date('Y-m-d H:i:s'),
									'pr_rejected_by'				=> $user_id,
									'pr_status'						=> 'rejected'
									);

				$this->purchase_model->pr_approved($pr_number,$pr_data);
				//$this->purchase_model->update_pr_status($status,$user_id,$pr_number);
				$this->session->set_flashdata('message_success','Approved berhasil.');
				redirect('purchase/pr_view/' . $pr_number);
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

	function pr_reject_process()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8')
			{
				$user_id	= $this->session->userdata('user_id');
				$pr_data	=	array(
									'pr_approved_time'				=> date('Y-m-d H:i:s'),
									'pr_approved_by'				=> $user_id,
									'pr_status'						=> 'approved'
									);

				$this->purchase_model->pr_approved($pr_number,$pr_data);

				$this->session->set_flashdata('message_success','Approved berhasil.');
				redirect('purchase/pr_view/' . $pr_number);
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

/* End of file purchase.php */
/* Location: ./application/controllers/purchase.php */
