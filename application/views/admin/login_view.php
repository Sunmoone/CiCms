<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head> 
<title>CiCms管理后台</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="LAMP 开发 定制 PHP Web Design Coding WebDesign 互联网开发">
<meta name="author" content="Geek-Zoo">
<meta name="Keywords" content="Web Design PHP Coding WebDesign">
<meta name="Copyright" content="Geek-Zoo.com">
<meta content="All" name="Robots">
<!-- CSS : implied media="all" -->
<base href="<?php echo base_url();?>" />
<link rel="stylesheet" href="application/views/admin/css/style.css">
<link rel="stylesheet" href="application/views/admin/css/layout.css">
<!-- JS -->
<script src="application/views/admin/js/jquery-1.7.1.min.js"></script>
<script src="application/views/admin/js/ui.js"></script>
<script type="text/javascript" charset="utf-8">
  __SITE_URL__ = '<?php echo base_url();?>';
	__THEME__ = '<?php echo base_url();?>/application/views/admin';
</script>
<!-- Cufon -->
<script src="application/views/js/cufon-yui.js" type="text/javascript"></script>
<script src="application/views/js/caviar-dreams.cufonfonts.js" type="text/javascript"></script>
<script type="text/javascript">
Cufon.replace('.caviar_dreams_bold_italic', { fontFamily: 'Caviar Dreams Bold Italic', hover: true }); 
Cufon.replace('.caviar_dreams_bold', { fontFamily: 'Caviar Dreams Bold', hover: true }); 
Cufon.replace('.caviar_dreams_italic', { fontFamily: 'Caviar Dreams Italic', hover: true }); 
Cufon.replace('.caviar_dreams', { fontFamily: 'Caviar Dreams', hover: true }); 
</script>
</head>
<body class="new">
<div style="margin: 0 auto;padding: 40px 0 20px 0;height: 60px;width: 520px;"> 
	<div class="fr ico_home"><a href="<?php echo base_url();?>">返回首页</a></div>
	<div class="fl" style="margin:30px 0 0"><h1 class="caviar_dreams" style="font-size:3em"><a href="<?php echo base_url();?>">CiCms</a></h1></div>
</div>
<!--header end-->
<div class="login_content clearfix">
	<?php if (validation_errors()) {?>
	<div class="error"><?php echo validation_errors();?></div>
	<?php }?>
	<?php echo (($this->session->flashdata('success')))?'<div class="success"><ul><li>' . $this->session->flashdata('success') . '</li></ul></div>':'';?>
	<?php echo (($this->session->flashdata('error')))?'<div class="error"><ul><li>' . $this->session->flashdata('error') . '</li></ul></div>':'';?>
	<?php $attributes = array('id' => 'login');?>
	<?php echo form_open('admin/verifylogin', $attributes);?>
		<dl class="login_form clearfix">
			<dt class="fl">用户名:</dt><dd class="fl"><input type="text" name="username" /></dd>
			<dt class="fl">密&nbsp;&nbsp;&nbsp;&nbsp;码:</dt><dd class="fl"><input type="password" name="password" /></dd>
			<dt class="fl">&nbsp;</dt><dd class="fl btn"><a href="" class="btn1 fr submit">登陆</a></dd>
		</dl>
	</form>	
</div>
<script type="text/javascript" charset="utf-8">
	$('.submit').click(function(){
		  $("#login").submit();
		return false;
	});

	$('input').keydown(function(event){
		if (event.keyCode == 13){
		  $("#login").submit();
		};
	});
</script>
</body>
</html>
