<?php 

include "clases/Productos.php";
include "clases/Usuarios.php";
// $_GET['accion'];


if ( !empty( $_FILES ) ) {
    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    // $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    $uploadPath = "../". DIRECTORY_SEPARATOR . 'fotos' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $tempPath, $uploadPath );
    $answer = array( 'respuesta' => 'Archivo Cargado!' );
    $json = json_encode( $answer );
    echo $json;
}elseif(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	if($accion=="traer")
	{
		$respuesta= array();
		//$respuesta['listado']=producto::TraerProductosTest();
		$respuesta['listado']=producto::TraerTodasLasProductos();
		//var_dump(producto::TraerTodasLasProductos());
		$arrayJson = json_encode($respuesta);
		echo  $arrayJson;
	}


	

}
else{

	$DatosPorPost = file_get_contents("php://input");
	$respuesta = json_decode($DatosPorPost);

	if(isset($respuesta->datos->accion)){

		switch($respuesta->datos->accion)
		{
			case "borrar_producto":	
				if($respuesta->datos->producto->foto!="pordefecto.png")
				{
					unlink("../fotos/".$respuesta->datos->producto->foto);
				}
				producto::Borrarproducto($respuesta->datos->producto->id);
			break;

			case "insertar_producto":	
				producto::Insertarproducto($respuesta->datos->producto);
			break;
			case "insertar_usuario":	
				if($respuesta->datos->usuario->foto!="pordefecto.png")
				{
					$rutaVieja="../fotos/".$respuesta->datos->producto->foto;
					$rutaNueva=$respuesta->datos->producto->dni.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
					copy($rutaVieja, "../fotos/".$rutaNueva);
					unlink($rutaVieja);
					$respuesta->datos->usuario->foto=$rutaNueva;
				}
				producto::InsertarUsuario($respuesta->datos->usuario);
			break;

			case "buscar_producto":
			
				echo json_encode(producto::TraerUnaproducto($respuesta->datos->id));
				break;

			case "buscar_usuario":
				echo json_encode(producto::TraerUnaproducto($respuesta->datos->id));
				break;
	
			case "modificar":
			
				if($respuesta->datos->producto->foto!="pordefecto.png")
				{
					$rutaVieja="../fotos/".$respuesta->datos->producto->foto;
					$rutaNueva=$respuesta->datos->producto->dni.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
					copy($rutaVieja, "../fotos/".$rutaNueva);
					unlink($rutaVieja);
					$respuesta->datos->producto->foto=$rutaNueva;
				}
				producto::Modificarproducto($respuesta->datos->producto);
				break;
		}//switch($respuesta->datos->accion)
	}//if(isset($respuesta->datos->accion)){


}



 ?>