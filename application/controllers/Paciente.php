<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends PidePassword {

	private $modulo;

	function __construct(){
        parent::__construct();
        $this->modulo = "Paciente";
    }

	public function index($paginaInicio=0,$numeroRegistros=10)
	{	

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("paciente",$error,$error);
			return;
		}

		$datos = array();
		$datos['titulo'] = "Pacientes";
		$datos['paginaActual'] = "paciente";
		$datos['usuarioLogeado'] = $user;
		$datos['moduloActual'] = $this->modulo;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');
		
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('pacientes/listaPacientesOSM',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function agregarPaciente(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("paciente",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "paciente";
		$datos['titulo'] = "Agregar paciente";
		$datos['soloLectura'] = FALSE;
		$datos['usuarioLogeado'] = $user;
		$datos['editar'] = FALSE;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('pacientes/formaPacienteOSM',$datos);
		$this->load->view('componentes/piePagina');	
	}



	public function editarPaciente(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("paciente",$error,$error);
			return;
		}


		$id = $this->obtenEntrada("id");
		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'id' => $id,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('id','id del paciente','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el paciente con id: $id";
			$this->mostrarPaginaError("paciente",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "paciente";
		$datos['titulo'] = "Editar paciente";
		$datos['usuarioLogeado'] = $user;
		$datos['idFirestore'] = $id;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('pacientes/formaPacienteOSM',$datos);
		$this->load->view('componentes/piePagina');
	}


	public function mostrarMapa(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("paciente",$error,$error);
			return;
		}


		$id = $this->obtenEntrada("id");
		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'id' => $id,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('id','id del paciente','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al mostrar el mapa el paciente con id: $id";
			$this->mostrarPaginaError("paciente",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "paciente";
		$datos['titulo'] = "Ubicación del paciente";
		$datos['idFirestore'] = $id;
		$datos['usuarioLogeado'] = $user;
		$datos['soloLectura'] = TRUE;
		$datos['editar'] = FALSE;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('pacientes/formaLugaresPacienteOSM',$datos);
		$this->load->view('componentes/piePagina');
	}
	
}









