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
        <th class="hidden-xs">#</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th class="hidden-xs">Sexo</th>
        <th>CONFIRMED</th> <!-- esse coluna não irá ser exibida, estou usando os dados para manipulação -->
        <th>ACTIVE</th> <!-- esse coluna não irá ser exibida, estou usando os dados para manipulação -->
        <th><span class="glyphicon glyphicon-cog"></span></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <?php echo form_close(); ?>

</div>


<!-- MODALS -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModelCreate" aria-hidden="true"></div>
<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModelDelete" aria-hidden="true"></div>
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModelEdit" aria-hidden="true"></div>
<div id="conf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModelConf" aria-hidden="true"></div>
