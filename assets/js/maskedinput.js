$(document).ready(function() {

  // criação da mascara para o campo com id telephone
  $("#telephone").livequery(function () {
    $(this).mask("(99) 9999-9999?9");

    $(this).on("blur", function() {
      var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

      if( last.length == 5 )
      {
          var move     = $(this).val().substr( $(this).val().indexOf("-") + 1, 1 );
          var lastfour = last.substr(1,4);
          var first    = $(this).val().substr( 0, 9 );
          
          $(this).val( first + move + '-' + lastfour );
      }
    });
  });
 
  // criação da mascara para o campo com id birthdate
  $("#birthdate").livequery(function () {
    $(this).mask("99/99/9999");
  });

  // criação da mascara para o campo com id zipcode
  $("#zipcode").livequery(function () {
    $(this).mask("99999-999");
  });


});
