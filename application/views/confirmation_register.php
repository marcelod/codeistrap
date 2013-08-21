<div class="container">

    <?php echo form_open('register/send_confirmation_register', array('class'=>'form-signin', 'id'=>'form-confirmation-register')); ?>

        <h2 class="form-signin-heading">Confirmação de Registro</h2>
        
        <?php echo validation_errors();?>
        
        <?php echo $msg; ?>
        
        <div class="form-group">
            <label class="control-label" for="confirmation_register">Código de Confirmação</label>
            <input type="text" name="confirmation_register" id="confirmation_register" class="form-control required" placeholder="Insira o código de confirmação de registro" maxlength="200" />
            <p class="help-block">Digite o código que foi enviado para o e-mail informado. Pode levar algum tempo e verifique o lixo eletrônico.</p>
        </div>

        <button class="btn btn-large btn-primary" type="submit">Confirmar</button>
    </form>

</div> <!-- /container -->