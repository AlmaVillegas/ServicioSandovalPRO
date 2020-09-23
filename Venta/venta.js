$(document).on('ready', funcPrincipal);

function fincPrincipal()
{
	$("#btnNuevoProducto").on('click', funcNuevoProducto);
}

function funcNuevoProducto()
{
	$("#tablaProductos")
	.append
	(   
	    $('<tr>')
	    .append
	    (
	    	$('<td>')
	    	.append
	    	( 
	    		$('<input>').attr('type','text').addclass('form-control')
	    	)
	    )
	    .append
	    (
	    	$('<td>')
	    	.append
	    	( 
	    		$('<option>').attr('type','text').addclass('form-control')
	    	)
	    )
	    .append
	    (
	    	$('<td>')
	    	.append
	    	( 
	    		$('<input>').attr('type','text').addclass('form-control')
	    	)
	    )
	    .append
	    (
	    	$('<td>')
	    	.append
	    	( 
	    		$('<input>').attr('type','text').addclass('form-control')
	    	)
	    )
	    .append
	    (
	    	$('<td>')
	    	.append
	    	( 
	    		$('<input>').attr('type','text').addclass('form-control')
	    	)
	    )

	 );

}