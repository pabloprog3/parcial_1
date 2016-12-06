<?php
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $marca;
 	private $modelo;
 	private $fecha;
 	private $so;
 	private $sim;
  	private $pathFoto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetSO()
	{
		return $this->so;
	}
	public function GetModelo()
	{
		return $this->nombre;
	}
	public function GetPathFoto()
	{
		return $this->pathFoto;
	}

	public function GetMarca()
	{
		return $this->marca;
	}

	public function GetFecha()
	{
		return $this->fecha;
	}

	private function GetSim()
	{
		return $this->sim;
	}



	public function SetSO($valor)
	{
		$this->so = $valor;
	}
	public function SetModelo($valor)
	{
		$this->modelo = $valor;
	}
	public function SetPathFoto($valor)
	{
		$this->pathFoto = $valor;
	}

	public function SetMarca($valor)
	{
		$this->marca = $valor;
	}
	public function SetFecha($valor)
	{
		$this->fecha = $valor;
	}
	public function SetSim($valor)
	{
		$this->sim = $valor;
	}
	


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($marca=NULL, $modelo=NULL, $fecha=NULL, $so=NULL, $cant=NULL, $pathFoto=NULL)
	{
		if($marca !== NULL && $marca !== NULL){
			$this->marca = $marca;
			$this->modelo = $modelo;
			$this->fecha = $fecha;
			$this->so = $so;
			$this->sim = $cant;
			$this->pathFoto = $pathFoto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->marca."-".$this->modelo."-".$this->fecha."-".$this->so."-".$this->sim."-".$this->pathFoto."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
	public static function Guardar($obj)
	{
		$resultado = FALSE;

		$ar = fopen("archivos/productos.txt", "a");

		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		fclose($ar);
		
		return $resultado;
	}
	public static function TraerTodosLosProductos()
	{

		$ListaDeProductosLeidos = array();

		//leo todos los productos del archivo
		$archivo=fopen("archivos/productos.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$productos = explode(" - ", $archAux);
			//http://www.w3schools.com/php/func_string_explode.asp
			$productos[0] = trim($productos[0]);
			if($productos[0] != ""){
				$ListaDeProductosLeidos[] = new Producto($productos[0], $productos[1],$productos[2]);
			}
		}
		fclose($archivo);
		
		return $ListaDeProductosLeidos;
		
	}
	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$ListaDeProductosLeidos = Producto::TraerTodosLosProductos();
		$ListaDeProductos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeProductosLeidos); $i++){
			if($ListaDeProductosLeidos[$i]->codBarra == $obj->codBarra){//encontre el modificado, lo excluyo
				$imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
		}

		array_push($ListaDeProductos, $obj);//agrego el producto modificado
		
		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeProductos AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function Eliminar($codBarra)
	{
		if($codBarra === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeProductosLeidos = Producto::TraerTodosLosProductos();
		$ListaDeProductos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeProductosLeidos); $i++){
			if($ListaDeProductosLeidos[$i]->codBarra == $codBarra){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeProductos AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
//--------------------------------------------------------------------------------//
}