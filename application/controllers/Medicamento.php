<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicamento extends PidePassword {

	private $modulo;

	function __construct(){
        parent::__construct();
        $this->modulo = "Medicamento";
    }

	public function index($paginaInicio=0,$numeroRegistros=10)
	{	

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medicamento",$error,$error);
			return;
		}

		$datos = array();
		$datos['titulo'] = "Medicamentos";
		$datos['paginaActual'] = "medicamento";
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');
		
		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('medicamentos/listaMedicamentos',$datos);
		$this->load->view('componentes/piePagina');
	}


	public function agregarMedicamento(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medicamento",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "medicamento";
		$datos['titulo'] = "Agregar medicamento";
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = FALSE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('medicamentos/formaMedicamento',$datos);
		$this->load->view('componentes/piePagina');	
	}

	public function editarMedicamento(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("medicamento",$error,$error);
			return;
		}

		$id = $this->obtenEntrada("id");
		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'id' => $id,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('id','id del lugar','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el medicamento con id: $id";
			$this->mostrarPaginaError("medicamento",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "medicamento";
		$datos['titulo'] = "Editar medicamento";
		$datos['idFirestore'] = $id;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$usuarioLogeado = $this->session->userdata('username');

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('medicamentos/formaMedicamento',$datos);
		$this->load->view('componentes/piePagina');
	}
	
}









