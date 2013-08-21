<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recuperação de Senha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  </head>
  <body>
  
  <h1>Recuperação de Senha!</h1>

  <p>Foi solicitado a recuperação se senha no site <?php echo SITE_NAME; ?>.</p>

  <p>Caso não tenha sido você, pode desconsiderar esse e-mail e ficar despreocupado.</p>

  <hr>

  <p><?php echo $name; ?>, segue a senha solicitada:</p>

  <p>Login: <?php echo $username; ?> que também pode acessar usando seu e-mail <?php echo $email; ?></p>
  
  <p>Senha: <?php echo $password; ?></p>
  
  <hr>

  <p>
    A equipe <?php echo SITE_NAME; ?> agradece.
  </p>
    
  </body>
</html>
