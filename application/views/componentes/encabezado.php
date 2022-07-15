<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$tituloImprimir = "";
if(!empty($titulo))
	$tituloImprimir = $titulo;

?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $tituloImprimir; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url();?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url();?>css/shop-homepage.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url();?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Favicon -->
  <link rel="icon" href="<?php echo base_url();?>vendor/assets/img/brand/favicon.png" type="image/png">

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>vendor/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>vendor/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?php echo base_url();?>vendor/assets/css/argon.css?v=1.2.0" type="text/css">


<!-- El nucleo de Firebase JS SDK siempre es requerido y se debe llamar antes de cualquier script de Firebase -->
  <script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-firestore.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.10/firebase-auth.js"></script>
  <script type="text/javascript">
    
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAtVKah-WS0H3TTYOMEohT3jjEpbZ2PkM4",
    authDomain: "medicpill.firebaseapp.com",
    projectId: "medicpill",
    storageBucket: "medicpill.appspot.com",
    messagingSenderId: "444268109580",
    appId: "1:444268109580:web:600d2e18a84f8c39e93329"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  // Se crea una instancia de la base de datos de Firestore
  var db = firebase.firestore();
  var au = firebase.auth();

</script>






</head>
