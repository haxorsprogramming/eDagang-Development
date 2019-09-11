<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}

    function kode_material($jen,$id){
        $k="";
        if($jen=='asset'){
            $k="A";
        }elseif($jen=='non_stock'){
            $k="NP";
        }elseif($jen=='stock'){
            $k="P";
        }elseif($jen=='stock_beauty'){
            $k="SB";
        }elseif($jen=='stock_studio'){
            $k="SS";
        }
        return $k.$id;

    }

    	function persediaan()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '18' or $group_id=='16' or $group_id=='14')
			{
			     //$mt=$_POST['mt'];
                 //if(isnull($mt)){
                    $mt='stock';
                    $tgl1=date('01-m-Y');
                    $tgl2=date('d-m-Y');
                 //}
				$data['materialsrecord'] = $this->material_model->persediaan($mt,$tgl1,$tgl2);
				$data['content']		= 'material/persediaan';
				$data['title']			= 'Material';
                $data['con']			= $this;
                $data['mt']			= $mt;
                $data['tgl1']			= $tgl1;
                $data['tgl2']			= $tgl2;
				$data['sub_title']		= 'Persediaan Material';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

     	function persediaan_search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id=='14' or $group_id=='16' OR $group_id == '3' OR $group_id == '4' OR $group_id == '18')
			{
			     $mt=$_POST['mt'];
                 $tgl1=$_POST['tgl1'];
                 $tgl2=$_POST['tgl2'];

				$data['materialsrecord'] = $this->material_model->persediaan($mt,$tgl1,$tgl2);
				$data['content']		= 'material/persediaan';
				$data['title']			= 'Material';
                $data['con']			= $this;
                $data['mt']			= $mt;
                $data['tgl1']			= $tgl1;
                $data['tgl2']			= $tgl2;
				$data['sub_title']		= 'Persediaan Material';

				$this->load->view('template',$data);
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
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '7' OR $group_id == '8' OR $group_id == '9'OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' or $group_id == '18')
			{
				$data['materialsrecord'] = $this->material_model->get_materials($group_id);
				$data['content']		= 'material/material_list';
				$data['title']			= 'Material';
                $data['controller']			= $this;
				$data['sub_title']		= 'Material';

				$this->load->view('template',$data);
			}
		}
		else
		{
			redirect('account/login');
		}
	}

	function stock_opname(){
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '8' OR $group_id == '9' OR $group_id == '18')
			{
				$ids=$_POST['txtid'];
				$ts=$_POST['txtstock'];
				$tse=$_POST['txtstockedit'];
				$p_no=$_POST['p_no'];
				if($p_no==''){
					$this->session->set_flashdata('message_error','Silahkan masukkan no opname');
				}else{
					$length = count($ids);
					for($i = 0; $i < $length; $i++) {
						if($ts[$i] != $tse[$i]){
					$this->material_model->material_opname( $ids[$i] ,$tse[$i] ,$this->session->userdata('user_id'),$p_no);
						}
					}
					$this->session->set_flashdata('message_success','Stok Opname berhasil.');
					}
				redirect('material');
			}
			else
			{
				redirect('material');
			}
		}
		else
		{
			redirect('users/login');
		}
	}
	function units()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '7' OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' OR $group_id == '4' OR $group_id == '18')
			{
				$data['unitsrecord']	= $this->material_model->get_units();

				$data['content']		= 'material/material_unit';
				$data['title']			= 'Material';
				$data['sub_title']		= 'Data Satuan';

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

	function unit_create()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id	= $this->session->userdata('group_id');

			if($group_id == '1' OR $group_id == '2' OR $group_id == '7' OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' OR $group_id == '4' OR $group_id == '18')
			{
				$data['content']		= 'material/material_unit_create';
				$data['title']			= 'Material';
				$data['sub_title']		= 'Tambah Satuan';

				$this->form_validation->set_rules('name','Nama Unit', 'trim|required|min_length[1]');

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$user_id	= $this->session->userdata('user_id');
					$name		= $this->input->post('name');
					$kode		= $this->input->post('kode');

					$data_form	=	array(
										'created_time'				=> date('Y-m-d H:i:s'),
										'created_by'				=> $user_id,
										'material_unit_name'		=> $name,
										'material_unit_code_name'	=> $kode
										);

					$this->material_model->unit_create($data_form);

					$this->session->set_flashdata('message_success','Penambahan Unit berhasil.');
					redirect('material/units');
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
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id	= $this->session->userdata('group_id');

			if($group_id == '1' OR $group_id == '2' OR $group_id == '8' OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' OR $group_id == '4' OR $group_id == '18')
			{
				$data['content']		= 'material/material_create';
				$data['title']			= 'Material';
				$data['sub_title']		= 'Tambah Material';

				$this->form_validation->set_rules('material_name','Nama Material', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('material_purchase_price','Harga Pembelian (Satuan)', 'trim|required');
				$this->form_validation->set_rules('material_purchase_unit','Jumlah Pembelian (Satuan)', 'trim|required');
				$this->form_validation->set_rules('material_bottom_line_stock','Batas Bawah Stock', 'trim|required');
				$this->form_validation->set_rules('jstok','Jenis Stok', 'trim|required');
				$this->form_validation->set_rules('satuan_beli','Satuan Beli', 'trim|required');
				$this->form_validation->set_rules('konversi','Konversi', 'trim|required');


				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('template',$data);
				}
				else
				{
					$user_id				= $this->session->userdata('user_id');
					$material_unit_id		= $this->input->post('material_unit_id');
					//$material_account_id	= $this->input->post('material_account_id');
					$satuan_beli			= $this->input->post('satuan_beli');
					$jstok					= $this->input->post('jstok');
					$konversi				= $this->input->post('konversi');
					$kategori_material				= $this->input->post('kategori_material');

					$data_form	=	array(
										'created_time'						=> date('Y-m-d H:i:s'),
										'created_by'						=> $user_id,
										'material_name'						=> set_value('material_name'),
										'material_unit_id'					=> $material_unit_id,
										'material_purchase_price'			=> set_value('material_purchase_price'),
										'material_purchase_unit'			=> set_value('material_purchase_unit'),
										'material_standard_stock'			=> $this->input->post('material_standard_stock'),
										'material_bottom_line_stock'		=> set_value('material_bottom_line_stock'),
										//'finance_account_id'				=> $material_account_id,
										'satuan_beli'						=> $satuan_beli,
										'material_type'						=> $jstok,
										'konversi'							=> $konversi,
										'kategori_material'					=> $kategori_material
										);

					$this->material_model->create_material($data_form);

					$this->session->set_flashdata('message_success','Penambahan Material berhasil.');
					redirect('material');
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

	function edit($material_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] = $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '8' OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' OR $group_id == '4' OR $group_id == '18')
			{
				$data['content']		= 'material/material_edit';
				$data['title']			= 'Material';
				$data['sub_title']		= 'Edit Material';
                $data['controller']			= $this;

				$this->form_validation->set_rules('material_name','Nama Material', 'trim|required');
				$this->form_validation->set_rules('jstok','Jenis Stok', 'trim|required');
				$this->form_validation->set_rules('satuan_beli','Satuan Beli', 'trim|required');
				$this->form_validation->set_rules('konversi','Konversi', 'trim|required');

				if ($this->form_validation->run() == FALSE)
				{
					$data['materials'] = $this->material_model->get_material_by_material_id($material_id);
					$this->load->view('template',$data);
				}
				else
				{
					$material_unit_id			= $this->input->post('material_unit_id');
					$material_standard_stock	= $this->input->post('material_standard_stock');
					$satuan_beli				= $this->input->post('satuan_beli');
					$jstok						= $this->input->post('jstok');
					$konversi					= $this->input->post('konversi');
					$kategori_material			= $this->input->post('kategori_material');
                    //$material_account_id	    = $this->input->post('material_account_id');
					$data_form	=	array(
									'material_name'				=> set_value('material_name'),
									'material_unit_id'			=> $material_unit_id,
									'material_standard_stock'	=> $material_standard_stock,
									'satuan_beli'				=> $satuan_beli,
									'material_type'				=> $jstok,
									'konversi'					=> $konversi,
									'kategori_material'			=> $kategori_material,
									'material_purchase_price'	=> $this->input->post('material_purchase_price'),
									'material_purchase_unit'	=> $this->input->post('material_purchase_unit'),
                                    //'finance_account_id'		=> $material_account_id,
									);

					$this->material_model->update_material($material_id,$data_form);
					redirect('material');
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

	function delete($material_id)
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '4' OR $group_id == '18')
			{
				if($this->material_model->hapus_material($material_id) == TRUE);
				{
					redirect('material');
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


}

/* End of file material.php */
/* Location: ./application/controllers/material.php */
