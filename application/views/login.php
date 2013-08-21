<div class="container">

    <?php echo form_open('login/send', array('class'=>'form-signin', 'id'=>'form-login')); ?>

        <h2 class="form-signin-heading">Acessar</h2>
        
        <?php echo validation_errors();?>
        
        <?php echo $msg; ?>
        
        <div class="form-group">
            <label class="control-label" for="login">Login/E-mail</label>
            <input type="text" name="login" id="login" class="form-control required" placeholder="Informe seu Login ou Email" maxlength="100" minlength="3" />
        </div>

        <div class="form-group">
            <label class="control-label" for="password">Senha</label>
            <input type="password" name="password" id="password" class="form-control required" placeholder="Senha" maxlength="255" minlength="3" />
        </div>

        <button class="btn btn-lg btn-primary" type="submit">Login</button>
        <br><br>
        <a href='register' class='btn btn-info btn-sm'>Registrar-se</a>
        <a href='forget_password' class='btn btn-warning btn-sm'>Esqueci a senha</a>

    </form>

</div> <!-- /container -->