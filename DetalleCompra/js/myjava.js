$(function() {
	$('#guardar').on('click', function(){
		var url = document.URL;
		location.href=url;
	});
	
	$('#nuevaAsistencia').on('click', function(){
		$('#modalAsistencia').modal({
			show:true,
			backdrop:'static',
		});
	});
	
	
	$('#generarAsistencia').on('click', function(){
		var codigo = $('#codRegistro').val();
		var proveedor= $('#id_proveedor').val();

		if(codigo.length>0 && proveedor.length>0){
			var parametros ={
				"codigo": codigo,
				"proveedor": proveedor
			};
			$.ajax({
				type: 'POST',
				data: parametros,
				url: 'DetalleCompra/php/generarRegistro.php',
				success: function(data){
					if(data == 'existe'){
						$('#mensaje').html('<p class="alert alert-danger">Espere!!, este codigo de registro ya fue ingresado anteriormente, ingrese otro porfavor.</p>');
					}else{
					$('#Id_productosCompra').removeAttr('disabled').focus();
					$('#Descripcion').removeAttr('disabled').focus();
					$('#Precio').removeAttr('disabled').focus();
					$('#Cantidad').removeAttr('disabled').focus();
					//$('#Importe').removeAttr('disabled').focus();
					$('#regEstudiante').removeAttr('disabled');
					
					$('#codRegistro').attr('disabled','disabled');
					$('#id_proveedor').attr('disabled','disabled');
					$('#generarAsistencia').attr('disabled','disabled');
					}
				}
			});
		}else{
			$('#mensaje').html('<p class="alert alert-warning">Espere!!, tiene que ingresar el codigo del registro.</p>');
		}
	});
	
	$('#regEstudiante').on('click', function(){
		var idp = $('#Id_productosCompra').val();
		var des = $('#Descripcion').val();
		var pre = $('#Precio').val();
		var can = $('#Cantidad').val();
        var imp = $('#Importe').val();

		if(idp.length>0 && des.length>0 && pre.length>0 && can.length>0 && imp.length>0){
			var parametros1 = {
                "idp" : idp,
                "des" : des,
                "pre" : pre,
                "can" : can,
                "imp" : imp
        };
			$.ajax({
				type: 'POST',
				data: parametros1,
				url: 'DetalleCompra/php/ingresarEstudiante.php',
				success: function(data){
					$('#Id_productosCompra').val('').focus();
					$('#Descripcion').val('').focus();
					$('#Precio').val('').focus();
					$('#Cantidad').val('').focus();
					$('#Importe').val('').focus();
					$('#contenidoRegistro').html(data);
				}
			});
		}else{
			$('#mensaje').html('<p class="alert alert-warning">Espere!!, Seleccione un producto</p>');
		}
	});

});

$(function() {
	$('#cancelar').on('click', function(){
		$('#codRegistro').val();
		$('#id_proveedor').val();
		$('#Id_productosCompra').val();
		$('#Descripcion').val();
		$('#Precio').val();
		$('#Cantidad').val();
        $('#Importe').val();
	});
});



function verDetalle(codigo){
		$.ajax({
				type: 'POST',
				data: 'codigo='+codigo,
				url: 'DetalleCompra/php/verDetalle.php',
				success: function(data){
						$('#datosAqui').html(data);
						$('#modalDetalle').modal({
								show:true,
								backdrop:'static',
						});
				}
			});
		return false;
}