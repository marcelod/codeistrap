$( function() {
    //VALIDACAO DO FORM DE CONFIRMAÇÃO DE REGISTRO
    $("#form-confirmation-register").validate({
        rules: {
            confirmation_register: {required:true,maxlength:200}            
        },
        messages: {
            confirmation_register: {
                required: "Campo Código de Confirmação &eacute; requerido",
                maxlength: "M&aacute;ximo de 200 caracteres"
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
