<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo extends PidePassword {

	private $modulo;

	function __construct(){
        parent::__construct();
        $this->modulo = "Modulo";
    }

	public function index($paginaInicio=0,$numeroRegistros=10)
	{	

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("modulo",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "modulos";
		$datos['titulo'] = "Módulos";
		$datos['usuarioLogeado'] = $user;

		$usuarioLogeado = $this->session->userdata('username');
	
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('modulosFirestore/listaModulos',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function agregarModulo(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("modulo",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "modulo";
		$datos['titulo'] = "Agregar modulo";
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = FALSE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('modulosFirestore/formaModulo',$datos);
		$this->load->view('componentes/piePagina');	
	}

	public function editarModulo(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("modulo",$error,$error);
			return;
		}


		$id = $this->obtenEntrada("id");
		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'id' => $id,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('id','id del modulo','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el modulo con id: $id";
			$this->mostrarPaginaError("modulo",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "modulo";
		$datos['titulo'] = "Editar modulo";
		$datos['idFirestore'] = $id;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('modulosFirestore/formaModulo',$datos);
		$this->load->view('componentes/piePagina');	
	}
	
}









