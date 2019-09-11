<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($title)) echo $title . ' - ' . $sub_title;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/all.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <!--link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <!--link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
	<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/buttons.dataTables.min.css">

	<!-- Datetime Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">

	<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script>
function tandaPemisahTitik(b){
	var _minus = false;
	if (b<0) _minus = true;
	b = b.toString();
	b=b.replace(".","");

	c = "";
	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--){
		 j = j + 1;
		 if (((j % 3) == 1) && (j != 1)){
		   c = b.substr(i-1,1) + "." + c;
		 } else {
		   c = b.substr(i-1,1) + c;
		 }
	}
	if (_minus) c = "-" + c ;
	return c;
}

function numbersonly(ini, e){
	if (e.keyCode>=49){
		if(e.keyCode<=57){
		a = ini.value.toString().replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
		ini.value = tandaPemisahTitik(b);
		return false;
		}
		else if(e.keyCode<=105){
			if(e.keyCode>=96){
				//e.keycode = e.keycode - 47;
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
				ini.value = tandaPemisahTitik(b);
				//alert(e.keycode);
				return false;
				}
			else {return false;}
		}
		else {
			return false; }
	}else if (e.keyCode==48){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}
	}else if (e.keyCode==95){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}
	}else if (e.keyCode==8 || e.keycode==46){
		a = ini.value.replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = b.substr(0,b.length -1);
		if (tandaPemisahTitik(b)!=""){
			ini.value = tandaPemisahTitik(b);
		} else {
			ini.value = "";
		}

		return false;
	} else if (e.keyCode==9){
		return true;
	} else if (e.keyCode==17){
		return true;
	} else {
		//alert (e.keyCode);
		return false;
	}

}

</script>

<style media="screen">
@media screen and (min-width: 601px) {
  a.table {
    font-size: 45px;
  }
  center.time{
    font-size: 15px;
  }
  .menu {
    font-size: 15px;
  }
}

@media screen and (max-width: 600px) {
  a.table {
    font-size: 10px;
  }
  center.time{
    font-size: 7px;
  }
  .menu {
    font-size: 9px;
  }
}
</style>
  </head>
  <?
  if($this->session->userdata('group_id') == '6' or $this->session->userdata('group_id') == '7'
  or $this->session->userdata('group_id') == '10'  or $this->session->userdata('group_id') == '11'
  or $this->session->userdata('group_id') == '15' or $this->session->userdata('group_id') == '17'
  or $this->session->userdata('reservation') == 'reservation'){
  ?>
    <body class="hold-transition skin-green-light fixed sidebar-collapse sidebar-mini">
    <?
  }else{
	  ?>
      <body class="sidebar-mini skin-green-light fixed">
      <?
  }
    ?>
		<div class="wrapper">
