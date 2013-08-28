<div class="container">

  <?php 
  $textHeader = "Usuários";
  $textHeader.= '<div class="pull-right">';
  $textHeader.= '<a data-target="#create" data-toggle="modal" role="button" class="btn btn-small btn-success" id="new">';
  $textHeader.= '<span class="glyphicon glyphicon-plus-sign"></span> Novo</a>';
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
        <th>Sexo</th>
        <th><span class="glyphicon glyphicon-cog"></span></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <?php echo form_close(); ?>

</div>


<!-- MODALS -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModelCreate" aria-hidden="true"></div>