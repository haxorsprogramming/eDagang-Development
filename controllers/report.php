<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function index()
	{
		redirect('account');
	}
	
	function bella()
	{
		$slurp = "";
	}

	function income_today()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$data['incomesrecord'] = $this->report_model->income_today();

				$data['content']		= 'report/income_today';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Pendapatan Hari Ini';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function income_month()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$data['incomesrecord'] = $this->reports_model->income_month();

				$data['content']		= 'report/income_month';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Pendapatan Bulan Ini';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function income_year()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$data['incomesrecord'] = $this->reports_model->income_year();

				$data['content']		= 'report/income_year';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Pendapatan Tahun Ini';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function income()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$data['incomesrecord'] = $this->report_model->income_today();

				$data['content']		= 'report/income';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Pendapatan';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function income_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));

				$data['incomesrecord'] = $this->report_model->incomes($start_date,$end_date);
				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));

				$data['content']		= 'report/income_summary';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Pendapatan';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function income_export_to_excel($start_date,$end_date)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$incomesrecord = $this->report_model->incomes($start_date,$end_date);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Income Report")
											 ->setSubject("Income Report")
											 ->setDescription("Income Report")
											 ->setKeywords("Income Report")
											 ->setCategory("Income Report");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'No. SE')
							->setCellValue('C1', 'Kasir')
							->setCellValue('D1', 'Tanggal')
							->setCellValue('E1', 'Pendapatan Tunai')
							->setCellValue('F1', 'Pendapatan Non Tunai')
							->setCellValue('G1', 'Keterangan');

				// Add data
				$no=1;
				$i=1;
				foreach($incomesrecord as $row)
				{
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, $row->se_id)
							->setCellValue('C'.$i, $row->full_name)
							->setCellValue('D'.$i, date("d-m-Y H:i:s",strtotime($row->closed_shift_time)))
							->setCellValue('E'.$i, $row->income_cash)
							->setCellValue('F'.$i, $row->income_noncash)
							->setCellValue('G'.$i, $row->closed_shift_notes);
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Income Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="income_report.xlsx"');
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

	function sales_today()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$data['salesrecord'] = $this->report_model->sales_today();

				$data['content']		= 'report/sales_today';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Penjualan Hari Ini';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('users/login');
		}
	}

	function sales_month()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$month	= date('Y-m');
				$data['salesrecord'] = $this->report_model->sales_month($month);

				$data['content']		= 'report/sales_month';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Penjualan Bulan Ini';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function sales_year()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$data['salesrecord'] = $this->report_model->sales_year();

				$data['content']		= 'report/sales_year';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Penjualan Tahun Ini';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	public function sales()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99' OR $group_id == '5' OR $group_id == '6')
			{
				$start_date	= date('Y-m-d');
				$end_date	= date('Y-m-d');
				$v_metode="semua";
				$v_kategory="semua";
				$v_subkategory="semua";
				$data['salesrecord'] = $this->report_model->salesmetode($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);
                
                $data['salescashier'] = $this->report_model->salesmetode_by_cashier($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);
                
				$data['kat'] = $this->report_model->kategory();
				$data['skat'] = $this->report_model->subkategory();
                $data['lb'] = $this->report_model->listbank();
                $data['start_date']	= date('d-m-Y');
				$data['end_date']	= 	date('d-m-Y');
                $data['v_metode']	= $v_metode;
				$data['v_subkategory']	= $v_subkategory;
				$data['v_kategory']	= $v_kategory;
				//$data['content']		= 'report/sales_today';
                $data['content']		= 'report/sales_summary';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Penjualan';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

		function sales_searchrekap()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));
                if($start_date=="1970-01-01" and $end_date=='1970-01-01'){
                    $start_date	=date('Y-m-d');
                    $end_date=date('Y-m-d');
                    $product_id	='semua';
				$v_metode	= 'semua';
				$v_kategory	= 'semua';
				$v_subkategory	='semua';
                }else{
                    //$product_id	= $this->input->post('product_id');
				$v_metode	= $this->input->post('v_metode');
				$v_kategory	= $this->input->post('v_kategory');
				$v_subkategory	= $this->input->post('v_subkategory');
                }


			//	if ($product_id != '')
			//	{
				//	$data['salesrecord'] = $this->report_model->sales_by_product_id($start_date,$end_date,$product_id);
			//	}
				//else
				//{
					$data['salesrecord'] = $this->report_model->salesmetoderekap($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);
					//$data['salesrecord'] = $this->report_model->transcode($start_date,$end_date);
			//	}

				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));
				$data['kat'] = $this->report_model->kategory();
				$data['skat'] = $this->report_model->subkategory();
				$data['v_metode']	= $v_metode;
				$data['v_subkategory']	= $v_subkategory;
				$data['v_kategory']	= $v_kategory;
				$data['content']		= 'report/sales_summaryrekap';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Penjualan';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function sales_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));
				$product_id	= $this->input->post('product_id');
				$v_metode	= $this->input->post('v_metode');
				$v_kategory	= $this->input->post('v_kategory');
				$v_subkategory	= $this->input->post('v_subkategory');

				//if ($product_id != '')
			//	{
				//	$data['salesrecord'] = $this->report_model->sales_by_product_id($start_date,$end_date,$product_id);
			//	}
			//	else
			//	{
					$data['salesrecord'] = $this->report_model->salesmetode($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);
                    $data['salescashier'] = $this->report_model->salesmetode_by_cashier($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);
					//$data['salesrecord'] = $this->report_model->transcode($start_date,$end_date);
				//}
				$data['kat'] = $this->report_model->kategory();
				$data['skat'] = $this->report_model->subkategory();

				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));
				$data['v_metode']	= $v_metode;
				$data['v_subkategory']	= $v_subkategory;
				$data['v_kategory']	= $v_kategory;
				$data['content']		= 'report/sales_summary';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Penjualan';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function sales_export_to_excel($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' or  $group_id == '9' OR $group_id='4')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$salesrecord = $this->report_model->salesmetode($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Sales Report")
											 ->setSubject("Sales Report")
											 ->setDescription("Sales Report")
											 ->setKeywords("Sales Report")
											 ->setCategory("Sales Report");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'Tanggal')
							->setCellValue('C1', 'Kategori')
							->setCellValue('D1', 'Produk')
                            ->setCellValue('E1', 'Harga Pokok')
							->setCellValue('F1', 'Harga Jual')
							->setCellValue('G1', 'QTY')
							->setCellValue('H1', 'Diskon')
							->setCellValue('I1', 'SubTotal')
							->setCellValue('J1', 'Tax')
                            ->setCellValue('K1', 'Service')
							->setCellValue('L1', 'Total');

				// Add data
				$no=1;
				$i=1;
				$subtotal=0;
                $jsubtotal=0;
                        $jtax=0;
                        $jservice=0;
                        $jtotal=0;
                        $jdisc=0;
                        $service=0;
                        $tax=0;
                        $jpc=0;
                        //print_r($salesrecord);
				foreach($salesrecord as $row)
				{
					//$total		= $row->selling_price * $row->qty;
					//$ppn		= $total * 0.1;
					//$subtotal	= $total + $ppn;

							$total		=	$row->selling_price * $row->qty;
                            $jpc=$jpc+($row->purchase_price * $row->qty);

                            if($row->tax=='no_taxes'){
                                $disc=0;
                            }else{
                                $disc		=	$total * ($row->diskon / 100);
                            }
							$totaldis	=	$total-($disc);

                             if($row->tax=='includ_tax' or $row->tax=='no_taxes' or $row->customer_group_id=='6'){
                				$tax				= 0;

                			}else{
                				$tax				= $totaldis * ($row->tax_fare / 100);
                			}
                			//echo
                			if(($row->payment_method == "saldo" and $row->status=='paid') or $row->order_status=='take_away' or $row->customer_group_id=='6' or $row->tax=='no_taxes'){
                				$service			= 0;

                			}else{
                					$service			= $totaldis * ($row->service_fare / 100);

                			}

						//	$ppn		=	$totaldis	 * 0.1;
						//	$subtotal	=	$totaldis + $ppn;
                             $subtotal=$totaldis+$tax+$service;
                             $jtotal=$jtotal+$total;
							$jdisc=$jdisc+$disc;
						//	$jppn=$jppn+$ppn;
                            $jtax=$jtax+$tax;
                            $jservice=$jservice+$service;
							$jsubtotal=$jsubtotal+$subtotal;

					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, $row->sales_date)
							->setCellValue('C'.$i, $row->product_category_name)
							->setCellValue('D'.$i, $row->product_name)
                            ->setCellValue('E'.$i, $row->purchase_price)
							->setCellValue('F'.$i, $row->selling_price)
							->setCellValue('G'.$i, $row->qty)
							->setCellValue('H'.$i, $disc)
							->setCellValue('I'.$i, $totaldis)
							->setCellValue('J'.$i, $tax)
      	                    ->setCellValue('K'.$i, $service)
							->setCellValue('L'.$i, $subtotal);
				}

                            $i++;
                             $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('A'.$i, "")
 							->setCellValue('B'.$i, "")
 							->setCellValue('C'.$i, "")
 							->setCellValue('D'.$i, "")
 							->setCellValue('E'.$i, $jpc)
 							->setCellValue('F'.$i, $jtotal)
                            ->setCellValue('G'.$i, "")
 							->setCellValue('H'.$i, $jdisc)
 							->setCellValue('I'.$i, $jtotal-$jdisc)
 							->setCellValue('J'.$i, $jtax)
       	                    ->setCellValue('K'.$i, $jservice)
 							->setCellValue('L'.$i, $jsubtotal);

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Sales Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="sales_report.xlsx"');
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

	function sales_export_to_excelrekap($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' or  $group_id == '9' OR $group_id='4')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$salesrecord = $this->report_model->salesmetoderekap($start_date,$end_date,$v_metode,$v_kategory,$v_subkategory);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Sales Report")
											 ->setSubject("Sales Report")
											 ->setDescription("Sales Report")
											 ->setKeywords("Rekap Penjualan")
											 ->setCategory("Rekap Penjualan");

				// Add Header

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', '')

							->setCellValue('B1', 'Rekap Penjualan')
							->setCellValue('C1', 'Tanggal')
							->setCellValue('D1', $start_date)
							->setCellValue('E1', '-')
							->setCellValue('F1', $end_date)
							->setCellValue('G1', 'Metode Pembayaran')
							->setCellValue('H1', $v_metode)
							->setCellValue('I1', '');

							$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A2', '')

							->setCellValue('B2', '')
							->setCellValue('C2', '')
							->setCellValue('D2', '')
							->setCellValue('E2', '')
							->setCellValue('F2', '')
							->setCellValue('G2', '')
							->setCellValue('H2', '')
							->setCellValue('I2', '')
							->setCellValue('J2', '');



				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A3', 'No.')

							->setCellValue('B3', 'Kategori')
							->setCellValue('C3', 'Produk')
							->setCellValue('D3', 'Harga Pokok')
                            ->setCellValue('E3', 'Harga Jual')
							->setCellValue('F3', 'QTY')
							->setCellValue('G3', 'Diskon')
							->setCellValue('H3', 'Subtotal')
							->setCellValue('I3', 'Tax')
                            ->setCellValue('J3', 'Service')
							->setCellValue('K3', 'Total');

				// Add data
				$no=1;
				$i=3;
				$subtotal=0;
                       $jsubtotal=0;
                        $jtax=0;
                        $jservice=0;
                        $jtotal=0;
                        $jdisc=0;
                        $service=0;
                        $tax=0;
                        $jpc=0;
				foreach($salesrecord as $row)
				{
					//$total		= $row->selling_price * $row->qty;
					//$ppn		= $total * 0.1;
					//$subtotal	= $total + $ppn;

								$total		=	$row->selling_price * $row->qty;
                                 $jpc=$jpc+($row->purchase_price * $row->qty);

                            if($row->tax=='no_taxes'){
                                $disc=0;
                            }else{
                                $disc		=	$total * ($row->diskon / 100);
                            }
							$totaldis	=	$total-($disc);

                             if($row->tax=='includ_tax' or $row->tax=='no_taxes' or $row->customer_group_id=='6'){
                				$tax				= 0;

                			}else{
                				$tax				= $totaldis * ($row->tax_fare / 100);
                			}
                			//echo
                			if(($row->payment_method == "saldo" and $row->status=='paid') or $row->order_status=='take_away' or $row->customer_group_id=='6' or $row->tax=='no_taxes'){
                				$service			= 0;

                			}else{
                					$service			= $totaldis * ($row->service_fare / 100);

                			}

						//	$ppn		=	$totaldis	 * 0.1;
						//	$subtotal	=	$totaldis + $ppn;
                             $subtotal=$totaldis+$tax+$service;
                             $jtotal=$jtotal+$total;
							$jdisc=$jdisc+$disc;
						//	$jppn=$jppn+$ppn;
                            $jtax=$jtax+$tax;
                            $jservice=$jservice+$service;
							$jsubtotal=$jsubtotal+$subtotal;

					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)

							->setCellValue('B'.$i, $row->product_category_name)
							->setCellValue('C'.$i, $row->product_name)
                            ->setCellValue('D'.$i, $row->purchase_price)
							->setCellValue('E'.$i, $row->selling_price)
							->setCellValue('F'.$i, $row->qty)
							->setCellValue('G'.$i, $disc)
							->setCellValue('H'.$i, $totaldis)
							->setCellValue('I'.$i, $tax)
      	                    ->setCellValue('J'.$i, $service)
							->setCellValue('K'.$i, $subtotal);
				}

                      $i++;
                             $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('A'.$i, "")
 							->setCellValue('B'.$i, "")
 							->setCellValue('C'.$i, "")
 							->setCellValue('D'.$i, $jpc)

 							->setCellValue('E'.$i, $jtotal)
                            ->setCellValue('F'.$i, "")
 							->setCellValue('G'.$i, $jdisc)
 							->setCellValue('H'.$i, $jtotal-$jdisc)
 							->setCellValue('I'.$i, $jtax)
       	                    ->setCellValue('J'.$i, $jservice)
 							->setCellValue('K'.$i, $jsubtotal);

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Sales Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="sales_report.xlsx"');
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

	function profit()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$data['profitrecord'] = $this->report_model->profit_today();

				$data['content']		= 'report/profit';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Profit';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function profit_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));

				$data['profitrecord']	= $this->report_model->profit($start_date,$end_date);
				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));

				$data['content']		= 'report/profit_summary';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Profit';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function profit_export_to_excel($start_date,$end_date)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$profitrecord = $this->report_model->profit($start_date,$end_date);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Profit Report")
											 ->setSubject("Profit Report")
											 ->setDescription("Profit Report")
											 ->setKeywords("Profit Report")
											 ->setCategory("Profit Report");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No.')
							->setCellValue('B1', 'Tanggal')
							->setCellValue('C1', 'Modal')
							->setCellValue('D1', 'Penjualan')
							->setCellValue('E1', 'Profit');

				// Add data
				$no=1;
				$i=1;
				foreach($profitrecord as $row)
				{
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $no++)
							->setCellValue('B'.$i, $row->sales_date)
							->setCellValue('C'.$i, $row->purchase_price)
							->setCellValue('D'.$i, $row->selling_price)
							->setCellValue('E'.$i, $row->profit);
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Profit Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="profit_report.xlsx"');
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

	function transaction()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4' OR $group_id == '5'OR $group_id == '6')
			{
				$data['transactionrecord'] = $this->report_model->transaction_today();

				$data['content']		= 'report/transaction';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Transaksi';

				$this->load->view('template',$data);
			}
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
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));

				$data['transactionrecord']	= $this->report_model->transaction($start_date,$end_date);
				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));

				$data['content']		= 'report/transaction_summary';
				$data['title']			= 'Laporan';
				$data['sub_title']		= 'Transaksi';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function transaction_export_to_excel($start_date,$end_date)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id='4')
			{
				$start_date	= date('Y-m-d',strtotime($start_date));
				$end_date	= date('Y-m-d',strtotime($end_date));

				$transactionrecord = $this->report_model->transaction($start_date,$end_date);

				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("ACI Resto")
											 ->setLastModifiedBy("ACI Resto")
											 ->setTitle("Transaction Report")
											 ->setSubject("Transaction Report")
											 ->setDescription("Transaction Report")
											 ->setKeywords("Transaction Report")
											 ->setCategory("Transaction Report");

				// Add Header
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'No. Trx')
							->setCellValue('B1', 'Tanggal')
							->setCellValue('C1', 'Waktu Pesan')
							->setCellValue('D1', 'Waktu Bayar')
							->setCellValue('E1', 'Pelayan')
							->setCellValue('F1', 'No. Meja')
							->setCellValue('G1', 'Pengunjung')
							->setCellValue('H1', 'Catatan')
							->setCellValue('I1', 'Status');

				// Add data
				$i=1;
				foreach($transactionrecord as $row)
				{
					$i++;
					$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $row->transaction_code)
							->setCellValue('B'.$i, $row->transaction_date)
							->setCellValue('C'.$i, date('d-m-Y H:i:s',strtotime($row->created_time)))
							->setCellValue('D'.$i, date('d-m-Y H:i:s',strtotime($row->payment_time)))
							->setCellValue('E'.$i, $row->full_name)
							->setCellValue('F'.$i, $row->table)
							->setCellValue('G'.$i, $row->visitor)
							->setCellValue('H'.$i, $row->remark_table)
							->setCellValue('I'.$i, $row->status);
				}

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Transaction Report');


				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);


				// Redirect output to a client�s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="transaction_report.xlsx"');
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

}

/* End of file report.php */
/* Location: ./application/controllers/report.php */
