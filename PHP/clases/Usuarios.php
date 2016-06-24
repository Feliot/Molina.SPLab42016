<?php
require_once"accesoDatos.php";
class usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $correo;
  	public $clave;
  	public $tipo;
  	public $foto;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function Getcorreo()
	{
		return $this->correo;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function Getclave()
	{
		return $this->clave;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function Setcorreo($valor)
	{
		$this->correo = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function Setclave($valor)
	{
		$this->clave = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = usuario::TraerUnUsuario($id);
			$this->correo = $obj->correo;
			$this->nombre = $obj->nombre;
			$this->clave = $clave;
			$this->tipo = $tipo;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->correo."-".$this->nombre."-".$this->clave."-".$this->foto;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnUsuarioXClave($pclave ) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id =:id");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnUsuarioXClave(:pclave)");

			$consulta->bindValue(':pclave', $clave, PDO::PARAM_STR);
		$consulta->execute();
		$usuarioBuscada= $consulta->fetchObject('usuario');
		return $usuarioBuscada;	
					
	}
		public static function TraerUnUsuarioXNombre($nombre ) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id =:id");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnUsuarioXClave(:pnombre)");
		$consulta->bindValue(':pnombre',$nombre, PDO::PARAM_STR);
		
		$consulta->execute();
		$usuarioBuscada= $consulta->fetchObject('usuario');
		return $usuarioBuscada;	
					
	}

	
	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodosLosUsuarios() ");
		$consulta->execute();			
		$arrusuarios= $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");	
		return $arrusuarios;
	}
	
	public static function BorrarUsuario($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("delete from usuario	WHERE id=:id");	
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarUsuario(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function Modificarusuario($usuario)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set nombre=:nombre,
				correo=:correo,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();*/ 
			$consulta =$objetoAccesoDato->RetornarConsulta("CALL Modificarusuario(:id,:nombre,:correo,:clave,:tipo,:foto)");
			$consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':correo', $usuario->correo, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
			$consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
			$consulta->bindValue(':foto', $usuario->foto, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarUsuario($usuario)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,correo,clave,foto)values(:nombre,:correo,:clave,:foto)");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarUsuario (:nombre,:correo,:clave,:tipo,:foto)");
		$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':correo', $usuario->correo, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
		$consulta->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $usuario->foto, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//



	public static function TraerusuariosTest()
	{
		$arrayDeusuarios=array();

		$usuario = new stdClass();
		$usuario->id = "4";
		$usuario->nombre = "rogelio";
		$usuario->correo = "agua";
		$usuario->clave = "333333";
		$usuario->foto = "333333.jpg";

		//$objetJson = json_encode($usuario);
		//echo $objetJson;
		$usuario2 = new stdClass();
		$usuario2->id = "5";
		$usuario2->nombre = "Bañera";
		$usuario2->correo = "giratoria";
		$usuario2->clave = "222222";
		$usuario2->foto = "222222.jpg";

		$usuario3 = new stdClass();
		$usuario3->id = "6";
		$usuario3->nombre = "Julieta";
		$usuario3->correo = "Roberto";
		$usuario3->clave = "888888";
		$usuario3->foto = "888888.jpg";

		$arrayDeusuarios[]=$usuario;
		$arrayDeusuarios[]=$usuario2;
		$arrayDeusuarios[]=$usuario3;
		 
		

		return  $arrayDeusuarios;
				
	}	


}
