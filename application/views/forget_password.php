<div class="container">

    <?php echo form_open('forget_password/send', array('class'=>'form-signin', 'id'=>'form-forget-password')); ?>

        <h2 class="form-signin-heading">Recuperar Senha</h2>
        
        <?php echo validation_errors();?>
        
        <?php echo $msg; ?>
        
        <div class="form-group">
            <label class="control-label" for="email">Use o e-mail cadastrado para recuperar a senha</label>
            <div class="controls">
                <input type="text" name="email" id="email" class="form-control required" placeholder="Insira o E-mail cadastrado para recuperar a senha" maxlength="100" minlength="3" />
                <span class="help-block">A senha será enviada para o e-mail informado.</span>
            </div>
        </div>

        <button class="btn btn-large btn-primary" type="submit">Enviar</button>
    </form>

</div> <!-- /container -->