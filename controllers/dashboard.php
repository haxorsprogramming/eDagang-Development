<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {

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
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '99')
			{
                $first_day_this_month = date('01-m-Y');
				$last_day_this_month  = date('t-m-Y');

				$lastMonth = $first_day_this_month;
				$thisMonth = $last_day_this_month;

				$data['lastMonth'] = $lastMonth;
				$data['thisMonth'] = $thisMonth;
                
				$data['content']	= 'dashboard/dashboard';
				$data['title']		= 'Home';
				$data['sub_title']	= 'Dashboard';

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

	function content()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '99')
			{

				$first_day_this_month = date('Y-m-01');
				$last_day_this_month  = date('Y-m-t');

				$lastMonth = $first_day_this_month;
				$thisMonth = $last_day_this_month;

				$data['lastMonth'] = $lastMonth;
				$data['thisMonth'] = $thisMonth;

				$data['counttransactions']	= $this->dashboard_model->get_count_transactions($lastMonth,$thisMonth);
				$data['countproducts']		= $this->dashboard_model->get_count_products();
				$data['countsales']			= $this->dashboard_model->get_count_sales($lastMonth,$thisMonth);
				$data['countmember']		= $this->dashboard_model->get_count_members();
				$data['topordersrecord']	= $this->dashboard_model->get_top_orders();
				$data['topfoodsrecord']	= $this->dashboard_model->get_top_foods($lastMonth,$thisMonth);
				$data['topdrinksrecord']	= $this->dashboard_model->get_top_drinks($lastMonth,$thisMonth);
				$data['membersrecord']		= $this->dashboard_model->get_latest_members($lastMonth,$thisMonth);
				$data['topwaitersrecord']	= $this->dashboard_model->get_top_waiters($lastMonth,$thisMonth);
				$data['topcustomer']= $this->dashboard_model->get_top_customer($lastMonth,$thisMonth);
				$data['ordersrecord']		= $this->dashboard_model->get_latest_orders($lastMonth,$thisMonth);
				$data['productsrecord']		= $this->dashboard_model->get_latest_products($lastMonth,$thisMonth);

				$data['title']			= 'Home';
				$data['sub_title']		= 'Dashboard';

				$this->load->view('dashboard/dashboard_content',$data);
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


	function content_by_date()
	{
		if ($this->session->userdata('is_logged_in') == TRUE)
		{
			$data['userrecord'] 	= $this->account_model->get_user_by_username($this->session->userdata('username'));

			$group_id = $this->session->userdata('group_id');
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '99')
			{
				$startDate = $this->input->get('startDate');
				$endDate = $this->input->get('endDate');
				$thisMonth = date('Y-m-d',strtotime($endDate));
				$lastMonth = date('Y-m-d',strtotime($startDate));

				$data['lastMonth'] = $lastMonth;
				$data['thisMonth'] = $thisMonth;

				$data['counttransactions']	= $this->dashboard_model->get_count_transactions($lastMonth,$thisMonth);
				$data['countproducts']		= $this->dashboard_model->get_count_products();
				$data['countsales']			= $this->dashboard_model->get_count_sales($lastMonth,$thisMonth);
				$data['countmember']		= $this->dashboard_model->get_count_members();
				$data['topordersrecord']	= $this->dashboard_model->get_top_orders();
				$data['topfoodsrecord']	= $this->dashboard_model->get_top_foods($lastMonth,$thisMonth);
				$data['topdrinksrecord']	= $this->dashboard_model->get_top_drinks($lastMonth,$thisMonth);
				$data['membersrecord']		= $this->dashboard_model->get_latest_members($lastMonth,$thisMonth);
				$data['topwaitersrecord']	= $this->dashboard_model->get_top_waiters($lastMonth,$thisMonth);
				$data['topcustomer']= $this->dashboard_model->get_top_customer($lastMonth,$thisMonth);
				$data['ordersrecord']		= $this->dashboard_model->get_latest_orders($lastMonth,$thisMonth);
				$data['productsrecord']		= $this->dashboard_model->get_latest_products($lastMonth,$thisMonth);
				$data['title']			= 'Home';
				$data['sub_title']		= 'Dashboard';
				$this->load->view('dashboard/dashboard_content',$data);
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

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
