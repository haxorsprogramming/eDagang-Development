<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}	
	
	function index()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '99')
			{
				$data['inventoryrecord'] = $this->inventory_model->get_inventory_today();
				$data['content']		= 'inventory/summary';
				$data['title']			= 'Inventory';
				$data['sub_title']		= 'Inventory';

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
	
	function search()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));
			
			$group_id = $this->session->userdata('group_id');
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '99')
			{
				$start_date	= date('Y-m-d',strtotime($this->input->post('start_date')));
				$end_date	= date('Y-m-d',strtotime($this->input->post('end_date')));
				
				$data['inventorysrecord'] = $this->inventory_model->get_inventory($start_date,$end_date);
				$data['start_date']	= date('d-m-Y',strtotime($start_date));
				$data['end_date']	= date('d-m-Y',strtotime($end_date));
				
				$data['content']		= 'inventory/inventory_search';
				$data['title']			= 'Inventory';
				$data['sub_title']		= 'Data Inventory';

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

/* End of file inventory.php */
/* Location: ./application/controllers/inventory.php */