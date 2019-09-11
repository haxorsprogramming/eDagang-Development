<?php
$group_id	= $this->session->userdata('group_id');
if (isset($userrecord))
{
	foreach($userrecord AS $row)
	{
	?>
	<header class="main-header">
		<!-- Logo -->
        <a href="<?php echo base_url();?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>eD</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo $this->config->item('app_name');?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
		  <label class="hidden-xs">
				<font size="6" style="color:white;text-align:center;"><?php if(isset($sub_title)) echo $sub_title;?></b></font>
			</label>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
				<?php
				if ($group_id == '6')
				{
					if($this->session->userdata('open_shift') == '')
					{
						$incomes = $this->cashier_model->income_cash_by_cashier_id($this->session->userdata('user_id'));
						foreach($incomes as $row)
						{
							$income	= $row->total;
						}
					}
					if($this->session->userdata('open_shift') == '' AND $this->session->userdata('closed_shift') == '')
					{
					?>
				<?php
					}
				}
				  if($group_id == 1 OR $group_id == 2 OR $group_id == 3)
				  {
				  ?>
				  <?php
				  }
					?>
				 <!-- User Account: style can be found in dropdown.less -->
				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <img src="<?php echo base_url();?>assets/img/user/avatar6.png" class="user-image" alt="User Image">
					  <span class="hidden-xs"><?php echo $this->session->userdata('full_name')?></span>
					</a>
					<ul class="dropdown-menu">
					  <!-- User image -->
					  <li class="user-header">
						<img src="<?php echo base_url();?>assets/img/user/avatar6.png" class="img-circle" alt="User Image">
						<p>
						  <?php echo $this->session->userdata('full_name');?>

						</p>
					  </li>
					  <li class="user-footer">
						<div class="pull-left">
						  <a href="<?php echo base_url();?>account/change_password" class="btn btn-default btn-flat">Ganti Password</a>
						</div>
            <div class="pull-right">
						  <a href="#" class="btn btn-default btn-flat">Pin : <?php echo $this->session->userdata('dbpin');?></a>
						</div>
					  </li>
					</ul>
				  </li>
				  <li>
					  <a href="<?php echo base_url();?>account/logout" title="Logout">
						<span class="glyphicon glyphicon-log-out"><span>
					  </a>
					</li>
            </ul>
          </div>
        </nav>

      </header>

	<?php
	}
}
?>
