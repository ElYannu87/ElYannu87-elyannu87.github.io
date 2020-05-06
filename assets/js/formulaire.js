$(function () {

    $('#contact-form').submit(function(e){

        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize(); 

        $.ajax({

            type: 'POST',
            url: '../../php/formulaire.php',
            data: postdata,
            dataType: 'json',

            success: function(result) { 

                if(result.isSuccess){
                    $("#contact-form").append("<p>Votre message a bien été envoyé. Merci de nous avoir contacté !</p>");
                    $("#contact-form")[0].reset();
                }

                else{
                    $("#object + .comments").html(result.objectError);
                    $("#mail-client + .comments").html(result.mail-clientError);
                    $("#mail + .comments").html(result.mailError);
                    $("#message + .comments").html(result.messageError);
                }                
            }
        });        
    });
})