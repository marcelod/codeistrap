$( function() {
    //VALIDACAO DO FORM DE CADASTRAR NO SITE
    $("#form-register").validate({
        rules: {
            name: {required:true,minlength:3,maxlength:255},
            username: {required:true,minlength:3,maxlength:100},
            email: {required:true,minlength:3,maxlength:100,email:true},
            password: {required:true,minlength:3,maxlength:255},
            passwordconfirm: {required:true,minlength:3,maxlength:255,equalTo:"#password"},
            gender: {required:true}
        },
        messages: {
            name: {
                required: "Campo Nome &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres"
            },
            username: {
                required: "Campo Login &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            email: {
                required: "Campo E-mail &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 100 caracteres",
                email: "O campo deve conter um e-mail valido"
            },
            password: {
                required: "Campo Senha &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres"
            },
            passwordconfirm: {
                required: "Campo Confirme a Senha &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres",
                equalTo: "Campo deve ser igual ao campo Senha"
            },
            gender: {
                required: "Campo Sexo &eacute; requerido"
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
