<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title "><?php echo $title_modal; ?></h4>
        </div>
        <div class="modal-body">
            <div class="te">
                <?php echo $content_modal; ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php foreach ($buttons_modal as $key => $value): ?>

                <?php if ($key === 'close' || $value === 'close'): ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <?php echo is_int($key) ? "Fechar" : $value; ?>
                    </button>
                <?php endif ?>
            
                <?php if ($key === 'save' || $value === 'save'): ?>
                    <button type="button" class="btn btn-primary" id="save">
                        <?php echo is_int($key) ? "Salvar" : $value; ?>
                    </button>
                <?php endif ?>

                <?php if ($key === 'saveEdit' || $value === 'saveEdit'): ?>
                    <button type="button" class="btn btn-primary" id="saveEdit">
                        <?php echo is_int($key) ? "Salvar" : $value; ?>
                    </button>
                <?php endif ?>

                <?php if ($key === 'saveConfig' || $value === 'saveConfig'): ?>
                    <button type="button" class="btn btn-primary" id="saveConfig">
                        <?php echo is_int($key) ? "Salvar" : $value; ?>
                    </button>
                <?php endif ?>
            
                <?php if ($key === 'delete' || $value === 'delete'): ?>
                    <button type="button" class="btn btn-danger" id="remove">
                        <?php echo is_int($key) ? "Apagar" : $value; ?>
                    </button>
                <?php endif ?>

            <?php endforeach ?>    
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->