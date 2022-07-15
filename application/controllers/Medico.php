<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends PidePassword {

	private $modulo;

	function __construct(){
        parent::__construct();
        $this->modulo = "Usuario";
    }

	/******************************************************
		COMIENZA FIREBASE
	******************************************************/

	public function index($paginaInicio=0,$numeroRegistros=10)
	{	

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medico",$error,$error);
			return;
		}

		$datos = array();
		$datos['titulo'] = "Usuarios medico";
		$datos['paginaActual'] = "medico";

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');
		$datos['usuarioLogeado'] = $user;
		
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('doctoresFirestore/listaDoctores',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function agregarMedico(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medico",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "medico";
		$datos['titulo'] = "Agregar medico";
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = FALSE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('doctoresFirestore/formaDoctor',$datos);
		$this->load->view('componentes/piePagina');	
	}

public function editarMedico(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medico",$error,$error);
			return;
		}

		$id = $this->obtenEntrada("id");
		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'id' => $id,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('id','id del medico','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el medico con id: $id";
			$this->mostrarPaginaError("medico",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "medico";
		$datos['titulo'] = "Editar medico";
		$datos['idFirestore'] = $id;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('doctoresFirestore/formaDoctor',$datos);
		$this->load->view('componentes/piePagina');
	}

public function perfil(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medico",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "medico";
		$datos['titulo'] = "Perfil";
		$datos['idFirestore'] = $user;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('doctoresFirestore/perfilMedico',$datos);
		$this->load->view('componentes/piePagina');
	}

}









