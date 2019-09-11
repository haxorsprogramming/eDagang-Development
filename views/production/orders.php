<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->session->userdata('company_name');?> - Orders - <?php echo $this->session->userdata('app_name') .' '. $this->session->userdata('app_version')?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css">
		
	<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	
	<!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">	
		
  </head>
  
	<script type="text/javascript">
		setInterval("auto_refresh_function();", 3000);
		function auto_refresh_function() {
			$('#load_content').load('<?php echo base_url();?>production/content');
		}
		
		function readCookie(name){
			return(document.cookie.match('(^|; )'+name+'=([^;]*)')||0)[2]
		}
	</script>
    <body onScroll="document.cookie='ypos=' + window.pageYOffset" onLoad="window.scrollTo(0,readCookie('ypos'))">
	<div class="content-wrapper">
		<div id="load_content"><h1 align="center">Loading...</h1></div>
	</div>
	</body>
</html>
	