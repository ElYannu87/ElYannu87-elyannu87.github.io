$(function () {

    $('#contact-form').submit(function(e){

        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize(); 

        $.ajax({

            type: 'POST',
            url: 'php/formulaire.php',
            data: postdata,
            dataType: 'json',

            success: function(result) { 

                if(result.isSuccess){
                    $("#contact-form").append("<p>Votre message a bien été envoyé. Merci de nous avoir contacté !</p>");
                    $("#contact-form")[0].reset();
                }

                else{
                    $("#object + .comments").html(result.firstnameError);
                    $("#mail-client + .comments").html(result.nameError);
                    $("#mail + .comments").html(result.emailError);
                    $("#message + .comments").html(result.messageError);
                }                
            }
        });        
    });
})