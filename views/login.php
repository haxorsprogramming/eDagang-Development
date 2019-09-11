<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('app_name');?> v<?php echo $this->config->item('app_version');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!--link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css"-->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- iCheck -->
    <!--link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css"-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
      .loginform
      {
        box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        border-radius: 20px;
      }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
		<?php
		if($this->session->userdata('company_logo') == TRUE)
		{
		?>
        <a href="."><img src="<?php echo base_url();?>assets/img/<?php echo $this->session->userdata('company_logo');?>" width="250"></a>
		<?php }?>
      </div><!-- /.login-logo -->
	  <div>
	  </div>
      <div class="login-box-body loginform">
        <center>
          <h4><?php echo $this->session->userdata('company_name')?></h4>
          <h4><?php echo $this->session->userdata('company_address')?></h4>
          <h4><?php echo $this->session->userdata('company_telp')?></h4>
        </center>
      <div id="loading"></div>
        <!--p class="login-box-msg">Sign in to start your session</p-->
        <?php //echo form_open('account/validate_login');
		echo validation_errors();
		if ($this->session->flashdata('message_error')) echo '<div class="alert alert-danger"><h5>'.$this->session->flashdata('message_error').'</h5></div>';?>
          <div class="form-group has-feedback">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus >
            <!--span class="glyphicon glyphicon-user form-control-feedback"></span-->
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password"  id="password" class="form-control" placeholder="Password"  >
            <!--span class="glyphicon glyphicon-lock form-control-feedback"></span-->
          </div>
		<div>
		  <button type="button" id="btnlogin" onClick="loginn()" class="btn btn-success btn-block btn-lg" >Login</button>
		</div><!-- /.col -->
        <br>
        <center>v<?php echo $this->config->item('app_version');?></center>
		  <?php //echo form_close();?>
          <script>
		  $("#username").focus();
		  	$('#username').keypress(function(e) {
				if(e.keyCode == 13) {
					$("#password").focus();
					//$(this).next('input').focus();
					//alert('sss');
				}
			});

			$("#password").keypress(function(e){
			if(e.keyCode==13){

			//$("#btnlogin").focus();
			loginn();
			}

			//return false;
			});

			//$("#btnlogin").keypress(function(e){
//			if(e.keyCode==13){
//				loginn();
//				//$("#btnlogin").focus();
//			//login();
//			}
//
//			//return false;
//			});
			function loginn(){
				var username=$("#username").val();
				var password=$("#password").val();
				$("#btnlogin").text("Authentication Process...");
				 $.ajax({

											 type: "POST",
											 url: "<?php echo base_url();?>account/validate_login",
											 data: "username="+username+"&password="+password,
											 success: function(msg){
											    // alert(msg);
													//$('#divreviewkat').load('<?=base_url()?>order/reviewkat');
													window.location='<?=base_url()?>account/validate_login';

												}
										  });
			}
		  </script>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->

    <!-- Bootstrap 3.3.5 -->
    <!--script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script-->
    <!-- iCheck -->
    <!--script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script-->
  </body>
</html>
