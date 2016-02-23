//Form contato
$(document).ready(function() {
    //process the form
    $('form').submit(function(event) {
            var formData = $( "#formContato" ).serialize();
            var formMessages = $('.return-msg');
            console.log(formData);
            // process the form
            $.ajax({
                type        : 'POST',
                url         : 'form-send.php',
                data        : formData,
                dataType    : 'html',

            })
            // using the done promise callback
            .done(function(response) {
                // Reset the fields.
                 $('#formContato')[0].reset();
                // Set the message text.
                $(formMessages).html(response);
                // log data to the console so we can see
                console.log(response);
            })
            .fail(function(response) {
                // Reset the fields.
                 $('#formContato')[0].reset();
                // Set the message text.
                $(formMessages).html('<div class="alert alert-danger">Ocorreu algum erro ao enviar a mensagem! Mensagem não enviada!</div>');
             })
            .always(function() {
                //alert( "complete" );
            });            
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
});