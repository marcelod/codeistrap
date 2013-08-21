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

    <?php if(isset($css)) echo $css; ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        
        <?php echo $template['body'] ?>        
        
      </div>

    </div>

    <div class="footer">
      <div class="container">
        <div class="row">
            <div class="col-md-6">&copy; Company 2013</div>
            <div class="col-md-6 text-right muted">Página processada em <strong>{elapsed_time}</strong> segundos</div>
        </div>
      </div>
    </div>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <?php if(isset($js)) echo $js; ?>

    <script src="assets/js/holder/holder.js"></script>
    
  </body>
</html>
