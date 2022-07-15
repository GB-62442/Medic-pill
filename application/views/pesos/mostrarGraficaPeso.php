<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

  <div class="row">
    <div class="col-md-12" style="display:inline-flex; padding: 0;">

      <div class="col-md-9 mb-3">
        <figure>
          <div id="container"></div>
        </figure>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <input type="regresar" class="form-control rounded-pill btn btn-success" value="Regresar" onclick="window.history.back();">
        </div>
      </div>
    </div>
  </div>

  <!-- col-md-12 -->
  <div class="row">
    <div id="tablaPesos" class="overflow-auto mb-2 col-md-12 mt-3" style="max-height: 250px;"></div>
    <!-- table-responsive -->
  </div>
  <!-- /col-md-12 -->

  <!-- Pagination -->
  <?php if(isset($paginacion)) echo $paginacion; ?>

</div>
<!-- /.container -->

<script type="text/javascript">

  let arrAlturas = [];
  let arrPesos = [];
  let arrfechas = [];
  let arrIMC = [];
  let grficaTitulo = ""; 

  <?php if($soloLectura || $editar): ?>
    leePaciente();

    function leePaciente(){
    validaSesionfirebase("<?php $usuarioLogeado ?>");

      var referencia = db.collection("usuarios").doc("<?php echo $idFirestore ?>");

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
            "<thead class='thead-dark'>" +
            "<tr>" +
            "<th>Fecha</th>" +
            "<th>Estatura</th>" +
            "<th>Peso</th>" +
            "<th>IMC</th>" +
            "<th> </th>" +
            "<th colspan='2' class='text-center'>Acciones</th>" +
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
  <?php endif; ?>

  function editarPeso(idFirestore, idContacto){
    location.href="<?php echo base_url()."index.php/peso/editarRegistro?idPaciente="; ?>" + idFirestore + "&idControlPeso=" + idContacto;
  }

  function borrarPeso(idFirestore, idContacto){
    db.collection("usuarios").doc(idFirestore).collection('pesos').doc(idContacto).delete().then(() => {
      leePaciente();
      enviaAlerta("Borrar","Se eliminó el documento " + idFirestore);
    })
    .catch((error) => {
      alert("Error agregando el documento: " + error);
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
