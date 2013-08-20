<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $template['title']; ?></title>
    <base href="<?php echo base_url(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/default.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <link href="assets/css/main.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">

  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <div class="row-fluid">
          <div class="span8"><h3 class="muted">SyS</h3></div>
          <div class="span4 text-right">
            <?php
            if($this->session->userdata('logged'))
            {

              echo $this->session->userdata('user_name');
              echo br();

              $linkAdmin = roleAccessPermission('admin');
              if($linkAdmin != FALSE)
              {
                echo "<a href='admin' class='btn btn-mini btn-inverse'>" . $linkAdmin . "</a>" . nbs();
              }

              echo "<a href='editar_perfil' class='btn btn-mini btn-primary'>Editar Perfil</a>" . nbs();
              echo "<a href='logout' class='btn btn-mini btn-danger'>Sair</a>";
            } 
            else 
            {
              echo "<a href='login' class='btn btn-link'>Acessar</a><a href='register' class='btn btn-link'>Registrar-se</a>";
            }
            ?>            
          </div>
        </div>
        <div class="navbar">
          <div class="navbar-inner">
            <!-- <div class="container-fluid"> -->
            <div class="container">

             <!--  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              
              <div class="nav-collapse collapse"> -->

              <?php echo $template['partials']['menu']; ?>
              
              <!-- </div> -->

            </div>
          </div>
        </div><!-- /.navbar -->
      </div><!-- /.masthead -->

      <?php echo $template['body'] ?>
      
      <hr>

      <div class="footer">
        <div class="row-fluid">
            <div class="span6">&copy; Company 2013</div>
            <div class="span6 text-right muted">Página processada em <strong>{elapsed_time}</strong> secundos</div>
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <?php if(isset($js)) echo $js; ?>


    <script src="assets/js/holder/holder.js"></script>
    
  </body>
</html>
