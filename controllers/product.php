<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}
		function v_resep($vid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' )
			{
				$data['reseps']			=  $this->product_model->selectresep($group_id);
				$data['vid']=$vid;
				$this->load->view('product/v_resep',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}
	function v_product($vid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['reseps'] = $this->product_model->get_food_productall();
				$data['vid']=$vid;
				$this->load->view('product/v_product',$data);
			}
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
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' OR $group_id == '18')
			{
			     if($group_id == '14' or $group_id == '16'  OR $group_id == '15'){
			         $data['productsrecord'] = $this->product_model->get_allidgroup($group_id);
			     }else{
			         $data['productsrecord'] = $this->product_model->get_all();
			     }

				$data['content']		= 'product/product_list';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Produk';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	public function create_paket()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '4'  OR $group_id == '15' OR $group_id=='18')
			{

				$data['content']		= 'product/product_create_paket';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Tambah Produk';
				$data['reseps']			=  $this->product_model->selectresep($group_id);

				if($this->session->userdata('division') == 1)
				{
					$this->form_validation->set_rules('product_name','Nama Produk', 'trim|required');
					//$this->form_validation->set_rules('product_description','Deskripsi', 'trim|required|min_length[1]');
					//$this->form_validation->set_rules('product_recipe_id','Resep', 'trim|required');
					$this->form_validation->set_rules('product_selling_price','Harga Jual', 'trim|required');
					$this->form_validation->set_rules('production_devices_id','Perangkat Produksi', 'trim|required');
					$this->form_validation->set_rules('product_service_time','Waktu Layanan', 'trim|required');
					$this->form_validation->set_rules('product_status','Status', 'trim|required');

					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('template',$data);
					}
					else
					{
						$cid						= explode("#",$this->input->post('category_id'));
						$category_id				= $cid[0];
						$scid						= explode("#",$this->input->post('sub_category_id'));
						$sub_category_id			= $scid[0];
						$product_name				= set_value('product_name');
						$product_description		= set_value('product_description');
						$pr_id						= $this->input->post('product_recipe_id');
						$length=count($pr_id)-1;
						for($i = 0; $i < $length; $i++) {
							$product_recipe_id=$pr_id[$i];
						}
					/*	if($leng==1){
							$product_recipe_id
						}*/

						$product_selling_price		= $this->input->post('product_selling_price');
						$product_tax				= $this->input->post('product_tax');
						$product_service_time		= set_value('product_service_time');
						$production_devices_id		= $this->input->post('production_devices_id');
						$product_status				= $this->input->post('product_status');

						if($_FILES['userfile']['name'] != '')
						{
							$config['upload_path'] = './assets/img/product/';
							$config['allowed_types'] = 'jpg|png';
							$config['max_size']	= '2000';
							$config['max_width']  = '2000';
							$config['max_height']  = '2000';

							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if (!$this->upload->do_upload())
							{
								$this->load->view('template',$data);
							}
							else
							{
								$pic = $this->upload->data();

								$data_form	=	array(
											'created_by'							=> $user_id,
											'category_id'							=> $category_id,
											'sub_category_id'						=> $sub_category_id,
											'product_name'							=> $product_name,
											'product_description'					=> $product_description,
											'product_recipe_id'						=> $product_recipe_id,
											'product_selling_price'					=> $product_selling_price,
											'product_tax'							=> $product_tax,
											'product_production_devices_id'			=> $production_devices_id,
											'product_service_time'					=> $product_service_time,
											'product_image'							=> $pic['file_name'],
											'product_available'						=> $product_status
											);

								$this->product_model->create($data_form);
								if($cid[1]=='Paket'){
									$prodid	= $this->db->insert_id();
									$this->db->trans_start();

									for($i = 0; $i < $length; $i++) {
										$product_recipe_id=$pr_id[$i];
										//$po_data_detail = array(
										//			'product_id'	=> $prodid,
										//			'product_recipe_id'			=> $product_recipe_id,
										////			'created_by'			=> $user_id,
										//			'date_created'			=> date('Y-m-d H:i:s')
										//			);

										//$this->db->insert('z_paket_detail',$po_data_detail);
										$this->product_model->insert_paket_detail($product_recipe_id,$prodid);
									}
									$this->db->trans_complete();
								}
								$this->session->set_flashdata('message_success','Proses Simpan Berhasil');

								redirect('product');
							}
						}
						else
						{
							$data_form	=	array(
											'created_by'							=> $user_id,
											'category_id'							=> $category_id,
											'sub_category_id'						=> $sub_category_id,
											'product_name'							=> $product_name,
											'product_description'					=> $product_description,
											'product_recipe_id'						=> $product_recipe_id,
											'product_selling_price'					=> $product_selling_price,
											'product_tax'							=> $product_tax,
											'product_production_devices_id'			=> $production_devices_id,
											'product_service_time'					=> $product_service_time,
											'product_image'							=> "nopic.gif",
											'product_available'						=> $product_status
											);

								$this->product_model->create($data_form);
								if($cid[1]=='Paket'){
									$prodid	= $this->db->insert_id();
									$this->db->trans_start();

									for($i = 0; $i < $length; $i++) {
										$product_recipe_id=$pr_id[$i];
										//$po_data_detail = array(
//													'product_id'	=> $prodid,
//													'product_recipe_id'			=> $product_recipe_id,
//													'created_by'			=> $user_id,
//													'date_created'			=> date('Y-m-d H:i:s')
//													);

										//$this->db->insert('z_paket_detail',$po_data_detail);
										$this->product_model->insert_paket_detail($product_recipe_id,$prodid);
									}
									$this->db->trans_complete();
								}
								$this->session->set_flashdata('message_success','Proses Simpan Berhasil');
								redirect('product');
						}
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

	function create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4')
			{
				$data['content']		= 'product/product_create';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Tambah Produk';

				if($this->session->userdata('division') == 1)
				{
					$this->form_validation->set_rules('product_name','Nama Produk', 'trim|required');
					//$this->form_validation->set_rules('product_description','Deskripsi', 'trim|required|min_length[1]');
					$this->form_validation->set_rules('product_recipe_id','Resep', 'trim|required');
					$this->form_validation->set_rules('product_selling_price','Harga Jual', 'trim|required');
					$this->form_validation->set_rules('production_devices_id','Perangkat Produksi', 'trim|required');
					$this->form_validation->set_rules('product_service_time','Waktu Layanan', 'trim|required');
					$this->form_validation->set_rules('product_status','Status', 'trim|required');

					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('template',$data);
					}
					else
					{
						$category_id				= $this->input->post('category_id');
						$sub_category_id			= $this->input->post('sub_category_id');
						$product_name				= set_value('product_name');
						$product_description		= set_value('product_description');
						$product_recipe_id			= $this->input->post('product_recipe_id');
						$product_selling_price		= $this->input->post('product_selling_price');
						$product_tax				= $this->input->post('product_tax');
						$product_service_time		= set_value('product_service_time');
						$production_devices_id		= $this->input->post('production_devices_id');
						$product_status				= $this->input->post('product_status');

						if($_FILES['userfile']['name'] != '')
						{
							$config['upload_path'] = './assets/img/product/';
							$config['allowed_types'] = 'jpg|png';
							$config['max_size']	= '2000';
							$config['max_width']  = '2000';
							$config['max_height']  = '2000';

							$this->load->library('upload', $config);
							$this->upload->initialize($config);

							if (!$this->upload->do_upload())
							{
								$this->load->view('template',$data);
							}
							else
							{
								$pic = $this->upload->data();

								$data_form	=	array(
											'created_by'							=> $user_id,
											'category_id'							=> $category_id,
											'sub_category_id'						=> $sub_category_id,
											'product_name'							=> $product_name,
											'product_description'					=> $product_description,
											'product_recipe_id'						=> $product_recipe_id,
											'product_selling_price'					=> $product_selling_price,
											'product_tax'							=> $product_tax,
											'product_production_devices_id'			=> $production_devices_id,
											'product_service_time'					=> $product_service_time,
											'product_image'							=> $pic['file_name'],
											'product_available'						=> $product_status
											);

								$this->product_model->create($data_form);
								$this->session->set_flashdata('message_success','Proses Simpan Berhasil');
								redirect('product');
							}
						}
						else
						{
							$data_form	=	array(
											'created_by'							=> $user_id,
											'category_id'							=> $category_id,
											'sub_category_id'						=> $sub_category_id,
											'product_name'							=> $product_name,
											'product_description'					=> $product_description,
											'product_recipe_id'						=> $product_recipe_id,
											'product_selling_price'					=> $product_selling_price,
											'product_tax'							=> $product_tax,
											'product_production_devices_id'			=> $production_devices_id,
											'product_service_time'					=> $product_service_time,
											'product_image'							=> "nopic.gif",
											'product_available'						=> $product_status
											);

								$this->product_model->create($data_form);
								$this->session->set_flashdata('message_success','Proses Simpan Berhasil');
								redirect('product');
						}
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

	function edit($product_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '4'  OR $group_id == '15')
			{
				$data['content']		= 'product/product_edit';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Edit Produk';
				$data['reseps']			=  $this->product_model->selectresep($group_id);
				$data['gp']			    =  $this->product_model->get_paket($product_id);
				$data['resepspaket']    = $this->product_model->get_food_productall();

				$this->form_validation->set_rules('product_name','Nama Produk', 'trim|required');
				//$this->form_validation->set_rules('product_description','Deskripsi', 'trim|required');
				$this->form_validation->set_rules('product_service_time','Waktu Layanan', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					$data['products'] = $this->product_model->get_product_by_product_id($product_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id		= $this->session->userdata('user_id');
					$cid						= explode("#",$this->input->post('category_id'));
					$category_id				= $cid[0];
					//$category_id				= $this->input->post('category_id');
					$sub_category_id			= $this->input->post('sub_category_id');
					$product_name				= $this->input->post('product_name');
					$product_description		= $this->input->post('product_description');
					$product_recipe_id			= $this->input->post('product_recipe_id');
					$product_selling_price		= $this->input->post('product_selling_price');
					$product_tax				= $this->input->post('product_tax');
					$product_service_time		= $this->input->post('product_service_time');
					$production_devices_id		= $this->input->post('production_devices_id');
					$product_status				= $this->input->post('product_status');
					$pr_id						= $this->input->post('product_recipe_id');
					//print_r($pr_id);
					//exit();
						$length=count($pr_id)-1;
						for($i = 0; $i < $length; $i++) {
							$product_recipe_id=$pr_id[$i];
						}

					if($_FILES['userfile']['name'] != '')
					{
						$config['upload_path'] = './assets/img/product/';
						$config['allowed_types'] = 'jpg|png';
						$config['max_size']	= '2000';
						$config['max_width']  = '2000';
						$config['max_height']  = '2000';
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload())
						{
						$data['products'] = $this->product_model->find($product_id);
						$this->load->view('template',$data);
						}
						else
						{
							$pic = $this->upload->data();
							$data_form	=	array(
											'edited_time'							=> date('Y-m-d H:i:s'),
											'edited_by'								=> $user_id,
											'category_id'							=> $category_id,
											'sub_category_id'						=> $sub_category_id,
											'product_name'							=> $product_name,
											'product_description'					=> $product_description,
											'product_recipe_id'						=> $product_recipe_id,
											'product_selling_price'					=> $product_selling_price,
											'product_tax'							=> $product_tax,
											'product_production_devices_id'			=> $production_devices_id,
											'product_service_time'					=> $product_service_time,
											'product_image'							=> $pic['file_name'],
											'product_available'						=> $product_status
										);

							$this->product_model->update($product_id,$data_form);
							if( $cid[1]=='Paket'){
									//$prodid	= $this->db->insert_id();
									$this->db->trans_start();
									$this->product_model->delete_paket_detail($product_id);
									for($i = 0; $i < $length; $i++) {
										$product_recipe_id=$pr_id[$i];
										$this->product_model->insert_paket_detail($product_recipe_id,$product_id);
									}
									$this->db->trans_complete();
								}
							$this->session->set_flashdata('message_success','Proses Edit Berhasil');

							redirect('product');
						}
					}
					else
					{
						//echo"masuk sni";
						//exit();
						$data_form	=	array(
										'edited_time'							=> date('Y-m-d H:i:s'),
										'edited_by'								=> $user_id,
										'category_id'							=> $category_id,
										'sub_category_id'						=> $sub_category_id,
										'product_name'							=> $product_name,
										'product_description'					=> $product_description,
										'product_recipe_id'						=> $product_recipe_id,
										'product_selling_price'					=> $product_selling_price,
										'product_tax'							=> $product_tax,
										'product_production_devices_id'			=> $production_devices_id,
										'product_service_time'					=> $product_service_time,
										'product_available'						=> $product_status
									);
						//print_r($data_form);
						//exit();
						$sq=$this->product_model->update($product_id,$data_form);
						//echo $sq;
						//exit();
						if( $cid[1]=='Paket'){
									//$prodid	= $this->db->insert_id();
									//echo "masuk sni";
									//exit();
									$this->db->trans_start();
									$this->product_model->delete_paket_detail($product_id);
									for($i = 0; $i < $length; $i++) {
										$product_recipe_id=$pr_id[$i];
										$this->product_model->insert_paket_detail($product_recipe_id,$product_id);
									}
									$this->db->trans_complete();
								}
						$this->session->set_flashdata('message_success','Proses Edit Berhasil');
						redirect('product');
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

	function delete($product_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '4')
			{
				$this->product_model->delete($product_id);
				echo "Produk Berhasil dihapus";
				//redirect('product');
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

	function sub_category()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '14' OR $group_id == '16'  OR $group_id == '15')
			{
			     if($group_id=='14'){
			         $data['screcord'] = $this->product_model->get_sub_category3();
                }elseif($group_id=='16'){
                    $data['screcord'] = $this->product_model->get_sub_category2();
			     }else{
			         $data['screcord'] = $this->product_model->get_sub_category();
			     }

				$data['content']		= 'product/product_sub_category';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Sub Kategori';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function create_sub_category()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16'  OR $group_id == '15')
			{
				$data['content']		= 'product/product_create_sub_category';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Tambah Kategori';

				$this->form_validation->set_rules('sub_category_name','Nama Kategori', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
				    $division=1;
                    if($group_id =='14'){
                        $division=3;
                    }elseif($group_id=='16'){
                        $division=2;
                    }
					$data_form	=	array(
								'created_by'			=> $user_id,
								'created_time'			=> date('Y-m-d H:i:s'),
								'parent_category_id'	=> $this->input->post('parent_category_id'),
								'product_category_name'	=> set_value('sub_category_name'),
                                'division'		        =>          $division
								);

					$this->product_model->create_sub_category($data_form);
					$this->session->set_flashdata('message_success','Proses Simpan Berhasil');
					redirect('product/sub_category');
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

	function edit_sub_category($category_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '14' OR $group_id == '16'  OR $group_id == '15')
			{
				$data['content']		= 'product/product_edit_sub_category';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Edit Kategori';

				$this->form_validation->set_rules('sub_category_name','Nama Kategori', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['subcategory'] = $this->product_model->get_sub_category_by_product_sub_category_id($category_id);
					$this->load->view('template',$data);
				}
				else
				{
					$user_id			= $this->session->userdata('user_id');
					$category_id		= $this->input->post('category_id');
					$sub_category_id	= $this->input->post('sub_category_id');

					$data_form	=	array(
									'category_id'			=> $sub_category_id,
									'parent_category_id'	=> $category_id,
									'product_category_name'	=> set_value('sub_category_name')
									);

					$this->product_model->update_sub_category($sub_category_id,$data_form);
					$this->session->set_flashdata('message_success','Proses Edit Berhasil');
					redirect('product/sub_category');
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

	function delete_recipe($id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '14' OR $group_id == '16'  OR $group_id == '15')
			{

				$this->product_model->delete_product_recipe($id);
				$this->product_model->delete_product_recipe_detail($id);
				redirect('product/recipe');

			}
		}
		else
		{
			redirect('account/login');
		}
	}


    	function recipe_detail($id,$pname,$pcode)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18'  OR $group_id == '15')
			{
				$recipesdetail	= $this->product_model->get_product_recipe_detail_by_product_recipe_id($id);
				$data['recipesdetail'] = $recipesdetail;
                $data['pname'] =str_replace(")"," ",str_replace("("," ",str_replace('%20',' ',$pname))) ;
                $data['pcode'] = $pcode;
				$this->load->view('product/xl_recipe_detail',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	public function recipe()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '14' OR $group_id == '16' OR $group_id == '99' OR $group_id == '18'  OR $group_id == '15')
			{

				$data['reciperecord'] = $this->product_model->get_recipe($group_id);
				$data['content']		= 'product/product_recipe';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Cost of Product';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function generate_recipe_code()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				if($this->session->userdata('product_recipe_code') == TRUE)
				{
					redirect('product/recipe_cart');
				}
				else
				{
					$data['content']		= 'product/product_generate_recipe_code';
					$data['title']			= 'Produk';
					$data['sub_title']		= 'Tambah CoP';

					$data['countrecipe']	= $this->product_model->get_count_recipe();
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

	function recipe_material_add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18'  OR $group_id == '15')
			{
				$this->form_validation->set_rules('product_recipe_qty','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('product/recipe_cart');
				}
				else
				{
					$material_id		= $this->input->post('product_recipe_material_id');
					$qty				= $this->input->post('product_recipe_qty');

					$materials	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materials AS $material)
					{
						$material_name				= $material->material_name;
						$material_purchase_price	= $material->material_purchase_price;
						$material_purchase_unit		= $material->material_purchase_unit;
					}

					/*$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> $material_purchase_price,
							   'name'    	=> $material_name,
							   'options' 	=> ''
							);

					$this->cart->insert($data_form);*/
					$this->product_model->update_recipe_material($this->session->userdata('recipe_idx'),$material_id,$qty);
					redirect('product/recipe_cart');
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

	function recipe_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				$data['content']		= 'product/product_recipe_cart';
				$data['title']			= 'Produk';
				$data['sub_title']		= 'Tambah CoP';
				$recipesdetail	= $this->product_model->get_product_recipe_detail_by_product_recipe_id($this->session->userdata('recipe_idx'));
				$data['recipesdetail']		= $recipesdetail;

				if($this->session->userdata('product_recipe_code') == TRUE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$this->form_validation->set_rules('product_recipe_name','Nama Resep', 'trim|required');

					if($this->form_validation->run() == FALSE)
					{
						redirect('product/generate_recipe_code');
					}
					else
					{
						$countrecipe	= $this->product_model->get_count_recipe();
						foreach($countrecipe as $recipe)
						{
							$recipe_number	= $recipe->count + 1;
							$recipe_code	= $this->session->userdata('product_recipe_prefix_code') . $recipe_number;
						}
						$user_id	= $this->session->userdata('user_id');
						$session_data	= array(
											'product_recipe_created_time'	=> date('Y-m-d H:i:s',now()),
											'product_recipe_created_by'		=> $user_id,
											'product_recipe_code'					=> $recipe_code,
											'product_recipe_name'					=> $_POST['product_recipe_name'],
											'product_recipe_loss_cost_percent'		=> $_POST['product_recipe_loss_cost_percent'],
											'product_recipe_explanation'			=> $_POST['product_recipe_explanation']

											);
						$this->session->set_userdata($session_data);

						$this->db->insert('product_recipe',$session_data);
					    $recipe_id	= $this->db->insert_id();
						$session_data	= array(
											'recipe_idx'					=> $recipe_id

											);
						$this->session->set_userdata($session_data);
						$data['content']		= 'product/product_recipe_cart';
						$data['title']			= 'Produk';
						$data['sub_title']		= 'Tambah CoP';
						$recipesdetail	= $this->product_model->get_product_recipe_detail_by_product_recipe_id($this->session->userdata('recipe_idx'));
						$data['recipesdetail']		= $recipesdetail;
						$this->load->view('template',$data);
						//redirect('product/recipe_cart');
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

	function recipe_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			$user_id			= $this->session->userdata('user_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18'  OR $group_id == '15')
			{
				$this->form_validation->set_rules('grand_total','Grand Total', 'trim|required');

				if($this->form_validation->run() == FALSE)
				{
					redirect('product/recipe_cart');
				}
				else
				{
					//if ($this->cart->total_items() == FALSE)
					//{
						//$this->session->set_flashdata('message_error','Proses Simpan Gagal, Silakan coba kembali');
						//redirect('product/recipe_cart');
					//}
					//else
					//{
						//$is_processed = $this->product_model->create_recipe();
						$is_processed=TRUE;
						$cek=$_POST['cekresep'];
						if($cek==1){
						$data_form	=	array(
										'created_time'						=> date('Y-m-d H:i:s'),
										'created_by'						=> $user_id,
										'material_name'						=> $this->session->userdata('product_recipe_name'),
										'material_unit_id'					=> $_POST['material_unit_id'],
										'material_purchase_price'			=> $_POST['material_purchase_price'],
										'material_purchase_unit'			=> $_POST['material_purchase_unit'],
										'material_standard_stock'			=> $_POST['material_standard_stock'],
										'material_stock'					=> $_POST['material_standard_stock'],
										'material_bottom_line_stock'		=> "0",
										'finance_account_id'				=> "0",
										'satuan_beli'						=> $_POST['material_unit_id'],
										'material_type'						=> "stock",
										'product_recipe_id'					=> $this->session->userdata('recipe_idx')

										);

						$this->material_model->create_material($data_form);
					}
						if($is_processed)
						{
							$this->cart->destroy();
							$this->session->unset_userdata('product_recipe_code');
							$this->session->unset_userdata('product_recipe_name');
							$this->session->unset_userdata('product_recipe_explanation');
							$this->session->unset_userdata('recipe_idx');

							$this->session->set_flashdata('message_success','Proses Simpan Berhasil');
							redirect('product/recipe');
						}
						else
						{
							$this->session->set_flashdata('message_error','Proses Simpan Gagal, Silakan coba kembali');
							redirect('product/recipe_cart');
						}
					//}
				}
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function recipe_edit($product_recipe_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3'  OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				if ($this->session->userdata('product_recipe_edit_name') == FALSE)
				{
					$data['content']		= 'product/product_recipe_edit';
					$data['title']			= 'Produk';
					$data['sub_title']		= 'Edit CoP';

					$data['recipes'] 		= $this->product_model->get_product_recipe_by_product_recipe_id($product_recipe_id);
					$this->load->view('template',$data);
				}
				else
				{
					$data['content']		= 'product/product_recipe_edit';
					$data['title']			= 'Produk';
					$data['sub_title']		= 'Edit Resep';

					$data['recipes'] 		= $this->product_model->get_product_recipe_by_product_recipe_id($product_recipe_id);
					$this->load->view('template',$data);
					//redirect('product/recipe_edit_cart');
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


	function update_product_recipe_detail()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				$k=$this->product_model->update_product_recipe_detail($_POST['v_id'],$_POST['v_qty'],$_POST['product_recipe_edit_id']);
				$data = array(
					   'rowid' => $_POST['rowid'],
					   'qty'   => $_POST['v_qty']
						);
				$this->cart->update($data);

			}
		}

	}

	function recipe_edit_cart($product_recipe_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
			//$product_recipe_id						= $this->input->post('product_recipe_id');
				if($this->session->userdata('product_recipe_edit_name') == FALSE)
				{
					//echo "masuk sni"; exit();
					//$product_recipe_id						= $this->input->post('product_recipe_id');
					$product_recipe_edit_name				= $this->input->post('product_recipe_edit_name');
					$product_recipe_loss_cost_percent		= $this->input->post('product_recipe_loss_cost_percent');
					$product_recipe_edit_explanation		= $this->input->post('product_recipe_explanation');

					$session_data	= array(
										'product_recipe_edit_id'			=> $product_recipe_id,
										'product_recipe_edit_code'			=> $this->input->post('product_recipe_code'),
										'product_recipe_edit_name'			=> $product_recipe_edit_name,
										'product_recipe_loss_cost_percent'	=> $product_recipe_loss_cost_percent,
										'product_recipe_edit_explanation'	=> $product_recipe_edit_explanation
										);
					$this->session->set_userdata($session_data);

					$recipesdetail	= $this->product_model->get_product_recipe_detail_by_product_recipe_id($product_recipe_id);
					$data['content']		= 'product/product_recipe_edit_cart';
					$data['title']			= 'Produk';
					$data['sub_title']		= 'Edit CoP';
					$data['recipesdetail']  =$recipesdetail	;
					$data['prid']=$product_recipe_id;

					$this->load->view('template',$data);
					//print_r($recipesdetail);
					//exit();
					/*foreach($recipesdetail AS $recipedetail)
					{
						$materials	= $this->material_model->get_material_by_material_id($recipedetail->product_recipe_material_id);
						foreach($materials AS $material)
						{
							$material_purchase_price	= $material->material_purchase_price;
							$material_name				= $material->material_name;
						}

						$data_form = array(
									   'id' 		=> $recipedetail->product_recipe_material_id,
									   'qty'     	=> $recipedetail->product_recipe_qty,
									   'price'   	=> '0',
									   'name'    	=> $material_name,
									   'options' 	=> ''
									);

						$this->cart->insert($data_form);
					}
					redirect('product/recipe_edit_cart');*/
				}
				else
				{
					//$product_recipe_id						= $this->input->post('product_recipe_id');


					$recipesdetail	= $this->product_model->get_product_recipe_detail_by_product_recipe_id($product_recipe_id);
					$data['content']		= 'product/product_recipe_edit_cart';
					$data['title']			= 'Produk';
					$data['sub_title']		= 'Edit CoP';
					$data['recipesdetail']  =$recipesdetail	;
					$data['prid']=$product_recipe_id;

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

	function recipe_edit_cartlama()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id=='18')
			{
				if($this->session->userdata('product_recipe_edit_name') == FALSE)
				{
					$product_recipe_id						= $this->input->post('product_recipe_id');
					$product_recipe_edit_name				= $this->input->post('product_recipe_edit_name');
					$product_recipe_loss_cost_percent		= $this->input->post('product_recipe_loss_cost_percent');
					$product_recipe_edit_explanation		= $this->input->post('product_recipe_explanation');

					$session_data	= array(
										'product_recipe_edit_id'			=> $product_recipe_id,
										'product_recipe_edit_code'			=> $this->input->post('product_recipe_code'),
										'product_recipe_edit_name'			=> $product_recipe_edit_name,
										'product_recipe_loss_cost_percent'	=> $product_recipe_loss_cost_percent,
										'product_recipe_edit_explanation'	=> $product_recipe_edit_explanation
										);
					$this->session->set_userdata($session_data);

					$recipesdetail	= $this->product_model->get_product_recipe_detail_by_product_recipe_id($product_recipe_id);
					//print_r($recipesdetail);
					//exit();
					foreach($recipesdetail AS $recipedetail)
					{
						$materials	= $this->material_model->get_material_by_material_id($recipedetail->product_recipe_material_id);
						foreach($materials AS $material)
						{
							$material_purchase_price	= $material->material_purchase_price;
							$material_name				= $material->material_name;
						}

						$data_form = array(
									   'id' 		=> $recipedetail->product_recipe_material_id,
									   'qty'     	=> $recipedetail->product_recipe_qty,
									   'price'   	=> '0',
									   'name'    	=> $material_name,
									   'options' 	=> ''
									);

						$this->cart->insert($data_form);
					}
					redirect('product/recipe_edit_cart');
				}
				else
				{
					$data['content']		= 'product/product_recipe_edit_cart';
					$data['title']			= 'Produk';
					$data['sub_title']		= 'Edit Resep';

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
		function recipe_add_material_remove_from_cart($material_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->product_model->delete_recipe_material($this->session->userdata('recipe_idx'),$material_id);
			/*$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);*/
			redirect('product/recipe_cart');
		}
		else
		{
			redirect('account/login');
		}
	}
	function recipe_edit_material_remove_from_cart($rowid,$material_id,$prid)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->product_model->delete_recipe_material($this->session->userdata('product_recipe_edit_id'),$material_id);
			/*$data = array(
					   'rowid' => $rowid,
					   'qty'   => '0'
						);
			$this->cart->update($data);*/
			redirect('product/recipe_edit_cart/'.$prid);
		}
		else
		{
			redirect('account/login');
		}
	}

	function recipe_edit_material_add_to_cart()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3'  OR $group_id == '14'  OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				$this->form_validation->set_rules('product_recipe_qty','QTY', 'trim|required');
				if ($this->form_validation->run() == FALSE)
				{
					redirect('product/recipe_edit_cart/'.$this->session->userdata('product_recipe_edit_id'));
				}
				else
				{
					$material_id		= $this->input->post('product_recipe_material_id');
					$qty				= $this->input->post('product_recipe_qty');

					$materials	= $this->material_model->get_material_by_material_id($material_id);
					foreach($materials AS $material)
					{
						$material_name				= $material->material_name;
					}

					/*$data_form = array(
							   'id' 		=> $material_id,
							   'qty'     	=> $qty,
							   'price'   	=> '0',
							   'name'    	=> $material_name,
							   'options' 	=> ''
							);

					$this->cart->insert($data_form);*/
					$this->product_model->update_recipe_material($this->session->userdata('product_recipe_edit_id'),$material_id,$qty);
					redirect('product/recipe_edit_cart/'.$this->session->userdata('product_recipe_edit_id'));
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

	function recipe_update()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			$user_id			= $this->session->userdata('user_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				if ($this->session->userdata('product_recipe_edit_name') == FALSE)
				{
					redirect('product/recipe');
				}
				else
				{
					$data_form	=	array(
									'product_recipe_name'				=> $this->session->userdata('product_recipe_edit_name'),
									'product_recipe_loss_cost_percent'	=> $this->session->userdata('product_recipe_loss_cost_percent'),
									'product_recipe_explanation'		=> $this->session->userdata('product_recipe_edit_explanation')
									);

					$this->product_model->update_recipe($this->session->userdata('product_recipe_edit_id'),$data_form);

					//$cek=0;
					//$cek=$_POST['cekresep'];
					//if($cek==1){
						$data_form	=	array(

										'material_name'						=> $this->session->userdata('product_recipe_edit_name'),
										'material_purchase_price'			=> $_POST['material_purchase_price'],
										'material_purchase_unit'			=> $_POST['material_purchase_unit'],
										'material_standard_stock'			=> $_POST['material_standard_stock'],
										'material_stock'					=> $_POST['material_standard_stock']

										);
										//print_r($data_form);
										//exit();

						$this->product_model->update_material_recipre($this->session->userdata('product_recipe_edit_id'),$data_form);
						//exit();
					//}
					$this->cart->destroy();
					$session_data	= array(
									'product_recipe_edit_code'			=> '',
									'product_recipe_edit_name'			=> '',
									'product_recipe_loss_cost_percent'	=> '',
									'product_recipe_edit_explanation'	=> ''
									);
					$this->session->unset_userdata($session_data);
					$this->session->set_flashdata('message_success','Proses Simpan Berhasil');

					redirect('product/recipe');
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

	function recipe_cancel()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '14' OR $group_id == '16' OR $group_id == '18' OR $group_id == '4'  OR $group_id == '15')
			{
				$this->cart->destroy();
				 $this->product_model->delete_product_recipe($this->session->userdata('recipe_idx'));
				 $this->product_model->delete_product_recipe_detail($this->session->userdata('recipe_idx'));
				$session_data	= array(
									'product_recipe_code'			=> '',
									'product_recipe_name'			=> '',
									'product_recipe_explanation'	=> '',
									'recipe_idx'					=> ''
									);
				$this->session->unset_userdata($session_data);



				redirect('product/recipe');
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

	function recipe_edit_cancel()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));
			$user_id			= $this->session->userdata('user_id');

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id=='18')
			{
				$this->cart->destroy();
				$session_data	= array(
									'product_recipe_edit_code'			=> '',
									'product_recipe_edit_name'			=> '',
									'product_recipe_edit_explanation'	=> ''
									);
				$this->session->unset_userdata('product_recipe_edit_code');
				$this->session->unset_userdata('product_recipe_edit_name');
				$this->session->unset_userdata('product_recipe_edit_explanation');

				$this->session->unset_userdata($session_data);
				redirect('product/recipe');
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

/* End of file product.php */
/* Location: ./application/controllers/product.php */
