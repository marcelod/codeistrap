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

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/default.css" rel="stylesheet">

    <?php if(isset($css)) echo $css; ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="masthead">

        <div class="row">
          <div class="col-md-8"><h3 class="text-muted">CodeiStrap</h3></div>
          <div class="col-md-4 text-right">
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

        <?php echo $template['partials']['menu']; ?>
        
      </div>

      <?php echo $template['body'] ?>
      
      <div class="footer">
        <div class="row">
            <div class="col-md-6">&copy; Company 2013</div>
            <div class="col-md-6 text-right muted">Página processada em <strong>{elapsed_time}</strong> segundos</div>
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <?php if(isset($js)) echo $js; ?>


    <script src="assets/js/holder.js"></script>
    
  </body>
</html>
