<div class="container">

    <?php echo form_open('admin/users/send', array('id'=>'form-create-user', 'class'=>'form-dialog')); ?>
        
        <?php echo form_hidden('inf', "create"); ?>

        <?php echo validation_errors();?>
        
        <div id="msg"></div>
        
        <div class="form-group">
            <label class="control-label" for="name">*Nome</label>
            <input type="text" name="name" id="name" class="form-control required" placeholder="Informe o Nome" maxlength="255" minlength="3" value="<?php echo set_value('name'); ?>" />
        </div>

        <div class="form-group">
            <label class="control-label" for="username">*Login</label>
            <input type="text" name="username" id="username" class="form-control required" placeholder="Informe um Login" maxlength="100" minlength="3" value="<?php echo set_value('username'); ?>" />
        </div>

        <div class="form-group">
            <label class="control-label" for="email">*E-mail</label>
            <input type="text" name="email" id="email" class="form-control required" placeholder="Informe o Email" maxlength="100" minlength="3" value="<?php echo set_value('email'); ?>" />
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

        <div class="checkbox">
            <label>
                <input type="checkbox" name="send_mail" value="1">
                Enviar e-mail agora para o usuário já acessar o sistema?
            </label>
        </div>

	<?php echo form_close(); ?>

</div> <!-- /container -->
