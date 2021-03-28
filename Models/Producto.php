<?php namespace Models;

	class Producto{
		private $id;
		private $nombre;
		private $categoria;
		private $precio_venta;
		private $precio_compra;
		private $cantidad;

		private $con;

		public function __construct(){
			$this->con = new Conexion();
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}

		public function listarProductos(){
			$query = 'SELECT * FROM producto ORDER BY nombre';
			return $this->con->consultaRetorno($query);
		}

		public function add(){
			$query = "INSERT INTO producto(id_producto, nombre, categoria, precio_compra, precio_venta, cantidad) 
				VALUES (NULL, '$this->nombre', '{$this->categoria}', '{$this->precio_compra}', '{$this->precio_venta}', '{$this->cantidad}')";
			//var_dump($this->categoria);die;
			$this->con->consultaSimple($query);
		}

		public function delete($id_p){
			$query = "DELETE FROM producto WHERE id_producto = ".$id_p;
			$this->con->consultaSimple($query);
		}

		public function edit($id_p){
			$query = "UPDATE producto SET nombre = '{$this->nombre}', categoria = '{$this->categoria}', precio_venta = '{$this->precio_venta}', precio_compra = '{$this->precio_compra}',
					cantidad = '{$this->cantidad}' WHERE id_producto = ".$id_p;
			$this->con->consultaSimple($query);
		}

		public function viewId($id){
			$query = 'SELECT * FROM producto WHERE id_producto = '.$id;
			$datos = $this->con->consultaRetorno($query);
			$row = mysqli_fetch_assoc($datos);
			return $row;
		}
	

	}
 ?>