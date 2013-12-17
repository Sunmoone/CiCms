<!DOCTYPE html>
<html>
  <head>
    <title>CiCms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url();?>" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="application/views/css/bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">

      <div class="masthead">
        <h3 class="text-muted">CiCms</h3>
		<ul class="nav nav-pills">
		  <li class="active"><a href="#">Home</a></li>
		  <?php foreach($category as $val):?>
          <li><a href="#"><?=$val['name'];?></a></li>
          <?php endforeach;?>
		</ul>
      </div>

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>基于CodeIgniter的CMS</h1>
        <p class="lead"></p>
        <p><a role="button" href="#" class="btn btn-lg btn-success">正在开发中。。。</a></p>
      </div>
       <?=$content_for_layout ?>
      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div><!-- container -->
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
  </body>
</html>
