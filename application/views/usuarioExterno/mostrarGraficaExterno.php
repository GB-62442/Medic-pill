<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//die("habilitado $habilitado");
?>
<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->

  <?php
   if(isset($error) && $error != ""){
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        $error
      </div>
      ";
   }
  ?>
    <div class="row">

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row pt-8">
        <div class="col-xl-4 order-xl-2">

        </div>
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Información de usuario </h3>
                </div>
                <div class="col-4 text-right">
                 <!-- <input type="button" class="btn btn-sm btn-primary" value="Guardar cambios" onClick='editar()' /> -->
                </div>
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">Tus pesos</h6>
                <div class="pl-lg-4">
                  <div class="row">
              <div class="col-md-6 mb-3">
                <figure>
                  <div id="container"></div>
                </figure>
              </div>

  <!-- col-md-12 -->
  <div class="col-md-6 mb-3">
    <div id="tablaPesos" class="overflow-auto mb-2 col-md-12 mt-3" style="max-height: 250px;"></div>
    <!-- table-responsive -->
  </div>
  <!-- /col-md-12 -->            
                  </div>

                </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
</div>
<!-- /.container -->


<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_KEY_PARA_ESTE_SITIO;?>"></script>
<script src="<?php echo base_url(); ?>vendor/geofire/geofireCommon.min.js"></script>
<script type="text/javascript">

  // Se crea una instancia de la base de datos de Firestore
  var db = firebase.firestore();
  var auth  = firebase.auth();

<?php if($soloLectura || $editar): ?>
  leerMedico();

  let isRegisterId = null;
  let avatar = "";
  let arrAlturas = [];
  let arrPesos = [];
  let arrfechas = [];
  let arrIMC = [];
  let grficaTitulo = ""; 

  function leerMedico(){

    var referencia = db.collection("usuarios").where("authId", "==", "<?php echo $idFirestore ?>").limit("1").get().then((datosRecibidos) => {
      datosRecibidos.forEach((documento) => {
          if(documento.exists){
        isRegisterId = documento.id;
        

      }
      else{
        enviaAlerta("Registro","Parece que aun no terminas tu registro, por favor completa el formulario");
      }

      });
        if (isRegisterId == null){
          enviaAlerta("Registro","Parece que aun no terminas tu registro, por favor completa el formulario");
        }

        var user = firebase.auth().currentUser;
        var currentname, currentemail, currentphotoUrl, currentuid, currentemailVerified;

        if (user != null) {
          currentname = user.displayName;
          currentemail = user.email;
          currentphotoUrl = user.photoURL;
          currentemailVerified = user.emailVerified;
          currentuid = user.uid;

/*************************************************/

    var referencia = db.collection("usuarios").where("authId", "==", "<?php echo $idFirestore ?>").limit("1").get().then((datosRecibidos) => {
      datosRecibidos.forEach((documento) => {
          if(documento.exists){
              console.log("usr actual: " + documento.id);
/************************************************/
    leePaciente(documento.id);

/************************************************/
          }else{
            enviaAlerta("Registro","Parece que aun no terminas tu registro, por favor completa el formulario");
          }

      });
    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
/**************************************************/
        }

    })
    .catch((error) => {
        alert("Error obteniendo el documento: " + error);
    });
  }

<?php endif; ?>


    function leePaciente(param){

      var referencia = db.collection("usuarios").doc(param);

      referencia.get().then((documento) => {
      // Se revisa que el documento exista
      if(documento.exists){
        grficaTitulo = documento.data().nombres + " " + documento.data().apellido1 + " ";

        /***********************************************************
          CONTROL PESOS
          ************************************************************/

          var referenciaPesos = referencia.collection("pesos").orderBy("fecha", "asc");

          referenciaPesos.get().then(function(pesosRecibidos){
            var tabla = "<table class='table'>" +
            "<thead class='thead-light'>" +
            "<tr>" +
            "<th>Fecha</th>" +
            "<th>Estatura</th>" +
            "<th>Peso</th>" +
            "<th colspan='2' class='text-center'>IMC</th>" +
            "<tr>" +  
            "</thead>" +
            "<tbody>";
      // Cada uno de los datos recibidos se van pegando a la tabla
      pesosRecibidos.forEach((docPesos) => {
       /* IMC */
       let imc = Math.round(((docPesos.data().peso/(docPesos.data().estatura*docPesos.data().estatura)*100)*100 + Number.EPSILON) * 100) / 100;
       let imcIndice = "";
       if(imc<18.59)
        { imcIndice = "Bajo peso"; }
      else if(imc>=18.5 && imc<=24.99)
        { imcIndice = "Normal"; }
      else if(imc>=25 && imc<=29.99)
        { imcIndice = "Sobrepeso"; }
      else if(imc>30)
        { imcIndice = "Obesidad"; }
      /* Graficas */

      arrPesos.push(parseFloat(docPesos.data().peso));
      arrAlturas.push(parseFloat(docPesos.data().estatura));
      arrfechas.push(docPesos.data().fecha);
      arrIMC.push(imc);

      /* Tablas */
      tabla += "<tr>" +
      "<td>" + docPesos.data().fecha + "</td>" +
      "<td>" + docPesos.data().estatura + " cm" +  "</td>" +
      "<td>" + docPesos.data().peso + " kg" + "</td>" +
      "<td>" + imc + "</td>" +
      "<td>" + imcIndice +"</td>" +
      "</tr>";            
      });
      tabla += "</tbody>" +
      "</table>";

      // Buscamos dento de nuestro documento tablaFirestore y le pegamos el string
      // que acabamos de generar
      document.getElementById("tablaPesos").innerHTML = tabla;
      graficaDatos();
    }
    )
          .catch(function(error){
            alert("Error al leer los datos de Firestore " + error);
          });

          /************************************************************/

        }
        else{
          alert("El documento <?php echo $idFirestore ?> no existe");
        }
      })
      .catch((error) => {
        alert("Error obteniendo el documento: " + error);
      });
    }

</script>


<script type="text/javascript">
  function graficaDatos(){  
    Highcharts.chart('container', {
      chart: {
        type: 'areaspline'
      },
      title: {
        text: grficaTitulo
      },
      xAxis: {
        categories: arrfechas
      },
      credits: {
        enabled: false
      },
      series: [{
        name: 'Estatura',
        data: arrAlturas
      }, {
        name: 'Peso',
        data: arrPesos
      }, {
        name: 'IMC',
        data: arrIMC
      }]
    });
    
  }
</script>



