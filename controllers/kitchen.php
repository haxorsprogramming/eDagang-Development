<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kitchen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->setting_model->index();
	}
	
	function index()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$this->orders();
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function orders()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$this->load->view('kitchen/kitchen_orders');
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function content()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$data['foodsrecord']	= $this->kitchen_model->get_food_orders();
			$data['drinksrecord']	= $this->kitchen_model->get_drink_orders();
			$data['urgentrecord']	= $this->kitchen_model->get_urgent_orders();
			
			$this->load->view('kitchen/kitchen',$data);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function cooked()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$id	= $this->input->post('id');
			
			$this->kitchen_model->update_status_cooked($id);
			$this->kitchen_model->update_inprogress_time($id);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function finished_cooked()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$id	= $this->input->post('id');
			
			$this->kitchen_model->update_status_finished_cooked($id);
			$this->kitchen_model->update_status_finished_time($id);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function done_cooked()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$id	= $this->input->post('id');
			
			$this->kitchen_model->update_status_done_cooked($id);
			$this->kitchen_model->update_status_done_time($id);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function foods()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$this->load->view('kitchen/foods');
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function foods_content()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{	
			$data['foodsrecord']		= $this->kitchen_model->get_food_orders();
			$data['urgentfoodrecord']	= $this->kitchen_model->get_urgent_food_orders();
			
			$this->load->view('kitchen/food_orders',$data);
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function drinks()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$this->load->view('kitchen/drinks');
		}
		else
		{
			redirect('account/login');
		}
	}
	
	function drinks_content()
	{
		if($this->input->ip_address($this->session->userdata('ip_address_kitchen')) OR $this->input->ip_address($this->session->userdata('ip_address_bar')))
		{
			$data['drinksrecord']		= $this->kitchen_model->get_drink_orders();
			$data['urgentdrinkrecord']	= $this->kitchen_model->get_urgent_drink_orders();
			
			$this->load->view('kitchen/drink_orders',$data);
		}
		else
		{
			redirect('account/login');
		}
	}

}

/* End of file kitchen.php */
/* Location: ./application/controllers/kitchen.php */