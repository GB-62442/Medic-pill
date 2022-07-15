<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tratamiento extends PidePassword {

	private $modulo;

	function __construct(){
		parent::__construct();
		$this->modulo = "Paciente";
	}


	public function agregarTratamiento(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("tratamiento",$error,$error);
			return;
		}

		$idPaciente = $this->obtenEntrada("idPaciente");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'idPaciente' => $idPaciente,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('idPaciente','id del paciente','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el documento con id: $idTratamiento";
			$this->mostrarPaginaError("tratamiento",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "tratamiento";
		$datos['titulo'] = "Agregar tratamiento";
		$datos['idFirestore'] = $idPaciente;
		$datos['usuarioLogeado'] = $user;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = FALSE;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('tratamientos/formaTratamiento',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function editarTratamiento(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("tratamiento",$error,$error);
			return;
		}

		$idPaciente = $this->obtenEntrada("idPaciente");
		$idTratamiento = $this->obtenEntrada("idTratamiento");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'idPaciente' => $idPaciente,
								'idTratamiento' => $idTratamiento,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('idPaciente','id del paciente','trim|required');
		$this->form_validation->set_rules('idTratamiento','id del tratamiento','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el documento con id: $idTratamiento";
			$this->mostrarPaginaError("tratamiento",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "tratamiento";
		$datos['titulo'] = "Editar tratamiento";
		$datos['idFirestore'] = $idPaciente;
		$datos['idTratamiento'] = $idTratamiento;
		$datos['usuarioLogeado'] = $user;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('tratamientos/formaTratamiento',$datos);
		$this->load->view('componentes/piePagina');
	}
	
}









