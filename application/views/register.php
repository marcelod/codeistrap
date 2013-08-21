<div class="container">

    <?php echo form_open('register/send', array('class'=>'form-signin', 'id'=>'form-register')); ?>

        <h2 class="form-signin-heading">Registre-se</h2>
        
        <?php echo validation_errors();?>
        
        <?php echo $msg;?>
        
        <div class="form-group">
            <label class="control-label" for="name">*Nome</label>
            <input type="text" name="name" id="name" class="form-control required" placeholder="Informe seu Nome" maxlength="255" minlength="3" value="<?php echo set_value('name'); ?>" />
        </div>

        <div class="form-group">
            <label class="control-label" for="username">*Login</label>
            <input type="text" name="username" id="username" class="form-control required" placeholder="Informe um Login" maxlength="100" minlength="3" value="<?php echo set_value('username'); ?>" />
        </div>

        <div class="form-group">
            <label class="control-label" for="email">*E-mail</label>
            <input type="text" name="email" id="email" class="form-control required" placeholder="Informe seu Email" maxlength="100" minlength="3" value="<?php echo set_value('email'); ?>" />
        </div>

        <div class="form-group">
            <label class="control-label" for="password">*Senha</label>
            <input type="password" name="password" id="password" class="form-control required" placeholder="Senha" maxlength="255" minlength="3" />
        </div>

        <div class="form-group">
            <label class="control-label" for="passwordconfirm">*Confirme a Senha</label>
            <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control required" placeholder="Confirme a Senha" maxlength="255" minlength="3" />
        </div>

        <div class="form-group">
            <label>Sexo</label>

            <label class="radio inline">
                <input type="radio" name="gender" value="F" checked required>
                Feminino
            </label>

            <label class="radio inline">
                <input type="radio" name="gender" value="M">
                Masculino
            </label>
        </div>

        <br>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="acept" value="1" checked>
                <small>Aceito receber notificações do site - a melhorar o texto aqui OK ;D</small>
            </label>
        </div>
        
        <button class="btn btn-lg btn-primary" type="submit">Cadastrar</button>

        <p>&nbsp;</p>

        <small>Cadastrando você estará aceitando os <a href="terms_service" target="_blank">Termos de Serviço</a></small>

    </form>

</div> <!-- /container -->