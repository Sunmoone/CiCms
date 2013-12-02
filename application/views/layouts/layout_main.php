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
<!--header start-->
<div class="header"> 
	<div class="fl"><h1 class="caviar_dreams" style="font-size:3em"><a href="<?php echo base_url();?>">CiCms Admin Panel </h1></a></div>
			<!-- <img src="application/views/admin/images/logo.png" class="fl"> --><!-- <img src="{$smarty.const.THEME_URL}/images/banner.png" class="fll" width="650px" height="65px"> --></a>
	<div class="header_login clearfix">
		欢迎管理员：<?php echo $this->admin_user['username'];?>&nbsp;&nbsp;
		<img src="application/views/admin/images/checked_out.png"><a href="admin/dashboard/changePassword">修改密码</a>&nbsp;&nbsp;
		<!-- <img src="application/views/admin/images/write.gif"><a href="">修改资料</a> -->
		<a class="btn_logout" href="admin/login/logout">登出</a>&nbsp;&nbsp;
	</div>
</div>
<!--header end-->

<div class="container clearfix">
	<div class="sidebar">
		<dl class="sidemenu1">
			<dt><a href="admin/dashboard"><img src="application/views/admin/images/imgs/0.png" width="16" height="16" alt="首页" style="border: none; vertical-align: middle; padding-right: 3px; margin-top: -4px;" />首页</a></dt>
		</dl>
	  <?php $i = 1;?>
	  <?php foreach ($menu as $key => $val) {?>
		<dl class="sidemenu<?php if (in_array($admin_url, $val)){?> show<?php }?>">
			<dt><a href="javascript:void(0);"><img src="application/views/admin/images/imgs/<?php echo $i;?>.png" width="16" height="16" alt="" style="border: none; vertical-align: middle; padding-right: 3px; margin-top: -4px;" /><?php echo $key;?></a></dt>
			<?php foreach ($val as $k => $v) {?>
			<dd><a href="<?php echo $v;?>"><?php echo $k;?></a></dd>
			<?php }?>
		</dl>
	  <?php $i++;}?>
	  
	</div>

<script type="text/javascript" charset="utf-8">

menu_index = '';
menu_current = '';

$('.sidebar dt a').click(function(){
  //$.cookie('menu_index', $(this).parents('dl').index(), { expires: 7, path: '/' });
  if ($(this).parents('dl').find('dd').size() != 0) {
	  menu_index = $(this).parents('dl').index();
	  $('.sidebar dl').removeClass('show');
	  $(this).parents('dl').addClass('show');
	  
	  return false;
  }

});

$('.sidebar dd a').click(function(){
	menu_current = $(this).index('.sidebar dd a');
	var href = this.href;
	location.href = href+'?menu_index='+menu_index+'&menu_current='+menu_current;
	return false;
    //$.cookie('menu_current', $(this).index('.sidebar dd a'), { expires: 7, path: '/' });
});

<?php if ($this->session->userdata('menu_current') >= 0) {?>
	$('.sidebar dd a:eq(<?php echo $this->session->userdata('menu_current');?>)').addClass('current')
<?php }?>

<?php if ($this->session->userdata('menu_index') >= 0) {?>
	$('.sidebar dl:eq(<?php echo $this->session->userdata('menu_index');?>)').find('dt a').click();
<?php }?>


</script>

<div class="main clearfix">
<div class="main_con clearfix">
<?=$content_for_layout ?>
<?php
//不习惯短标签写法的，可以用标准写法如下
//echo $content_for_layout ;
?>
</div>
</div>

</div>
<div class="footer" style="padding: 0 0 30px 0;">Copyright©2012 CiCms. All Rights <br /></div>
</body>  
</html>