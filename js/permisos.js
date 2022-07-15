(function() {

  var firebaseConfig = {
    apiKey: "AIzaSyAtVKah-WS0H3TTYOMEohT3jjEpbZ2PkM4",
    authDomain: "medicpill.firebaseapp.com",
    projectId: "medicpill",
    storageBucket: "medicpill.appspot.com",
    messagingSenderId: "444268109580",
    appId: "1:444268109580:web:600d2e18a84f8c39e93329"

  };
    firebase.initializeApp(firebaseConfig);
    var backend = firebase.firestore();
var backendAuth = firebase.auth();

  function leePermisosFirestore(){
    // Le decimos a Firestore de que colección queremos obtener los datos
    db.collection("medicos").doc("<?php $usuarioLogeado ?>").collection(permisos).doc("<?php $moduloActual ?>").get().then(function(datosRecibidos){
console.log(datosRecibidos);
datosRecibidos.forEach((documento) => {console.log(documento.data());}).catch(function(error){
      alert("Error al leer permisos " + error);
    });
  })
}


})();