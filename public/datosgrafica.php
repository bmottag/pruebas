<?php
	
	$conexion = new mysqli('localhost','maxrico','ROv6nhAAlvAe','maxrico');
	
	$categorias = array('MES');
	$enero = array('Producto');

	
	$consulta = "SELECT T.TP_nombre Producto, sum(DF_valor_total) Valor_total
				FROM detalleFactura D
				inner join tipoProducto T on T.TP_id_tipo_producto = D.TP_id_tipo_producto
				inner join factura F on F.FA_id_factura = D.FA_id_factura
				group by D.TP_id_tipo_producto";
	$result = $conexion->query($consulta);

	
		foreach ($result as $lista):
			$categorias[] = substr($lista['Producto'], 0, 9);
			$enero[] = round($lista['Valor_total']);
		endforeach;
		
		
		
		
	
	echo json_encode( array($categorias,$enero) );
	
?>
