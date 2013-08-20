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
    <link href="assets/css/sticky.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

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

    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        
        <?php echo $template['body'] ?>        
        
      </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <div class="row-fluid credit">
          <div class="span6">&copy; Company 2013</div>
          <div class="span6 text-right muted">Página processada em <strong>{elapsed_time}</strong> secundos</div>
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
