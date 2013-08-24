<div class="container">

  <?php 
  $textHeader = "Usuários";
  $textHeader.= '<div class="pull-right">';
  // $textHeader.= '<a class="btn btn-small btn-success" href="admin/services/create"><i class="icon-plus-sign icon-white"></i> Novo</a>';
  // $textHeader.= '<a role="button" data-toggle="modal" data-target="#create" class="btn btn-small btn-success">
  $textHeader.= '<a href="'. base_url() .'admin/services/create" data-target="#create" role="button"  class="btn btn-small btn-success">
  <i class="icon-plus-sign icon-white"></i> Novo</a>';
  $textHeader.= '</div>';
  
  echo pageHeader($textHeader, 'h3'); 
  ?>

  <?php echo form_open(); ?>

  <table id="users" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Nickname</th>
        <th>Confimado</th>
        <th>Sexo</th>        
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <?php echo form_close(); ?>

</div>