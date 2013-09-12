$( function() {
    //VALIDACAO DO FORM DE CADASTRAR NO SITE
    $("#form-contact").validate({
        rules: {
            name: {required:true,minlength:3,maxlength:255},
            email: {required:true,minlength:3,maxlength:100,email:true},
            telephone: {minlength:8,maxlength:25},
            message: {required:true},
        },
        messages: {
            name: {
                required: "Campo Nome &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres"
            },
            email: {
                required: "Campo E-mail &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 100 caracteres",
                email: "O campo deve conter um e-mail valido"
            },
            telephone: {
                minlength: "M&iacute;nimo de 8 caracteres",
                maxlength: "M&aacute;ximo de 25 caracteres"
            },
            message: {
                required: "Campo Mensagem &eacute; requerido"
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
