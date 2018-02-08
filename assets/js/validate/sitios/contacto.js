$( document ).ready( function () {

	$("#nombres").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#apellidos").bloquearNumeros().convertirMayuscula().maxlength(50);
	$("#cargo").convertirMayuscula();	
	$("#documento").bloquearTexto().maxlength(12);
	$("#telefono").bloquearTexto().maxlength(15);
	
	$( "#form" ).validate( {
		rules: {
			nombres: 			{ required: true, minlength: 3, maxlength:50 },
			apellidos: 			{ required: true, minlength: 3, maxlength:50 },
			cargo: 				{ required: true, minlength: 3, maxlength:50 },
			documento: 			{ required: true, number: true, minlength: 4, maxlength:12 },
			telefono:	 		{ required: true, number: true, minlength: 4, maxlength:15  },
			email: 				{ required: true, email: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "sitios/save_contactos",	
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');

							var url = base_url + "sitios/contactos/" + data.idRecord;
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});
});