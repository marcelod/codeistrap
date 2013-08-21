$( function() {
    //VALIDACAO DO FORM DE CADASTRAR NO SITE
    $("#form-edit-perfil").validate({
        rules: {
            name: {required:true,minlength:3,maxlength:255},
            username: {required:true,minlength:3,maxlength:100},
            password: {minlength:3,maxlength:255},
            passwordconfirm: {minlength:3,maxlength:255,equalTo:"#password"},
            gender: {required:true},
            telephone: {maxlength:15},
            nickname: {maxlength:100},
            birthdate: {maxlength:100},
            address: {maxlength:255},
            number_address: {maxlength:10},
            complement: {maxlength:100},
            district: {maxlength:100},
            state: {maxlength:100},
            city: {maxlength:100}            
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
            password: {
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres"
            },
            passwordconfirm: {
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 255 caracteres",
                equalTo: "Campo deve ser igual ao campo Senha"
            },
            gender: {
                required: "Campo Sexo &eacute; requerido"
            },
            telephone: {
                maxlength: "M&aacute;ximo de 15 caracteres"
            },
            nickname: {
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            birthdate: {
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            address: {
                maxlength: "M&aacute;ximo de 255 caracteres"
            },
            number_address: {
                maxlength: "M&aacute;ximo de 10 caracteres"
            },
            complement: {
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            district: {
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            state: {
                maxlength: "M&aacute;ximo de 100 caracteres"
            },
            city: {
                maxlength: "M&aacute;ximo de 100 caracteres"
            }
        },
        highlight: function(element){
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
});
