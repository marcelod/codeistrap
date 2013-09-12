<div class="container">

    <?php echo form_open('admin/users/deleteRow', array('id'=>'form-delete-user', 'class'=>'form-dialog-remove')); ?>

    <?php echo form_hidden('id', $user->id); ?>

    <p>
        Deseja realmente apagar o usuário <strong><?php echo $user->name ?></strong>?
    </p>

    <?php echo form_close(); ?>

</div> <!-- /container -->
