<?php namespace Controllers;
	
	use Models\Producto as Producto;

	class homeController{

		private $producto;

		public function __construct(){
			$this->producto = new Producto();
		}

		public function index(){
			
			$losproductos = $this->producto->listarProductos();

			return ['vista' => 'index', 'losproductos' => $losproductos];
		}
		
		public function eliminar(){
			if ($_POST) {
				$this->producto->delete($_POST['id']);
			}
			header("Location: " . URL . "Home");
		}

		public function agregar(){
			if ($_POST) {
				$this->producto->set('nombre', $_POST['nombre']);
				$this->producto->set('categoria', $_POST['categoria']);
				$this->producto->set('precio_venta', $_POST['precio_venta']);
				$this->producto->set('precio_compra', $_POST['precio_compra']);
				$this->producto->set('cantidad', $_POST['cantidad']);

				$this->producto->add();
			}

			header("Location: " . URL . "Home");
		}

		public function editar(){
			if ($_POST) {
				$this->producto->set('nombre', $_POST['nombre']);
				$this->producto->set('categoria', $_POST['categoria']);
				$this->producto->set('precio_venta', $_POST['precio_venta']);
				$this->producto->set('precio_compra', $_POST['precio_compra']);
				$this->producto->set('cantidad', $_POST['cantidad']);

				$this->producto->edit($_POST['id']);
			}

			header("Location: " . URL . "Home");
		}

		public function ajaxProducto(){
			if ($_POST) {
				$prod = $this->producto->viewID($_POST['id']);
				echo json_encode([	"nombre" => $prod['nombre'], 
									"categoria" => $prod['categoria'], 
									"precio_compra" => $prod['precio_venta'], 
									"precio_venta" => $prod['precio_compra'], 
									"cantidad" => $prod['cantidad']
								]);
			}else{
				echo json_encode(["responseText" => "nanay"]);
			}
		}
	} 


 ?>