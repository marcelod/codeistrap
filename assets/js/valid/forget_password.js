$( function() {   

    //VALIDACAO DO FORM DE RECUPERAÇÃO DE SENHA
    $("#form-forget-password").validate({
        rules: {
            email: {required:true,minlength:3,maxlength:100,email:true}                   
        },
        messages: {
            email: {
                required: "Campo E-mail &eacute; requerido",
                minlength: "M&iacute;nimo de 3 caracteres",
                maxlength: "M&aacute;ximo de 100 caracteres",
                email: "O campo deve conter um e-mail valido"
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
