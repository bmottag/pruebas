/**
 * Muchipio por Departamento
 * @since  12/5/2017
 */

$(document).ready(function () {
	    
    $('#bloques').change(function () {
        $('#bloques option:selected').each(function () {
            var bloques = $('#bloques').val();
            if (bloques > 0 || bloques != '-') {
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'sitios/salonesList',
                    data: {'identificador': bloques},
                    cache: false,
                    success: function (data)
                    {
                        $('#mcpio').html(data);
                    }
                });
            } else {
                var data = '';
                $('#mcpio').html(data);
            }
        });
    });
    
});