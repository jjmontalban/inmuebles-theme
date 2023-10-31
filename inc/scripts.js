jQuery(document).ready(function($) {
    $('#formulario-contacto').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function() {
                $('#respuesta-formulario').html('<p style="color: green;">¡Consulta enviada con éxito!</p>');
                $('#formulario-contacto')[0].reset(); // Limpia los campos del formulario
            },
            error: function() {
                $('#respuesta-formulario').html('<p style="color: red;">Ha ocurrido un error al enviar la consulta.</p>');
            }
        });
    });
});  