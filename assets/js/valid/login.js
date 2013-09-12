$( function() {
    //VALIDACAO DO FORMULARIO DE LOGIN
    $("#form-login").validate({
        rules: {
            login: {required:true,minlength:3,maxlength:100},
            password: {required:true,minlength:3,maxlength:255}
        },
        messages: {
            login: {
                required: "Campo Login &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            password: {
                required: "Campo Senha &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres"
            }
        },
        highlight: function(element){
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).remove();
        }
    });    
    
});
