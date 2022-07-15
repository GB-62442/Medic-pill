<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends PidePassword {

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
			$this->mostrarPaginaError("usuario",$error,$error);
			return;
		}
		
		// Se reciben los datos para la búsqueda
		$idContacto = $this->obtenEntrada("idContacto");
		$nombres = $this->obtenEntrada("nombres");
		$apellidos = $this->obtenEntrada("apellidos");
		$telefono = $this->obtenEntrada("telefono");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
			'idContacto' => $idContacto,
			'nombres' => $nombres,
			'apellidos' => $apellidos,
			'telefono' => $telefono,
			'paginaInicio' => $paginaInicio,
			'numeroRegistros' => $numeroRegistros
		);

		$this->form_validation->set_data($datosValidar);

		$this->form_validation->set_rules('idContacto','id del lugar','trim|integer|greater_than[0]');
		$this->form_validation->set_rules('nombres','nombres contacto','trim|callback_validaAlfanumericoAcentosEspacio');
		$this->form_validation->set_rules('apellidos','apellidos contacto','trim|callback_validaAlfanumericoAcentosEspacio');
		$this->form_validation->set_rules('telefono','número teléfonico','trim|numeric|max_lenght[10]');
		$this->form_validation->set_rules('paginaInicio','página de inicio','trim|integer');
		$this->form_validation->set_rules('numeroRegistros','registros por pagina','trim|integer|less_than_equal_to[1000]');

		if($this->form_validation->run() === FALSE){
			$this->listaContactos($idContacto,$nombres,$apellidos);
			return;
		}

		$this->load->model('ContactoModelo');
		$total = $this->ContactoModelo->reporteContactos($nombres,$apellidos,$telefono,$paginaInicio,$numeroRegistros,TRUE);
		$contactos = $this->ContactoModelo->reporteContactos($nombres,$apellidos,$telefono,$paginaInicio,$numeroRegistros);
		$consulta = "?nombres=$nombres&apellidos=$apellidos&telefono=$telefono";
		$paginacion = paginacion(base_url()."index.php/contactos/index",$paginaInicio,$numeroRegistros,$consulta,$total);

		$this->listaContactos($nombres,$apellidos,$telefono ,$paginacion,$contactos);
	}

	public function agregarContacto(){

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
			$error = "Error al editar el medicamento con id: $idPaciente";
			$this->mostrarPaginaError("medicamento",$error,$error);
			return;
		}	

		$datos = array();
		$datos['paginaActual'] = "contacto";
		$datos['titulo'] = "Agregar contacto";
		$datos['idFirestore'] = $idPaciente;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = FALSE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');
		$lista_permisos = $this->PermisosModelo->reportePermisos($usuarioLogeado,0, 1000);
		$datos['lista_permisos'] = $lista_permisos;

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('contactos/formaContacto',$datos);
		$this->load->view('componentes/piePagina');	
	}


	public function editarContacto(){

		$user = $this->session->userdata('username');

    	$this->load->model('PermisosModelo');
    	if($user == "" || $user == null){
			$error = "No tiene permisos para consultar";
			$this->mostrarPaginaError("usuario",$error,$error);
			return;
		}

		$idPaciente = $this->obtenEntrada("idPaciente");
		$idContacto = $this->obtenEntrada("idContacto");

		// Como vienen los datos por GET se ponen las siguientes dos instrucciones
		$datosValidar = array(
								'idPaciente' => $idPaciente,
								'idContacto' => $idContacto,
								);

		$this->form_validation->set_data($datosValidar);
		$this->form_validation->set_rules('idPaciente','id del paciente','trim|required');
		$this->form_validation->set_rules('idContacto','id del contacto','trim|required');

		if($this->form_validation->run() === FALSE){
			$error = "Error al editar el documento con id: $idContacto";
			$this->mostrarPaginaError("contacto",$error,$error);
			return;
		}

		$datos = array();
		$datos['paginaActual'] = "contacto";
		$datos['titulo'] = "Editar contacto";
		$datos['idFirestore'] = $idPaciente;
		$datos['idContacto'] = $idContacto;
		$datos['soloLectura'] = FALSE;
		$datos['editar'] = TRUE;
		$datos['usuarioLogeado'] = $user;

		$this->load->model('PermisosModelo');
		$usuarioLogeado = $this->session->userdata('username');
		$lista_permisos = $this->PermisosModelo->reportePermisos($usuarioLogeado,0, 1000);
		$datos['lista_permisos'] = $lista_permisos;

		$this->load->view('componentes/encabezado',$datos);
		$this->load->view('componentes/menuAdministracion',$datos);
		$this->load->view('contactos/formaContacto',$datos);
		$this->load->view('componentes/piePagina');
	}
	
}









