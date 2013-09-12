<div class="container">

    <?php echo form_open('admin/users/configDB', array('id'=>'form-config-user', 'class'=>'form-dialog-config')); ?>
    
    <?php echo form_hidden('inf', "conf"); ?>
    
    <?php echo form_hidden('user_id', $user->id); ?>

    <?php echo validation_errors();?>
    
    <div id="msg"></div>

    <div class="panel-group" id="accordionRoles">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionRoles" href="#collapseRoles">
                    Funções
                    </a>
                </h4>
            </div>
            <div id="collapseRoles" class="panel-collapse collapse in">
            <?php foreach ($roles as $role): ?>
                <label class="checkbox-inline">
                    <input type="checkbox" name="roles_user[]" value="<?php echo $role->id ?>" 
                        <?php echo in_array($role->id, $roles_user) ? "checked='checked'" : ""; ?>
                    >
                    <?php echo $role->name ?>
                </label>
            <?php endforeach ?>
            </div>
        </div>
    </div>

    <hr>

    <div class="panel-group" id="accordionPermissions">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionPermissions" href="#collapsePermissions">
                    Permissões
                    </a>
                </h4>
            </div>
            <div id="collapsePermissions" class="panel-collapse collapse out">
            <?php echo $permissions; ?>
            </div>
        </div>
    </div>

  <?php echo form_close(); ?>

</div> <!-- /container -->
