<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!isset($mensajeError))
  $mensajeError = "Error general";

?>
<!-- Page Content -->
  <div class="container">
    <br>
    <div class="jumbotron">
        <h1><?php echo $mensajeError; ?></h1>
    </div>
  </div>
  <!-- /.container -->