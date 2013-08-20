<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$template['title']?></title>
    <base href="<?php echo base_url()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

    </style>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">

    <?php if(isset($css)) echo $css; ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="admin">SyS</a>
          <div class="nav-collapse collapse">

            <?php echo $template['partials']['menu'] ?>

            <ul class="nav pull-right">
              <li>
                <a href="<?php echo base_url(); ?>" alt="Site" title="Site" class="navbar-link">
                  <i class="icon-globe icon-white"></i> Site
                </a>
              </li>
              <li>
                <a href="editar_perfil" class="navbar-link">
                  <i class="icon-user icon-white"></i> 
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
    </div>

    <div class="container-fluid">

      <?php echo $template['body'] ?>         
      
      <hr>

      <div class="footer">
        <div class="row-fluid">
            <div class="span6">&copy; Company 2013</div>
            <div class="span6 text-right muted">Página processada em <strong>{elapsed_time}</strong> secundos</div>
        </div>
      </div>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <?php if(isset($js)) echo $js; ?>
   
   <!-- <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/validate_form.js"></script> -->

  </body>
</html>