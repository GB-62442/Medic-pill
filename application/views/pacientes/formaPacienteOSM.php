<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$latitud = LAT_CENTRAL;
$longitud = LNG_CENTRAL;

$coordenadas = "{ lat: $latitud, lng: $longitud }";

?>

<!-- Page Content -->
<div class="container">

	<!-- Page Heading -->
	<h1 class="my-4"><?php echo $titulo; ?></h1>

	<?php
	if(isset($error) && $error != ""){
		echo "
		<div class='alert alert-danger'>
		$error
		</div>";
	}
	?>

	<div class="col-md-12">
		<div class="row pb-5">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<h3 class="col-md-12">Datos personales</h3>
			<?php if( ($soloLectura || $editar) && isset($idFirestore) ): ?>
			<div class="col-md-6">
				<div id="showDatos" class="border-bottom mb-3"><h5 class="my-4 text-info">Datos del paciente <i class="fas fa-caret-down"></i></h5></div>     
				<div class='div-que-se-esconde' style='display: none;'>
				<?php endif; ?>  

				<?php if(!isset($idFirestore) ): ?>
					<div class="col-md-12">
						<div id="showDatos" class="border-bottom mb-3"><h5 class="my-4 text-info">Datos del paciente <i class="fas fa-caret-down"></i></h5></div>
						<div class='div'>
				<?php endif; ?>  

						<form class="needs-validation" novalidate>

							<?php if( ($soloLectura || $editar) && isset($idFirestore) ): ?>
							<div class="col-md-12 form-group">
								<label class="form-control-label" for="idFirestore">ID del usuario</label>
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-circle-08"></i></span>
									</div>
									<input type="text" name="idFirestore" id="idFirestore" required class="form-control" value="<?php echo set_value("idFirestore",isset($idFirestore)?$idFirestore:""); ?>" readonly>
								</div>
								<small class="text-danger" id="errorId" style="display: none;">Escriba el id</small>
							</div>


						<?php endif; ?>  

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="nombres">Nombre (s)</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-folder-17"></i></span>
								</div>
								<input class="form-control" type="text" name="nombres" id="nombres" value="<?php echo set_value("nombres",isset($nombres)?$nombres:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre del paciente">
							</div>
							<small class="text-danger" id="errorNombre" style="display: none;">Escriba el nombre del paciente</small>
						</div>

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="apellido1">Apellido (s)</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-folder-17"></i></span>
								</div>
								<input class="form-control" type="text" name="apellido1" id="apellido1" value="<?php echo set_value("apellido1",isset($apellido1)?$apellido1:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido del paciente">
							</div>
							<small class="text-danger" id="errorApellidos" style="display: none;">Escriba un apellido valido para del paciente</small>
						</div>

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="apellido2">Apellido (s)</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-folder-17"></i></span>
								</div>
								<input class="form-control" type="text" name="apellido2" id="apellido2" value="<?php echo set_value("apellido2",isset($apellido2)?$apellido2:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido del paciente (opcional)">
							</div>
							<small class="text-danger" id="errorApellidos" style="display: none;">Escriba un apellido valido para del paciente</small>
						</div>

						<div class="col-md-12" style="display:inline-flex; padding:0;">

							<div class="col-md-12 form-group">
								<label class="form-control-label" for="edad">Edad</label>
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-folder-17"></i></span>
									</div>
									<input class="form-control" type="number" name="edad" id="edad" value="<?php echo set_value("edad",isset($edad)?$edad:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="1" min="0" max="99" placeholder="Edad del paciente">
								</div>
								<small class="text-danger" id="errorEdad" style="display: none;">Escriba una edad valida para el paciente</small>
							</div>
						</div>

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="nacimiento">Fecha de nacimiento</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
								</div>
								<input class="form-control" type="text" name="nacimiento" id="nacimiento" value="<?php echo set_value("nacimiento",isset($nacimiento)?$nacimiento:""); ?>" maxlength="10" <?php if($soloLectura) echo "readonly"; ?> placeholder="Fecha de nacimiento DD-MM-AAAA">
							</div>
							<small class="text-danger" id="errorNacimiento" style="display: none;">Escriba un fecha valida en formato DD-MM-AAAA</small>
						</div>
				<?php if(!isset($idFirestore) ): ?>

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="correo">Correo eléctronico</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-email-83"></i></span>
								</div>
								<input class="form-control" type="email" name="correo" id="correo" value="<?php echo set_value("correo",isset($correo)?$correo:""); ?>" maxlength="255" <?php if($soloLectura) echo "readonly"; ?> placeholder="Correo eléctronico profesional">
							</div>
							<small class="text-danger" id="errorCorreo" style="display: none;">Escriba un correo eléctronico valido</small>
						</div>
						<?php endif; ?>  

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="telefono">Teléfono</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
								</div>
								<input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo set_value("telefono",isset($telefono)?$telefono:""); ?>" maxlength="10" <?php if($soloLectura) echo "readonly"; ?> placeholder="Número telefonico de contacto">
							</div>
							<small class="text-danger" id="errorTelefono" style="display: none;">Escriba un número teléfonico valido</small>
						</div>

						<div class="col-md-12 form-group">
							<label class="form-control-label" for="direccion">Dirección</label>
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-square-pin"></i></span>
								</div>
								<input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value("direccion",isset($direccion)?$direccion:""); ?>" maxlength="255" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dirección de contacto">
							</div>
							<small class="text-danger" id="errorDireccion" style="display: none;">Escriba una dirección valida</small>
						</div>

						<div class="col-md-12" style="display:inline-flex; padding: 0">

							<div class="col-md-6 form-group">
								<label class="form-control-label" for="latitud">Latitud</label>
								<input type="number" name="latitud" id="latitud" class="form-control" value="<?php echo set_value("latitud",isset($latitud)?$latitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="0.000000000000001" min="-90" max="90">
								<small class="text-danger" id="errorLatitud" style="display: none;">Escriba la latitud</small>
							</div>
							<div class="col-md-6 form-group">
								<label class="form-control-label" for="longitud">Longitud</label>
								<input type="number" name="longitud" id="longitud" class="form-control" value="<?php echo set_value("longitud",isset($longitud)?$longitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="0.000000000000001" min="-180.00000000000000" max="180.00000000000000" >
								<small class="text-danger" id="errorLongitud" style="display: none;">Escriba la longitud</small>
							</div>
						</div>		
				<?php if(!isset($idFirestore) ): ?>

						<div class="col-md-12" style="display:inline-flex; padding: 0">

							<div class="col-md-6 form-group">
								<label class="form-control-label" for="password">Contraseña</label>
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-key-25"></i></span>
									</div>
									<input class="form-control" type="password" name="password" id="password" value="<?php echo set_value("password",isset($password)?$password:""); ?>" maxlength="25" <?php if($soloLectura) echo "readonly"; ?> placeholder="Contraseña">
								</div>
								<small class="text-danger" id="errorPassword" style="display: none;">Escriba una contraseña valida</small>
							</div>

							<div class="col-md-6 form-group">
								<label class="form-control-label" for="password2">Repita la contraseña</label>
								<div class="input-group input-group-merge input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-key-25"></i></span>
									</div>
									<input class="form-control" type="password" name="password2" id="password2" value="<?php echo set_value("password2",isset($password2)?$password2:""); ?>" maxlength="25" <?php if($soloLectura) echo "readonly"; ?> placeholder="Contraseña">
								</div>
								<small class="text-danger" id="errorPassword2" style="display: none;">Las contraseñas deben coincidir</small>
							</div>
						</div>
						<?php endif; ?>  

						<?php if(!$soloLectura): ?>
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-4 form-group">
									<input type="button" class="form-control btn btn-primary" value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarPaciente()'":"onClick='agregarPaciente()'"); ?> >
								</div>
								<div class="col-md-2"></div>
								<div class="col-md-4 form-group">
									<input type="regresar" class="form-control btn btn-success" value="Regresar" onclick="window.history.back();">
								</div>
								<div class="col-md-1"></div>
							</div>
							<?php else: ?>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4 form-group">
										<input type="regresar" class="form-control btn btn-success" value="Regresar" onclick="window.history.back();">
									</div>
									<div class="col-md-4"></div>
								</div>
							<?php endif; ?>

						</form>

					</div>
				</div>
				<!-- Contactos --->
				<?php if( ($soloLectura || $editar) && isset($idFirestore) ): ?>

				<div class="col-md-6">
					<div id="showContactos" class="border-bottom"><h5 class="my-4 text-info">Contactos de emergencia  <i class="fas fa-caret-down"></i></h5></div>
					<div class="divContactos" style="display: none;">

						<button class="form-control btn btn-primary mt-3 mb-3" onclick="location.href='<?php echo base_url(); ?>index.php/contacto/agregarContacto?idPaciente=<?php echo $idFirestore; ?>'">Agregar contacto de emergencia</button>

						<!-- -->
						<div id="tarjetasContactos" class="overflow-auto mb-2" style="max-height: 250px;"></div>
						<!-- -->

						<!-- mapa OSM -->
						<div class="row">
							<div class="col-md-12 form-group">

								<div class="card">
          							<div class="card-body">
										<div id="map" style="width: 100%; height: 500px; padding: 10px;"></div>
          							</div>
        						</div>
							</div>
						</div>
						<!-- fin mapa OSM -->
					</div>
				</div>
				<!-- /Contactos --->
			</div>
			

			<!-- historial --->
			<div class="row">
				<h3 class="col-md-12 mt-5">Historial médico </h3>
				<!-- tratamientos -->
				<div class="col-md-6">
					<div id="showTratamiento" class="border-bottom"><h5 class="my-4 text-info">Tratamientos  <i class="fas fa-caret-down"></i></h5></div>
					<div class="divTratamiento" style="display: none;">
<!-- 
						<button class="form-control btn btn-primary mt-3 mb-3" onclick="location.href='<?php echo base_url(); ?>index.php/tratamiento/agregarTratamiento?idPaciente=<?php echo $idFirestore; ?>'">Agregar tratamiento</button>-->

						<!-- -->
						<div id="tarjetasTratamientos" class="overflow-auto mb-2" style="max-height: 250px;"></div>
						<!-- -->
					</div>
				</div>
				<!-- tratamientos -->

				<!-- antecedentes -->
				<div class="col-md-6">
					<div id="showAntecedente" class="border-bottom"><h5 class="my-4 text-info">Antecedentes  <i class="fas fa-caret-down"></i></h5></div>
					<div class="divAntecedente" style="display: none;">

						<button class="form-control btn btn-primary mt-3 mb-3" onclick="location.href='<?php echo base_url(); ?>index.php/antecedente/agregarAntecedente?idPaciente=<?php echo $idFirestore; ?>'">Agregar antecedente</button>

						<!-- -->
						<div id="tarjetasAntecedentes" class="overflow-auto mb-2" style="max-height: 500px;"></div>
						<!-- -->
					</div>
				</div>
				<!-- antecedentes -->

			</div> 

			<!-- ./historial medico  -->

			<!-- seguimiento -->
			<div class="row">
				<h3 class="col-md-12 mt-5">Seguimiento</h3>
				<div class="col-md-12">
					<div id="showSeguimiento" class="border-bottom"><h5 class="my-4 text-info">Control de peso  <i class="fas fa-caret-down"></i></h5></div>
					<div class="divSeguimiento" style="display: none;">
						<div class="col-md-12" style="display:inline-flex; padding: 0;">
							<!-- -->
							<div id="tablaPesos" class="overflow-auto mb-2 col-md-9 mt-3" style="max-height: 500px;"></div>
							<!-- -->
							<div class="col-md-3" style="max-height: 250px;">
								<button class="form-control btn btn-primary mt-3 mb-3" onclick="location.href='<?php echo base_url(); ?>index.php/peso/agregarPeso?idPaciente=<?php echo $idFirestore; ?>'">Agregar registro</button>

								<button class="form-control btn btn-default mt-3 mb-3" onclick="location.href='<?php echo base_url(); ?>index.php/peso/controlEstadisticas?idPaciente=<?php echo $idFirestore; ?>'">Ver estadisticas</button>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<!-- /seguimiento --->

		<?php endif; ?>

	</div>
	<!-- -->

</div>

</div>
<!-- /.container -->

<!-- --->
<script>
	$(document).ready(function(){
		$('#showDatos').click(function() {
			$('.div-que-se-esconde').toggle("slide");
		});
	});

	$(document).ready(function(){
		$('#showContactos').click(function() {
			$('.divContactos').toggle("slide");
		});
	});

	$(document).ready(function(){
		$('#showSeguimiento').click(function() {
			$('.divSeguimiento').toggle("slide");
		});
	});

	$(document).ready(function(){
		$('#showAntecedente').click(function() {
			$('.divAntecedente').toggle("slide");
		});
	});

	$(document).ready(function(){
		$('#showTratamiento').click(function() {
			$('.divTratamiento').toggle("slide");
		});
	});

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY_PARA_ESTE_SITIO;?>"></script>
<script src="<?php echo base_url(); ?>vendor/geofire/geofireCommon.min.js"></script>

<script>
	let latCentral = <?php echo $latitud; ?>;
	let longCentral = <?php echo $longitud; ?>;
	let coordenadas = <?php echo $coordenadas; ?>;
	let map;
	var marcadores = [];

	initMap();

	function initMap() {
		map = new google.maps.Map(document.getElementById("map"), {
			center: coordenadas,
			zoom: 11,
			mapTypeId: "OSM",
		});

		let punto;
		let titulo;

		<?php
		if(isset($contactos)){
			echo 
			"
			let limites = new google.maps.LatLngBounds();";
			foreach ($contactos as $contacto) {
				echo 
				"
				punto = new google.maps.LatLng($contacto->latitud,$contacto->longitud);
				titulo = '<b>$contacto->nombres $contacto->apellidos</b><br><b>Parentesco: $contacto->parentesco</br>Coordenadas</b><br>'+latCentral+','+longCentral;
				crearMarcador(punto,titulo);
				limites.extend(punto);";
			}
			echo 
			"
			map.fitBounds(limites);";
		}
		?>
	}

	function crearMarcador(coordenada,titulo) {
		let marcador = new google.maps.Marker({
			position: coordenada,
			map: map,
			animation: google.maps.Animation.DROP,
        	icon: "<?php echo base_url()?>/vendor/assets/img/brand/marcador-de-posicion.png",

		});

		google.maps.event.addListener(marcador, 'click', function() {
			infowindow = new google.maps.InfoWindow({
				size: new google.maps.Size(150,50)
			});
			infowindow.setContent(titulo);
			infowindow.open(map,marcador);
		});

        //google.maps.event.trigger(marcador, 'click');

        return marcador;
    }

      //Define OSM map type pointing at the OpenStreetMap tile server
      map.mapTypes.set("OSM", new google.maps.ImageMapType({
      	getTileUrl: function(coord, zoom) {
              // "Wrap" x (longitude) at 180th meridian properly
              // NB: Don't touch coord.x: because coord param is by reference, and changing its x property breaks something in Google's lib
              var tilesPerGlobe = 1 << zoom;
              var x = coord.x % tilesPerGlobe;
              if (x < 0) {
              	x = tilesPerGlobe+x;
              }

              return "https://tile.openstreetmap.org/" + zoom + "/" + x + "/" + coord.y + ".png";
          },
          tileSize: new google.maps.Size(256, 256),
          name: "OpenStreetMap",
          maxZoom: 12
      }));

  </script>

<script type="text/javascript">

  <?php if($soloLectura || $editar): ?>
  	leePaciente();

  	function leePaciente(){
  		validaSesionfirebase("<?php $usuarioLogeado ?>");
  		var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>");

  		referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
      	$("#nombres").val(documento.data().nombres);
      	$("#apellido1").val(documento.data().apellido1);
      	$("#apellido2").val(documento.data().apellido2);
      	$("#edad").val(documento.data().edad);
      	$("#correo").val(documento.data().correo);
      	$("#nacimiento").val(documento.data().date);      	
      	$("#telefono").val(documento.data().telefono);
      	$("#direccion").val(documento.data().direccion);
      	$("#latitud").val(documento.data().ubicacion.latitude);
      	$("#longitud").val(documento.data().ubicacion.longitude);

      	/***********************************************************
			CONTACTOS
			************************************************************/

			var referenciaContactos = referencia.collection("contactos");

			referenciaContactos.get().then(function(contactosRecibidos){
	      // Para que el mapa se ajuste a las coordenadas recibidas
	      var limites = new google.maps.LatLngBounds();

	      for(var i=0; i<marcadores.length; i++){
	      	marcadores[i].setMap(null);
	      	marcadores[i] = null;
	      }
	      marcadores = [];
	      var tarjetas = "<div>";
	      // Cada uno de los datos recibidos se van pegando a la tabla
	      contactosRecibidos.forEach((docContactos) => {
			if(docContactos.exists){

	      	tarjetas += "<div>" +
	      	"<div class='card card-stats'>" +
	      	"<div class='card-body rounded'>" + 
	      	"<div class='dropdown col-md-12 float-right'>" +
	      	"<a class='btn btn-sm btn-icon-only text-light float-right' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
	      	"<i class='fas fa-ellipsis-v'></i>" +
	      	"</a>" +
	      	"<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
	      	"<span class='dropdown-item' onclick=editarContacto('" + documento.id + "','" + docContactos.id + "') >Editar</span>" +
	      	"<span class='dropdown-item' onclick=borrarContacto('" + documento.id + "','" + docContactos.id + "')>Borrar</span> " +
	      	"</div>" +
	      	"<div class='row d-flex'>" +
	      	"<div class='col'>" +
	      	"<h5 class='card-title text-uppercase text-muted mb-0'>" +
	      	docContactos.data().nombres + " " + docContactos.data().apellidos + "</h5>" +
	      	"</div>" +
	      	"</div>" +
	      	"<p class='mt-3 mb-0 text-sm'>" +
	      	"<span class='text-nowrap'><strong>Parentesco:</strong> "+ docContactos.data().parentesco +"</span><br>" +
	      	"<span class='text-nowrap'><strong>Teléfono:</strong> "+ docContactos.data().telefono +"</span><br>" +
	      	"<span class='text-nowrap'><strong>Dirección:</strong> "+ docContactos.data().direccion +"</span><br>" +
	      	"</p>" +
	      	"</div>" +
	      	"</div>" +
	      	"</div>";
			if(typeof docContactos.data().ubicacion !== 'undefined'){	      	
		      	var punto = new google.maps.LatLng(docContactos.data().ubicacion.latitude,docContactos.data().ubicacion.longitude);
		      	var titulo = "<b>" + docContactos.data().nombres + " " + docContactos.data().apellidos + "</b><br><b>Coordenadas</b><br>"+docContactos.data().ubicacion.latitude+' N ,'+docContactos.data().ubicacion.longitude + ' W';
		      	var marcador = crearMarcador(punto,titulo);
		      	marcadores.push(marcador);
		            // Se añade un punto a los limites para que el mapa se ajuste a las coordenadas recibidas
		            limites.extend(punto);
		        }
		    }
	        });

	      tarjetas += "</div>";

	      // Buscamos dento de nuestro documento tablaFirestore y le pegamos el string que acabamos de generar
	      document.getElementById("tarjetasContactos").innerHTML = tarjetas;
	      map.fitBounds(limites);
	      
	  })
			.catch(function(error){
				alert("Error al leer los datos de contactos en Firestore " + error);
			});


      	/***********************************************************
			TRATAMIENTOS
			************************************************************/

			var referenciaTratamientos = referencia.collection("tratamientos");
			referenciaTratamientos.get().then(function(tratamientosRecibidos){
				trat = "";
				tratamientosRecibidos.forEach((docTratamientos) => {
					trat += "<div>" +
					"<div class='card card-stats'>" +
					"<div class='dropdown col-md-12 float-right'>" +
					"<a class='btn btn-sm btn-icon-only text-light float-right' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
					"<i class='fas fa-ellipsis-v'></i>" +
					"</a>" +
					"<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
					"<span class='dropdown-item' onclick=borrarTratamiento('" + documento.id + "','" + docTratamientos.id + "'); >Borrar</span>" + 
					"</div>" +
					"<div class='card-body'>" +       
					"<div class='row'>" +
					"<div class='col'>" +
					"<span class='h2 font-weight-bold mb-0'>" + docTratamientos.data().nombre + "</span>" +
					"<h5 class='card-title text-uppercase text-muted mb-0'>Dosis: " + docTratamientos.data().dosis + "</h5>" +
					"<h5 class='card-title text-uppercase text-muted mb-0'>Por: " + docTratamientos.data().duracion + " Hrs</h5>" +
					"</div>" +
					"<div class='col-auto'>" +
					"<div class='icon icon-shape bg-default text-secondary rounded-circle shadow'>" +
					"<i class='ni ni-ambulance'></i>" +
					"</div>" +
					"</div>" +
					"</div>" +
					"<p class='mt-3 mb-0 text-sm'>" +
					"<span class='text-default mr-2'><i class='ni ni-watch-time'></i> Registro: " + docTratamientos.data().fecha + "</span>" +
					"</p>" +
					"</div>" +
					"</div>" +
					"</div>";
				});

				trat += "";

      // Buscamos dento de nuestro documento tablaFirestore y le pegamos el string
      document.getElementById("tarjetasTratamientos").innerHTML = trat;
  		}
  	)
	.catch(function(error){
		alert("Error al leer los datos de Firestore " + error);
	});

    /***********************************************************
		ANTECEDENTES
	************************************************************/

	var referenciaAntecedentes = referencia.collection("antecedentes");
	referenciaAntecedentes.get().then(function(antecedentesRecibidos){
		ante = "";
		antecedentesRecibidos.forEach((docAntecedentes) => {
			ante += "<div>" +
			"<div class='card card-stats'>" +
			"<div class='dropdown col-md-12 float-right'>" +
			"<a class='btn btn-sm btn-icon-only text-light float-right' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
			"<i class='fas fa-ellipsis-v'></i>" +
			"</a>" +
			"<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
			"<span class='dropdown-item' onclick=editarAntecedente('" + documento.id + "','" + docAntecedentes.id + "'); >Editar</span>" + 
			"<span class='dropdown-item' onclick=borrarAntecedente('" + documento.id + "','" + docAntecedentes.id + "') >Borrar</span>" +
			"</div>" +
			"<div class='card-body'>" +
			"<div class='row'>" +
			"<div class='col'>" +
			"<span class='h2 font-weight-bold mb-0'>" + docAntecedentes.data().enfermedad + docAntecedentes.data().procedimiento + "</span>" +
			"<h5 class='card-title text-uppercase text-muted mb-0'>Tratamiento: " + docAntecedentes.data().tratamiento.substr(0, 15) + "..." + "</h5>" +
			"</div>" +
			"<div class='col-auto'>" +
			"<div class='icon icon-shape bg-default text-secondary rounded-circle shadow'>" +
			"<i class='ni ni-archive-2'></i>" +
			"</div>" +
			"</div>" +
			"</div>" +
			"<p class='mt-3 mb-0 text-sm'>" +
			"<span class='text-default mr-2'><i class='ni ni-watch-time'></i> Registro: " + docAntecedentes.data().fecha +"</span>" +
			"</p>" +
			"</div>" +
			"</div>" +
			"</div>";
		});
		ante += "";

      // Buscamos dento de nuestro documento tablaFirestore y le pegamos el string
      // que acabamos de generar
      document.getElementById("tarjetasAntecedentes").innerHTML = ante;
  	})
  	.catch(function(error){
  		alert("Error al leer los datos de Firestore " + error);
  	});

  	/***********************************************************
		CONTROL PESOS
	************************************************************/
	var referenciaPesos = referencia.collection("pesos");
	referenciaPesos.get().then(function(pesosRecibidos){
		var tabla = "<table class='table'>" +
		"<thead class='thead-dark'>" +
		"<tr>" +
		"<th>Fecha</th>" +
		"<th>Estatura</th>" +
		"<th>Peso</th>" +
		"<th>IMC</th>" +
		"<th colspan='2' class='text-center'>Acciones</th>" +
		"<tr>" +
		"</thead>" +
		"<tbody>";
		// Cada uno de los datos recibidos se van pegando a la tabla
		pesosRecibidos.forEach((docPesos) => {
			tabla += "<tr>" +
			"<td>" + docPesos.data().fecha + "</td>" +
			"<td>" + docPesos.data().estatura + " cm" +  "</td>" +
			"<td>" + docPesos.data().peso + " kg" + "</td>" +
			"<td>" + Math.round(((docPesos.data().peso/(docPesos.data().estatura*docPesos.data().estatura)*100)*100 + Number.EPSILON) * 100) / 100 + 
			"</td>" +
			"<td class='text-right'>"+
			"<div class='dropdown'>" +
			"<a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
			"<i class='fas fa-ellipsis-v'></i>" +
			"</a>" +
			"<div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>" +
			"<span class='dropdown-item' onclick=editarPeso('" + documento.id + "','" + docPesos.id + "'); >Editar</span>" + 
			"<span class='dropdown-item' onclick=borrarPeso('" + documento.id + "','" + docPesos.id + "'); >Borrar</span>" +
			"</div>" +
			"</div>" +
			"</td>" +
			"</tr>";
		});
		tabla += "</tbody>" +
		"</table>";
		// Buscamos dento de nuestro documento tablaFirestore y le pegamos el string
		// que acabamos de generar
		document.getElementById("tablaPesos").innerHTML = tabla;
	})
	.catch(function(error){
		alert("Error al leer los datos de Firestore " + error);
	});

	/************************************************************/
	}
	else{
		alert("El documento <?php echo $idFirestore ?> no existe");
	}})
	.catch((error) => {
		console.log("Error obteniendo el documento: " + error);
	});
}
<?php endif; ?>

<?php if(!$soloLectura && $editar): ?>
	function editarPaciente(){
    	validaSesionfirebase("<?php $usuarioLogeado ?>");

		nombres = $("#nombres").val();
		apellido1 = $("#apellido1").val();
		apellido2 = $("#apellido2").val();
		edad = $("#edad").val();
		correo = $("#correo").val();
		nacimiento = $("#nacimiento").val();
    	nacimiento = nacimiento.replaceAll('/', '-');
		telefono = $("#telefono").val();
		direccion = $("#direccion").val();
		latitud = $("#latitud").val();
		longitud = $("#longitud").val();
		password = $("#password").val();
		password2 = $("#password2").val();

    			let regNumbers = /^\d+$/;
          		let regLetters = /^[a-zA-Z\s]*$/;
    			let regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       			let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;


				error = false;
				if(nombres == "" || regLetters.test(nombres) != true){
					$("#errorNombre").css("display","block");
					error = true;
				}
				else{
					$("#errorNombre").css("display","none");
					if(!error)
						error = false;
				}

				if(apellido1 == "" || regLetters.test(apellido1) != true){
					$("#errorApellidos").css("display","block");
					error = true;
				}
				else{
					$("#errorApellidos").css("display","none");
					if(!error)
						error = false;
				}

				if(edad == "" || edad<0 || regNumbers.test(edad) != true){
					$("#errorEdad").css("display","block");
					error = true;
				}
				else{
					$("#errorEdad").css("display","none");
					if(!error)
						error = false;
				}

				if(nacimiento == "" || regexDate.test(nacimiento) != true){
					$("#errorNacimiento").css("display","block");
					error = true;
				}
				else{
					$("#errorNacimiento").css("display","none");
					if(!error)
						error = false;
				}

  				if(telefono == "" || telefono.length != 10 || regNumbers.test(telefono) != true){
					$("#errorTelefono").css("display","block");
					error = true;
				}
				else{
					$("#errorTelefono").css("display","none");
					if(!error)
						error = false;
				}    

				if(direccion == ""){
					$("#errorDireccion").css("display","block");
					error = true;
				}
				else{
					$("#errorDireccion").css("display","none");
					if(!error)
						error = false;
				} 


				if(latitud == ""){
					$("#errorLatitud").css("display","block");
					error = true;
				}
				else{
					$("#errorLatitud").css("display","none");
					if(!error)
						error = false;
				} 

				if(longitud == ""){
					$("#errorLongitud").css("display","block");
					error = true;
				}
				else{
					$("#errorLongitud").css("display","none");
					if(!error)
						error = false;
				}     

  			if(error)
  				return;

		    latitud = parseFloat(latitud);
		    longitud = parseFloat(longitud);
		    geohash = geofireCommon.geohashForLocation([latitud, longitud]); 

  			var usuarioUpdate = db.collection("usuarios").doc("<?php echo $idFirestore ?>");

			return usuarioUpdate.update({
				nombres: nombres,
				apellido1: apellido1,
				apellido2: apellido2,
				edad: edad,
				date: nacimiento,
				telefono: telefono,
				direccion: direccion,
				ubicacion: new firebase.firestore.GeoPoint(latitud,longitud),
        		geohash: geohash

			})
			.then(() => {
				enviaAlerta("Mensaje","Datos de usuario actualizados exitosamente");
				location.href = "<?php echo base_url()."index.php/paciente/editarPaciente?id=".$idFirestore; ?>";

			})
			.catch((error) => {
			    // The document probably doesn't exist.
			    alert("Error editando el documento: " + error);
			});
		}

		<?php elseif(!$soloLectura): ?>
			function agregarPaciente(){
    			validaSesionfirebase("<?php $usuarioLogeado ?>");

				nombres = $("#nombres").val();
				apellido1 = $("#apellido1").val();
				apellido2 = $("#apellido2").val();
				edad = $("#edad").val();
				correo = $("#correo").val();
				nacimiento = $("#nacimiento").val();
				nacimiento = nacimiento.replaceAll('/', '-');
				telefono = $("#telefono").val();
				direccion = $("#direccion").val();
				latitud = $("#latitud").val();
				longitud = $("#longitud").val();
				password = $("#password").val();
				password2 = $("#password2").val();

    			let regNumbers = /^\d+$/;
    			let regLetters = /^[a-zA-Z\s]*$/;
    			let regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       			let regexDate = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;


				error = false;
				if(nombres == "" || regLetters.test(nombres) != true){
					$("#errorNombre").css("display","block");
					error = true;
				}
				else{
					$("#errorNombre").css("display","none");
					if(!error)
						error = false;
				}

				if(apellido1 == "" || regLetters.test(apellido1) != true){
					$("#errorApellidos").css("display","block");
					error = true;
				}
				else{
					$("#errorApellidos").css("display","none");
					if(!error)
						error = false;
				}

				if(edad == "" || edad<0 || regNumbers.test(edad) != true){
					$("#errorEdad").css("display","block");
					error = true;
				}
				else{
					$("#errorEdad").css("display","none");
					if(!error)
						error = false;
				}

				if(nacimiento == "" || regexDate.test(nacimiento) != true){
					$("#errorNacimiento").css("display","block");
					error = true;
				}
				else{
					$("#errorNacimiento").css("display","none");
					if(!error)
						error = false;
				}

				if(correo == "" || regexEmail.test(correo) == false){
					$("#errorCorreo").css("display","block");
					error = true;
				}
				else{
					$("#errorCorreo").css("display","none");
					if(!error)
						error = false;
				}

  				if(telefono == "" || telefono.length != 10 || regNumbers.test(telefono) != true){
					$("#errorTelefono").css("display","block");
					error = true;
				}
				else{
					$("#errorTelefono").css("display","none");
					if(!error)
						error = false;
				}    

				if(direccion == ""){
					$("#errorDireccion").css("display","block");
					error = true;
				}
				else{
					$("#errorDireccion").css("display","none");
					if(!error)
						error = false;
				} 


				if(latitud == ""){
					$("#errorLatitud").css("display","block");
					error = true;
				}
				else{
					$("#errorLatitud").css("display","none");
					if(!error)
						error = false;
				} 

				if(longitud == ""){
					$("#errorLongitud").css("display","block");
					error = true;
				}
				else{
					$("#errorLongitud").css("display","none");
					if(!error)
						error = false;
				}     

				if(password == "" || password.length < 6){
					$("#errorPassword").css("display","block");
					error = true;
				}
				else{
					$("#errorPassword").css("display","none");
					if(!error)
						error = false;
				}      

				if(password2 == "" || password.length < 6 || password2 != password){
					$("#errorPassword2").css("display","block");
					error = true;
				}
				else{
					$("#errorPassword2").css("display","none");
					if(!error)
						error = false;
				}      

				if(error)
					return;

			    latitud = parseFloat(latitud);
			    longitud = parseFloat(longitud);
			    geohash = geofireCommon.geohashForLocation([latitud, longitud]); 

				firebase.auth().createUserWithEmailAndPassword(correo, password)
				.then((usuarioAuth) => {
					console.log(usuarioAuth);

					db.collection("usuarios").add({
						authId: usuarioAuth.user.uid, 
						nombres: nombres,
						apellido1: apellido1,
						apellido2: apellido2,
						edad: edad,
						date: nacimiento,
						telefono: telefono,
						direccion: direccion,
						ubicacion: new firebase.firestore.GeoPoint(latitud,longitud),
        				geohash: geohash
					})
					.then((documento) => {
        			location.href = "<?php echo base_url()."index.php/paciente/index"; ?>";
    				})
					.catch((error) => {
						alert("Error agregando el documento: " + error);
					});

				})
				.catch((error) => {
					alert("Error agregando el documento: " + error);

			});

			}

		<?php endif; ?>

		function editarContacto(idFirestore, idContacto){
			validaSesionfirebase("<?php $usuarioLogeado ?>");
			location.href="<?php echo base_url()."index.php/contacto/editarContacto?idPaciente="; ?>" + idFirestore + "&idContacto=" + idContacto;
		}

		function borrarContacto(idFirestore, idContacto){
			validaSesionfirebase("<?php $usuarioLogeado ?>");
			db.collection("usuarios").doc(idFirestore).collection('contactos').doc(idContacto).delete().then(() => {
				leePaciente();
				enviaAlerta("Mensaje","Se eliminó el documento " + idFirestore);
			})
			.catch((error) => {
				alert("Error agregando el documento: " + error);
			});
		}  

		function editarTratamiento(idFirestore, idDocumento){
    		validaSesionfirebase("<?php $usuarioLogeado ?>");
			location.href="<?php echo base_url()."index.php/tratamiento/editarTratamiento?idPaciente="; ?>" + idFirestore + "&idTratamiento=" + idDocumento;
		}

		function borrarTratamiento(idFirestore, idDocumento){
    		validaSesionfirebase("<?php $usuarioLogeado ?>");
			db.collection("usuarios").doc(idFirestore).collection('tratamientos').doc(idDocumento).delete().then(() => {
				leePaciente();
				enviaAlerta("Mensaje","Se eliminó el documento " + idFirestore);
			})
			.catch((error) => {
				alert("Error agregando el documento: " + error);
			});
		}


		function editarAntecedente(idFirestore, idDocumento){
    		validaSesionfirebase("<?php $usuarioLogeado ?>");
			location.href="<?php echo base_url()."index.php/antecedente/editarAntecedente?idPaciente="; ?>" + idFirestore + "&idAntecedente=" + idDocumento;
		}

		function borrarAntecedente(idFirestore, idDocumento){
			validaSesionfirebase("<?php $usuarioLogeado ?>");
			db.collection("usuarios").doc(idFirestore).collection('antecedentes').doc(idDocumento).delete().then(() => {
				leePaciente();
				enviaAlerta("Mensaje","Se eliminó el documento " + idFirestore);
			})
			.catch((error) => {
				alert("Error agregando el documento: " + error);
			});
		}  				  		

		function editarPeso(idFirestore, idContacto){
			validaSesionfirebase("<?php $usuarioLogeado ?>");
			location.href="<?php echo base_url()."index.php/peso/editarRegistro?idPaciente="; ?>" + idFirestore + "&idControlPeso=" + idContacto;
		}

		function borrarPeso(idFirestore, idContacto){
    		validaSesionfirebase("<?php $usuarioLogeado ?>");
			db.collection("usuarios").doc(idFirestore).collection('pesos').doc(idContacto).delete().then(() => {
				leePaciente();
				enviaAlerta("Mensaje","Se eliminó el documento " + idFirestore);
			})
			.catch((error) => {
				alert("Error agregando el documento: " + error);
			});
		}

		function seguirPaciente(idFirestore){
    		validaSesionfirebase("<?php $usuarioLogeado ?>");
			let date = new Date()
			let day = date.getDate()
			let month = date.getMonth() + 1
			let year = date.getFullYear()
			let today = "";
			if(month < 10){
			  today = `${day}-0${month}-${year}`;
			}else{
			  today = `${day}-${month}-${year}`;
			}

			var usesr = firebase.auth().currentUser;

			db.collection("medicos").doc(usesr.uid).collection('pacientes').doc(idFirestore).set({
            authId: idFirestore, 
            siguiendo: today,
          })
			.catch((error) => {
				enviaAlerta("Error","Ya esta siguiendo a " + idFirestore);
			});
				enviaAlerta("Confirmación","Siguiendo al paciente " + idFirestore);
		}		

	</script>