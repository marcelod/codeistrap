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
        <?php if ($key == 'close'): ?>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $value ?></button>    
        <?php endif ?>
        <?php if ($key == 'save'): ?>
          <button type="button" class="btn btn-primary" id="save"><?php echo $value ?></button>
        <?php endif ?>        
      <?php endforeach ?>     
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


<?php if(isset($js)) echo $js; ?>