<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CiCms</title>

<!-- meta tags -->
<meta name="keywords" content="">
<meta name="description" content="">
<base href="<?php echo base_url();?>" />
<!-- stylesheets -->
<link rel="stylesheet" href="application/views/css/reset.css" type="text/css">
<link rel="stylesheet" href="application/views/css/common.css" type="text/css">
<link rel="stylesheet" href="application/views/css/layout.css" type="text/css">

<!-- javascript -->
<script type="text/javascript" src="application/views/js/jquery-1.2.6.min.js"></script>

<!-- sf-menu -->
<link rel="stylesheet" type="text/css" href="application/views/css/superfish.css" media="screen">
<script type="text/javascript" src="application/views/js/hoverIntent.js"></script>
<script type="text/javascript" src="application/views/js/superfish.js"></script>
<script type="text/javascript">

// initialise plugins
jQuery(function(){
	jQuery('ul.sf-menu').superfish();
});

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

<!--conditional comments -->
<!--[if IE]>  
	<script src="application/views/js/html5.js"></script>
<![endif]--> 

</head>
<body class="home">
<div id="container" class="container">
	<header>
    	<div id="logo"><h1 class="caviar_dreams"><a href="<?php echo base_url();?>">CiCms</a></h1></div>
        
    </header>
    <nav>
    	<ul class="sf-menu">
        	<li class="current">
				<a href="./">首页</a>
			</li>
			<?php if ($category):?>
        	<?php foreach ($category as $val):?>
			<li class="current">
				<a href="category/<?php echo $val['slug'];?>"><?php echo $val['name'];?></a>
				<?php $val['childs'] = isset($val['childs']) ? $val['childs'] : '';?>
				<?php if ($val['childs']):?>
				<ul>
					<?php foreach ($val['childs'] as $v):?>
					<li class="current">
						<a href="category/<?php echo $v['slug'];?>"><?php echo $v['name'];?></a>
						<?php $v['childs'] = isset($v['childs']) ? $v['childs'] : '';?>
						<?php if ($v['childs']):?>
						<ul>
							<?php foreach ($v['childs'] as $t):?>
							<li class="current"><a href="category/<?php echo $t['slug'];?>"><?php echo $t['name'];?></a></li>
							<?php endforeach;?>
						</ul>
						<?php endif;?>
					</li>
					<?php endforeach;?>
				</ul>
				<?php endif;?>
			</li>
			<?php endforeach;?>
			<?php endif;?>
		</ul>
	</nav>

<?=$content_for_layout ?>
<?php
//不习惯短标签写法的，可以用标准写法如下
//echo $content_for_layout ;
?>

</div>
<footer>
	&copy; Copyright CiCms 2012	
</footer>
</body>
</html>