<?php 
	namespace Controllers;

	use Models\Usuario as Usuario;

	class loginController{

		public function __construct(){
		}

		public function index(){
			if ($_POST) {
				$usuarios_api = json_decode( file_get_contents("https://api.mocki.io/v1/2186297b"), true);
				$elusuario = $_POST['usuario'];
				$password = $_POST['pass'];

				# POR SI SE AGREGAN MAS USUARIOS A LA API
				if(is_array( current($usuarios_api) )){
					foreach ($usuarios_api as $user ) {
						if ($user['user']==$elusuario && $user['pass']==$password) {
							$_SESSION['login'] = true;
							$_SESSION['nombre'] = $usuarios_api['user'];
							header("Location: " . URL . "home");
						}
					}
				}else{
					if ($usuarios_api['user']==$elusuario && $usuarios_api['pass']==$password) {
						$_SESSION['login'] = true;
						$_SESSION['nombre'] = $usuarios_api['user'];
						header("Location: " . URL . "home");
					}
				}

				return ['error' => 'error'];
			}
			
			return '';
		}

		public function logout(){
			session_start();
			session_unset(); 
			session_destroy(); 
			header("Location: " . URL . "login");
		}

	}

?>