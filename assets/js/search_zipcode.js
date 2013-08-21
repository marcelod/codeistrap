//BUSCA DE CEP PARA PREENCHER OS CAMPOS DE ENDERECO

$(document).ready(function() {

    $("#search_zipcode").click(function (event) {
        event.preventDefault();

        var zipcode = $("#zipcode").val();
        var fhc = $("input[name=csrf_test_name]").val();

        $.ajax({
            type: "POST",
            url: "ajax/search_zipcode",
            data: "zipcode=" + zipcode + "&csrf_test_name=" + fhc,
            success: function (i) {
                var obj = $.parseJSON(i);

                $("#address").attr('value', obj.tipo_logradouro + " " + obj.logradouro);
                $("#state").attr('value', obj.uf);
                $("#city").attr('value', obj.cidade);
                $("#district").attr('value', obj.bairro);
            },
            error: function (err) {
                alert('Ocorreu um erro no servidor e não foi possivel localizar o CEP.');
            }
        });
    });

});