<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antecedente extends PidePassword {

	private $modulo;

	function __construct(){
		parent::__construct();
		$this->modulo = "Paciente";
	}


	public function agregarAntecedente(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("usuario",$error,$error);
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
			$error = "Error al editar el documento con id: $idAntecedente";
			$this->mostrarPaginaError("usuario",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "antecedente";
		$datos['titulo'] = "Agregar antecedente";
		$datos['idFirestore'] = $idPaciente;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = FALSE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('antecedentes/formaAntecedente',$datos);
		$this->load->view('componentes/piePagina');
	}

	public function editarAntecedente(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("usuario",$error,$error);
			return;
		}

		$idPaciente = $this->obtenEntrada("idPaciente");
		$idAntecedente = $this->obtenEntrada("idAntecedente");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'idPaciente' => $idPaciente,
								'idAntecedente' => $idAntecedente,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('idPaciente','id del paciente','trim|required');
		$this->form_validation->set_rules('idAntecedente','id del antecedente','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el documento con id: $idAntecedente";
			$this->mostrarPaginaError("antecedente",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "antecedente";
		$datos['titulo'] = "Editar antecedente";
		$datos['idFirestore'] = $idPaciente;
		$datos['idAntecedente'] = $idAntecedente;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('antecedentes/formaAntecedente',$datos);
		$this->load->view('componentes/piePagina');
	}
	
}









