<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Confirmação de Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  </head>
  <body>
  
  <h1>Você foi cadastrado no nosso site!</h1>

  <p>Por favor, confirme o código de cadastro em nosso site <a href="<?php echo base_url('register/send_confirmation_register/' . $confirmation_code); ?>">clicando aqui</a>.</p>
  <hr>
  <p>Você pode acessar <a href="<?php echo base_url('register/confirmation_register'); ?>"><?php echo base_url('register/confirmation_register'); ?></a> e entre com o seguinte código de confirmação:</p>

  <h3>
    <?php echo $confirmation_code; ?>
  </h3>

  <hr>

  <p>
    A equipe <?php echo SITE_NAME; ?> agradece.
  </p>
    
  </body>
</html>
