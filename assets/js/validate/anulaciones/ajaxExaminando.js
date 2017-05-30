/**
 * Muchipio por Departamento
 * @since  12/5/2017
 */

$(document).ready(function () {
	    
    $('#consecutivo').blur(function () {

            var consecutivo = $('#consecutivo').val();
			var idMunicipio = $('#hddIdMunicipio').val();
			var codigoDane = $('#hddCodigoDane').val();
			
            if (consecutivo > 0 || consecutivo != '') {
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'anulaciones/examinandoList',
                    data: {'consecutivo': consecutivo, 'idMunicipio': idMunicipio, 'codigoDane': codigoDane},
                    cache: false,
                    success: function (data)
                    {
                        $('#snp').html(data);
                    }
                });
            } else {
                var data = '';
                $('#snp').html(data);
            }

    });
    
});