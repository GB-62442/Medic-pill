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


  <form class="needs-validation" novalidate>
    <div class="row">
<div class="col-md-6">
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
              <label class="form-control-label" for="nombre">Nombre (s) del paciente</label>
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                </div>
                <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo set_value("nombre",isset($nombre)?$nombre:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Nombre del paciente">
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
              <label class="form-control-label" for="apellido2"> </label>
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                </div>
                <input class="form-control" type="text" name="apellido2" id="apellido2" value="<?php echo set_value("apellido2",isset($apellido2)?$apellido2:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Apellido del paciente (opcional)">
              </div>
              <small class="text-danger" id="errorApellidos" style="display: none;">Escriba un apellido valido para del paciente</small>
            </div>

            <div class="col-md-12 form-group">
              <label class="form-control-label" for="direccion">Dirección</label>
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                </div>
                <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo set_value("direccion",isset($direccion)?$direccion:""); ?>" <?php if($soloLectura) echo "readonly"; ?> placeholder="Dirección de contacto">
              </div>
              <small class="text-danger" id="errorDireccion" style="display: none;">Escriba una dirección valida</small>
            </div>

            <div class="col-md-12" style="display:inline-flex; padding: 0">

              <div class="col-md-6 form-group">
                <label class="form-control-label" for="latitud">Latitud</label>
                <input type="number" name="latitud" id="latitud" class="form-control" value="<?php echo set_value("latitud",isset($latitud)?$latitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="0.000000001" min="-90" max="90">
                <small class="text-danger" id="errorLatitud" style="display: none;">Escriba la latitud</small>
              </div>
              <div class="col-md-6 form-group">
                <label class="form-control-label" for="longitud">Longitud</label>
                <input type="number" name="longitud" id="longitud" class="form-control" value="<?php echo set_value("longitud",isset($longitud)?$longitud:""); ?>" <?php if($soloLectura) echo "readonly"; ?> step="0.000000000000001" min="-180.00000000000000" max="180.00000000000000" >
                <small class="text-danger" id="errorLongitud" style="display: none;">Escriba la longitud</small>
              </div>
            </div>    

    </div>

    <div class="col-md-6">
      <div class="col-md-12 form-group">
        <div class="card">
          <div class="card-body">
            <div id="map" style="width: 100%; height: 550px; padding: 10px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if(!$soloLectura): ?>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4 form-group">
        <input type="button" class="form-control btn btn-primary" value="<?php echo $titulo; ?>" <?php echo ($editar?"onClick='editarLugar()'":"onClick='agregarLugar()'"); ?> >
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
<!-- /.container -->

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY_PARA_ESTE_SITIO;?>"></script>
<script>
      let latCentral = <?php echo $latitud; ?>;
      let longCentral = <?php echo $longitud; ?>;
      let coordenadas = <?php echo $coordenadas; ?>;
      let map;
      let marcador;

      initMap();

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: coordenadas,
          zoom: 17,
          mapTypeId: "OSM",
        });

        let punto = new google.maps.LatLng(latCentral,longCentral);
        let titulo = "<b>Coordenadas</b><br>"+latCentral+","+longCentral;
        marcador = crearMarcador(punto,titulo);


        <?php if(!$soloLectura): ?>
        google.maps.event.addListener(map, 'click', function(event) {
          if(marcador){
            marcador.setMap(null); // Borramos el marcador
            marcador = null;
          }

          let latLngActual = event.latLng;
          let lat = latLngActual.lat();
          let lng = latLngActual.lng();

          lat = lat.toFixed(9);
          lng = lng.toFixed(9);

          titulo = "<b>Coordenadas</b><br>"+lat+","+lng;
          marcador = crearMarcador(latLngActual,titulo);

          $("#latitud").val(lat);
          $("#longitud").val(lng);

        });
      <?php endif; ?>

      }


      function crearMarcador(coordenada,titulo) {
        let marcador = new google.maps.Marker({
          position: coordenada,
          map: map,
          animation: google.maps.Animation.DROP,
          icon: "<?php echo base_url()?>/vendor/assets/img/brand/marcador-de-posicion-3.png",

        });

        google.maps.event.addListener(marcador, 'click', function() {
          infowindow = new google.maps.InfoWindow({
            size: new google.maps.Size(150,50)
          });
          infowindow.setContent(titulo);
          infowindow.open(map,marcador);
        });

        google.maps.event.trigger(marcador, 'click');

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
              // Wrap y (latitude) in a like manner if you want to enable vertical infinite scrolling

              return "https://tile.openstreetmap.org/" + zoom + "/" + x + "/" + coord.y + ".png";
          },
          tileSize: new google.maps.Size(256, 256),
          name: "OpenStreetMap",
          maxZoom: 11
      }));

</script>

<script type="text/javascript">

<?php if($soloLectura || $editar): ?>
  leeLugar();

  function leeLugar(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>");

    referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        $("#nombre").val(documento.data().nombres);
        $("#apellido1").val(documento.data().apellido1);
        $("#apellido2").val(documento.data().apellido2);
        $("#direccion").val(documento.data().direccion);

        $("#latitud").val(documento.data().ubicacion.latitude);
        $("#longitud").val(documento.data().ubicacion.longitude);

        var punto = new google.maps.LatLng(documento.data().ubicacion.latitude,documento.data().ubicacion.longitude);
        var titulo = "<b>" + documento.data().nombres + " " + documento.data().apellido1 + "</b><br><b>Coordenadas</b><br>"+documento.data().ubicacion.latitude+','+documento.data().ubicacion.longitude;

        // Borramos el marcador anterior
        if(marcador){
            marcador.setMap(null); // Borramos el marcador
            marcador = null;
        }

        marcador = crearMarcador(punto,titulo);
        map.setCenter(punto);
      }
      else{
        alert("El documento <?php echo $idFirestore ?> no existe");
      }
    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
  }
<?php endif; ?>

<?php if(!$soloLectura && $editar): ?>
  function editarLugar(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    latitud = $("#latitud").val();
    longitud = $("#longitud").val();

    error = false;
    if(nombre == ""){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
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

    db.collection("ubicaciones").doc("<?php echo $idFirestore ?>").set({
        nombre: nombre,
        punto: new firebase.firestore.GeoPoint(latitud,longitud)
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/lugarFirestore/index"; ?>";
    })
    .catch((error) => {
        alert("Error editando el documento: " + error);
    });
  }
<?php elseif(!$soloLectura): ?>
  function agregarLugar(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

    nombre = $("#nombre").val();
    latitud = $("#latitud").val();
    longitud = $("#longitud").val();

    error = false;
    if(nombre == ""){
      $("#errorNombre").css("display","block");
      error = true;
    }
    else{
      $("#errorNombre").css("display","none");
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

    db.collection("ubicaciones").add({
        nombre: nombre,
        punto: new firebase.firestore.GeoPoint(latitud,longitud)
    })
    .then((documento) => {
        //alert("Se escribió el documento con el ID: " + documento.id);
        //console.log("El objeto es: %o", documento);
        location.href = "<?php echo base_url()."index.php/lugarFirestore/index"; ?>";
    })
    .catch((error) => {
        alert("Error agregando el documento: " + error);
    });
  }

<?php endif; ?>

</script>













