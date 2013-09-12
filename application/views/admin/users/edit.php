<div class="container">

    <?php echo form_open('admin/users/editDB', array('id'=>'form-edit-user', 'class'=>'form-dialog-edit')); ?>
    
    <?php echo form_hidden('inf', "edit"); ?>
    
    <?php echo form_hidden('id', $user->id); ?>

    <?php echo validation_errors();?>
    
    <div id="msg"></div>

    <div class="tabbable">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#perfil" data-toggle="tab">Pessoal</a></li>
            <li><a href="#address_user" data-toggle="tab">Endereço</a></li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="perfil">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="control-label" for="name">*Nome</label>
                        <input type="text" name="name" id="name" class="form-control required" placeholder="Informe seu Nome" maxlength="255" minlength="3" value="<?php echo $user->name ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="control-label" for="username">*Login</label>
                        <input type="text" name="username" id="username" class="form-control required" placeholder="Informe um Login" maxlength="100" minlength="3" value="<?php echo $user->username ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="control-label">*E-mail</label>
                        <span class="form-control uneditable-input"><?php echo $user->email ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="control-label" for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Deixar a Senha em branco caso não queira alterar" maxlength="255" minlength="3" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="control-label" for="passwordconfirm">Confirme a Senha</label>
                        <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" placeholder="Confirme a Senha" maxlength="255" minlength="3" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-10">
                        <label>Sexo</label>

                        <label class="radio inline">
                            <input type="radio" name="gender" value="F" <?php echo $user->gender == 'F' ? 'checked' : '' ?> required>
                            Feminino
                        </label>

                        <label class="radio inline">
                            <input type="radio" name="gender" value="M" <?php echo $user->gender == 'M' ? 'checked' : '' ?> >
                            Masculino
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-9">
                        <label class="control-label" for="nickname">Apelido</label>
                        <div class="controls">
                            <input type="text" name="nickname" id="nickname" class="form-control" placeholder="Como gosta de ser chamado (um apelido)" maxlength="100" minlength="3" value="<?php echo $user->nickname ?>" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-5">
                        <label class="control-label" for="telephone">Telefone</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Informe um telefone para contato" maxlength="15" value="<?php echo $user->telephone ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-5">
                        <label class="control-label" for="birthdate">Data de Nascimento</label>
                        <div class="controls">
                            <input type="text" name="birthdate" id="birthdate" class="form-control" placeholder="dd/mm/aaaa" maxlength="10" value="<?php echo data_us_to_br($user->birthdate) ?>" />
                        </div>
                    </div>
                </div>

            </div> <!-- /perfil -->

            <div class="tab-pane" id="address_user">
                
                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <label class="control-label" for="zipcode">CEP</label>
                            <div class="input-group">
                                <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="00000-000" maxlength="9" value="<?php echo $user->zipcode ?>" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" id="search_zipcode">Buscar</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-9">
                            <label for="address" class="control-label">Endereço</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Informe seu Endereço" maxlength="255" value="<?php echo $user->address ?>" />
                        </div>
                        <div class="col-lg-3">
                            <label for="address_number" class="control-label">nº</label>
                            <input type="text" name="address_number" id="address_number" class="form-control" maxlength="10" value="<?php echo $user->address_number ?>" />
                        </div>
                    </div>                        
                </div>
                
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="complement" class="control-label">Complemento</label>
                        <input type="text" name="complement" id="complement" class="form-control" maxlength="100" value="<?php echo $user->complement ?>" />                
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="district" class="control-label">Bairro</label>
                        <input type="text" name="district" id="district" class="form-control" maxlength="100" value="<?php echo $user->district ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <label for="state" class="control-label">Estado</label>
                            <input type="text" name="state" id="state" class="form-control" maxlength="100" value="<?php echo $user->state ?>" />
                        </div>
                        <div class="col-lg-7">
                            <label for="city" class="control-label">Cidade</label>
                            <input type="text" name="city" id="city" class="form-control" maxlength="100" value="<?php echo $user->city ?>" />
                        </div>
                    </div>
                </div>

            </div> <!-- /address_user -->

        </div> <!-- /tab-content -->

    </div> <!-- /tabbable -->





    <?php echo form_close(); ?>

</div> <!-- /container -->
