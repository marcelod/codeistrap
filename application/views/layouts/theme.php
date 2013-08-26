<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/ico/favicon.png">

    <title><?php echo $template['title']; ?></title>
    <base href="<?php echo base_url(); ?>">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap theme -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>assets/css/offcanvas.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">

    <?php if(isset($css)) echo $css; ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <span class="glyphicon glyphicon-fire"> CodeiStrap</span></a>
        </div>
        <div class="navbar-collapse collapse">
          <?php echo $template['partials']['menu'] ?>

          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?php echo base_url(); ?>" alt="Site" title="Site" class="navbar-link">
                <i class="glyphicon glyphicon-globe"></i> Site
              </a>
            </li>
            <li>
              <a href="editar_perfil" class="navbar-link">
                <i class="glyphicon glyphicon-user"></i> 
                <?php echo $this->session->userdata('user_name'); ?>
              </a>
            </li>
            <li>
              <a href="logout" class="navbar-link">
                Sair
              </a>
            </li>
          </ul>
         
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

    <?php echo $template['body'] ?>

    <hr>


      <div class="footer">
        <div class="row">
            <div class="col-sm-6">&copy; Company 2013</div>
            <div class="col-sm-6 text-right muted">Página processada em <strong>{elapsed_time}</strong> secundos</div>
        </div>
      </div>

    </div>


<!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <?php if(isset($js)) echo $js; ?>

    <script src="<?php echo base_url(); ?>assets/js/holder.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/offcanvas.js"></script>
    
  </body>
</html>
