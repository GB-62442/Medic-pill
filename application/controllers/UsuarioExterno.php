<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioExterno extends MY_Controller {

	private $password;
	private $usuarioAgrego;

	function __construct(){
        parent::__construct();
    }

	public function index()
	{	
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
		$this->form_validation->set_rules('verificado','verificado','trim|required|is_bool|true');
		$this->form_validation->set_rules('token','token','trim|required');



		if($this->form_validation->run() === FALSE){
			$error ="Verifique los datos: ".validation_errors();
			$this->mostrarPaginaError("seguridad",$error,$error);

			//redirect(base_url()."index.php/seguridad/");
		}

		$sesionUsuario = array(
								'username' => $username,
								'sesion' => $token
								);

		$this->session->set_userdata($sesionUsuario);
		redirect(base_url()."index.php/paciente/");
	}

	public function generaSesionExterna(){

		if(empty($_GET)){
			redirect(base_url()."index.php/seguridad/");
		}

 		$username = $this->obtenEntrada("uid");
		$email = $this->obtenEntrada("email");
		$verificado = $this->obtenEntrada("emailVerificado");
		$token = $this->obtenEntrada("token");
		$ty = $this->obtenEntrada("ty");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'username' => $username,
								'email' => $email,
								'verificado' => $verificado,
								'token' => $token,
								'ty' => $ty,
								);

		$this->form_validation->set_data($datosValidar);

		$this->form_validation->set_rules('username','username','trim|required');
		$this->form_validation->set_rules('email','email','trim|required|valid_email');
		$this->form_validation->set_rules('verificado','verificado','trim|required');
		$this->form_validation->set_rules('ty','ty','trim|required');		
		$this->form_validation->set_rules('token','token','trim|required');

		if($this->form_validation->run() === FALSE){
			redirect(base_url()."index.php/seguridad/".validation_errors());
		}

		if($ty == 0){
			$sesionUsuario = array(
									'username' => $username,
									'sesion' => $token,
									'type' => $ty
									);

			$this->session->set_userdata($sesionUsuario);
			redirect(base_url()."index.php/medico/perfil");			
		}

		if($ty == 1){
			$sesionUsuario = array(
									'username' => $username,
									'sesion' => $token,
									);

			$this->session->set_userdata($sesionUsuario);
			redirect(base_url()."index.php/usuarioExterno/perfil");			
		}
	}



	public function validaUsuarioExterno(){
		$datos = array();
		$datos['titulo'] = "Validación usuario";
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('usuarioExterno/validaIniciarSesion',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function perfil(){

		$user = $this->session->userdata('username');
		$type = $this->session->userdata('type');

    	if($type != null || $type != "" || $user == "" || $user == null){
		redirect(base_url()."index.php/");
		}

		$datos = array();
		$datos['paginaActual'] = "usuario";
		$datos['titulo'] = "Perfil";
		$datos['idFirestore'] = $user;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuGeneral',$datos);
		$this->load->view('usuarioExterno/perfilUsuarioExterno',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function estadisticas(){

		$user = $this->session->userdata('username');
		$type = $this->session->userdata('type');

    	if($type != null || $type != "" || $user == "" || $user == null){
		redirect(base_url()."index.php/");
		}

		$datos = array();
		$datos['paginaActual'] = "usuario";
		$datos['titulo'] = "Mis estadisticas";
		$datos['idFirestore'] = $user;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezadoGrafica',$datos);
		$this->load->view('componentes/menuGeneral',$datos);
		$this->load->view('usuarioExterno/mostrarGraficaExterno',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function restablecer(){
		$datos = array();
		$datos['paginaActual'] = "seguridad";
		$datos['titulo'] = "Restablecer contraseña";
		$datos['error'] = "";
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menu',$datos);
		$this->load->view('seguridad/solicitudRestablecer',$datos);
		$this->load->view('componentes/piePagina');
	}

	private function muestraPaginaSesion($titulo="Inicio de sesión",$error=""){
		$datos = array();
		$datos['paginaActual'] = "seguridad";
		$datos['titulo'] = $titulo;
		$datos['error'] = $error;
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menu',$datos);
		$this->load->view('seguridad/iniciarSesion',$datos);
		$this->load->view('componentes/piePagina');
	}


	private function generaSesion($uid=""){
		$this->load->model('UsuarioModelo');
		$usuarioValidado = $this->UsuarioModelo->esUsuario($uid, $this->password);

		if($usuarioValidado==null){
			$titulo = "Inicio de sesión";
			$error = "El usuario o la contraseña no coinciden";
			$this->muestraPaginaSesion($titulo,$error);
			return;
		}

		$sesionUsuario = array(
								'username' => $usuarioValidado->username,
								'sesion' => $usuarioValidado->sesion
								);

		$this->session->set_userdata($sesionUsuario);
	}



}












