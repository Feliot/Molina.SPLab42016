<?php
require_once"accesoDatos.php";
class producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $porcentaje;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function Getporcentaje()
	{
		return $this->porcentaje;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetDni()
	{
		return $this->dni;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function Setporcentaje($valor)
	{
		$this->porcentaje = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($dni=NULL)
	{
		if($dni != NULL){
			$obj = producto::TraerUnaproducto($dni);
			
			$this->porcentaje = $obj->porcentaje;
			$this->nombre = $obj->nombre;
			$this->dni = $dni;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->porcentaje."-".$this->nombre."-".$this->dni."-".$this->foto;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnProducto($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto where id =:id");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnProducto(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$productoBuscada= $consulta->fetchObject('producto');
		return $productoBuscada;	
					
	}
	
	public static function TraerTodosLosProductos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodosLosProductos() ");
		$consulta->execute();			
		$arrproductos= $consulta->fetchAll(PDO::FETCH_CLASS, "producto");	
		return $arrproductos;
	}
	
	public static function BorrarProducto($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("delete from producto	WHERE id=:id");	
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL Borrarproducto(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarProducto($producto)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("
				update producto 
				set nombre=:nombre,
				porcentaje=:porcentaje,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();*/ 
			$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarproducto(:id,:nombre,:porcentaje)");
			$consulta->bindValue(':id',$producto->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':porcentaje', $producto->porcentaje, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function Insertarproducto($producto)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (nombre,porcentaje,dni,foto)values(:nombre,:porcentaje,:dni,:foto)");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL Insertarproducto (:nombre,:porcentaje)");
		$consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':porcentaje', $producto->porcentaje, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//



	public static function TraerproductosTest()
	{
		$arrayDeproductos=array();

		$producto = new stdClass();
		$producto->id = "4";
		$producto->nombre = "rogelio";
		$producto->porcentaje = "agua";
		$producto->dni = "333333";
		$producto->foto = "333333.jpg";

		//$objetJson = json_encode($producto);
		//echo $objetJson;
		$producto2 = new stdClass();
		$producto2->id = "5";
		$producto2->nombre = "Bañera";
		$producto2->porcentaje = "giratoria";
		$producto2->dni = "222222";
		$producto2->foto = "222222.jpg";

		$producto3 = new stdClass();
		$producto3->id = "6";
		$producto3->nombre = "Julieta";
		$producto3->porcentaje = "Roberto";
		$producto3->dni = "888888";
		$producto3->foto = "888888.jpg";

		$arrayDeproductos[]=$producto;
		$arrayDeproductos[]=$producto2;
		$arrayDeproductos[]=$producto3;
		 
		

		return  $arrayDeproductos;
				
	}	


}
