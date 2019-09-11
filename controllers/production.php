<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Production extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}
	
	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');

				//$data['materialsrecord'] = $this->material_model->get_materials();
				$data['content']		= 'production/orders';
				$data['title']			= 'Production';
				$data['sub_title']		= 'Data Production';

				$this->load->view('template',$data);
			
		}
		else
		{
			redirect('account/login');
		}
	}
	
/*	function index()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->orders();
		}
		else
		{
			redirect('account/login');
		}
	}*/
	
	function orders()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$this->load->view('production/orders');
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function content()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['ordersrecord']	= $this->production_model->get_orders();
			$data['ordersrecordpaket']	= $this->production_model->get_orderspaket();
			$data['ordersrecorddone']	= $this->production_model->get_ordersdone();
			$data['ordersrecorddonepaket']	= $this->production_model->get_ordersdonepaket();
			$this->load->view('production/orders_content',$data);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function cooked()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$order_id	= $this->input->post('order_id');
			$product_id	= $this->input->post('product_id');
			$qty	= $this->input->post('qty');
			$st	= $this->input->post('st');
			$created_by = $this->session->userdata('user_id');
			$this->db->trans_start();
			$this->production_model->update_status_cooked($order_id);
			$this->production_model->update_inprogress_time($order_id);
			$this->production_model->insert_logistic($product_id,$qty,$created_by);
			$am	= $this->production_model->select_updatematerial($product_id,$qty);
			foreach($am AS $dam)
			{
				$this->production_model->updateqtymaterial($dam->material_id,$dam->rqty,$created_by);
			}
			$this->db->trans_complete();
			
			
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function finished_cooked()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$order_id	= $this->input->post('order_id');
			
			$this->production_model->update_status_finished_cooked($order_id);
			$this->production_model->update_status_finished_time($order_id);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function done_cooked()
	{
		if($this->session->userdata('is_logged_in') == TRUE)
		{
			$order_id	= $this->input->post('order_id');
			
			$this->production_model->update_status_done_cooked($order_id);
			$this->production_model->update_status_done_time($order_id);
		}
		else
		{
			redirect('account/login');
		}
	}
	
}

/* End of file production */
/* Location: ./application/controllers/production.php */