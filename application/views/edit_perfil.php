<div class="container">

    <?php echo pageHeader('Editar Perfil'); ?>

    <?php echo validation_errors();?>
    
    <?php echo form_open('edit_perfil/send', array('class'=>'form-tab', 'id'=>'form-edit-perfil')); ?>

    <?php echo form_hidden('id', $userData[0]->id); ?>

    <?php echo $msg;?>

    <div class="tabbable">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#perfil" data-toggle="tab">Pessoal</a></li>
            <li><a href="#address_user" data-toggle="tab">Endereço</a></li>
            <!-- <li><a href="#image" data-toggle="tab">Imagem</a></li> -->
        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="perfil">
                <div class="row">
                    <div class="form-group col-lg-7">
                        <label class="control-label" for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control required" placeholder="Informe seu Nome" maxlength="255" minlength="3" value="<?php echo $userData[0]->name ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-7">
                        <label class="control-label" for="username">Login</label>
                        <input type="text" name="username" id="username" class="form-control required" placeholder="Informe um Login" maxlength="100" minlength="3" value="<?php echo $userData[0]->username ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-7">
                        <label class="control-label">E-mail</label>
                        <span class="form-control uneditable-input"><?php echo $userData[0]->email ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-7">
                        <label class="control-label" for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Deixar a Senha em branco caso não queira alterar" maxlength="255" minlength="3" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-7">
                        <label class="control-label" for="passwordconfirm">Confirme a Senha</label>
                        <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" placeholder="Confirme a Senha" maxlength="255" minlength="3" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Sexo</label>

                        <label class="radio inline">
                            <input type="radio" name="gender" value="F" <?php echo $userData[0]->gender == 'F' ? 'checked' : '' ?> required>
                            Feminino
                        </label>

                        <label class="radio inline">
                            <input type="radio" name="gender" value="M" <?php echo $userData[0]->gender == 'M' ? 'checked' : '' ?> >
                            Masculino
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-5">
                        <label class="control-label" for="nickname">Apelido</label>
                        <div class="controls">
                            <input type="text" name="nickname" id="nickname" class="form-control" placeholder="Como gosta de ser chamado (um apelido)" maxlength="100" minlength="3" value="<?php echo $userData[0]->nickname ?>" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-3">
                        <label class="control-label" for="telephone">Telefone</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Informe um telefone para contato" maxlength="15" value="<?php echo $userData[0]->telephone ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-3">
                        <label class="control-label" for="birthdate">Data de Nascimento</label>
                        <div class="controls">
                            <input type="text" name="birthdate" id="birthdate" class="form-control" placeholder="dd/mm/aaaa" maxlength="10" value="<?php echo data_us_to_br($userData[0]->birthdate) ?>" />
                        </div>
                    </div>
                </div>

            </div> <!-- /perfil -->

            <div class="tab-pane" id="address_user">

                
                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label" for="zipcode">CEP</label>
                            <div class="input-group">
                                <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="00000-000" maxlength="9" value="<?php echo $userData[0]->zipcode ?>" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" id="search_zipcode">Buscar</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-5">
                            <label for="address" class="control-label">Endereço</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Informe seu Endereço" maxlength="255" value="<?php echo $userData[0]->address ?>" />
                        </div>
                        <div class="col-lg-2">
                            <label for="address_number" class="control-label">nº</label>
                            <input type="text" name="address_number" id="address_number" class="form-control" maxlength="10" value="<?php echo $userData[0]->address_number ?>" />
                        </div>
                    </div>                        
                </div>
                
                <div class="row">
                    <div class="form-group col-lg-7">
                        <label for="complement" class="control-label">Complemento</label>
                        <input type="text" name="complement" id="complement" class="form-control" maxlength="100" value="<?php echo $userData[0]->complement ?>" />                
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-7">
                        <label for="district" class="control-label">Bairro</label>
                        <input type="text" name="district" id="district" class="form-control" maxlength="100" value="<?php echo $userData[0]->district ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label for="state" class="control-label">Estado</label>
                            <input type="text" name="state" id="state" class="form-control" maxlength="100" value="<?php echo $userData[0]->state ?>" />
                        </div>
                        <div class="col-lg-4">
                            <label for="city" class="control-label">Cidade</label>
                            <input type="text" name="city" id="city" class="form-control" maxlength="100" value="<?php echo $userData[0]->city ?>" />
                        </div>
                    </div>
                </div>

            </div> <!-- /address_user -->

            <!-- <div class="tab-pane" id="image">
                <h3>imagem do usuario</h3>
            </div> -->        

        </div> <!-- /tab-content -->

    </div> <!-- /tabbable -->

    <br>

    <button class="btn btn-lg btn-primary" type="submit">Salvar</button>
    
    <?php echo form_close(); ?>

</div> <!-- /container -->