<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seguridad extends MY_Controller {

	function __construct(){
        parent::__construct();
    }

	public function index()
	{	
		$usuarioValido = $this->validaUsuario();
		if($usuarioValido !== TRUE){
			$this->formaInicioUsuario($usuarioValido);
			return;
		}
		redirect(base_url()."index.php/seguridad/salir");
	}

	private function formaInicioUsuario($error=FALSE){
		$datos = array();
		$datos['paginaActual'] = "seguridad";
		$datos['titulo'] = "Inicio de sesión";
		$datos['error'] = $error;
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menu',$datos);
		$this->load->view('seguridad/iniciarSesionExterna',$datos);
		$this->load->view('componentes/piePagina');
	}

	private function validaUsuario(){

		$this->load->model("UsuarioModelo");
		if($this->session->userdata('username')!= "" && $this->session->userdata('sesion') != "")
			return TRUE;


		if(empty($_POST))
			return "";

		$username = $this->obtenEntrada("username");
		$password = $this->obtenEntrada("password");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'username' => $username,
								'password' => $password,
								);

		$this->form_validation->set_data($datosValidar);

		$this->form_validation->set_rules('username','username','trim|required|callback_validaUsername|max_length[30]');
		$this->form_validation->set_rules('password','password','trim|required');

		if($this->form_validation->run() === FALSE){
			return "Datos incorrectos";
		}

		
		$usuario = $this->UsuarioModelo->esUsuario($username, $password);

		if($usuario==null)
			return "El usuario o la contraseña no coinciden";

		$sesionUsuario = array(
								'username' => $usuario->username,
								'sesion' => $usuario->sesion
								);

		$this->session->set_userdata($sesionUsuario);

		return TRUE;
	}

	private function validaUsuarioExterno(){
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("modulo",$error,$error);
			return;
		}

		if(empty($_POST))
			return "";
 
 		$username = $this->obtenEntrada("uid");
		$email = $this->obtenEntrada("email");
		$verificado = $this->obtenEntrada("emailVerificado");
		$token = $this->obtenEntrada("token");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'username' => $username,
								'email' => $email,
								'verificado' => $verificado,
								'token' => $token,
								);

		$this->form_validation->set_data($datosValidar);

		$this->form_validation->set_rules('username','username','trim|required|callback_validaUsername|max_length[30]');
		$this->form_validation->set_rules('email','email','trim|required|valid_email');
		$this->form_validation->set_rules('verificado','verificado','trim|required|is_bool');
		$this->form_validation->set_rules('token','token','trim|required');



		if($this->form_validation->run() === FALSE){
			return "Datos incorrectos";
		}

		$sesionUsuario = array(
								'username' => $username,
								'sesion' => $token
								);

		$this->session->set_userdata($sesionUsuario);


		return TRUE;
	}

	public function salir(){
		$this->load->model('UsuarioModelo');
		// Borra la sesión del usuario actual en la base de datos
		$this->UsuarioModelo->borrarSesion($this->session->userdata('username'));

		$sesionUsuario = array('sesion' => '');
		$this->session->set_userdata($sesionUsuario);
		$this->session->sess_destroy();
		redirect(base_url()."index.php/");
	}



}












