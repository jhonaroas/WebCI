<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$UserType=consultasSQL::CleanStringText($_POST['UserType']);
$loginName=consultasSQL::CleanStringText($_POST['loginName']);
$loginPassword=consultasSQL::CleanStringText($_POST['loginPassword']);
$fecha=date("d-m-Y");
$hora=date("H:i:s");

if($UserType=="Student"){
   echo '<script type="text/javascript">
        swal({ 
            title:"Funciona", 
            text:"ESTUDIANTE", 
            type: "error", 
            confirmButtonText: "Aceptar" 
        });
    </script>';
}
if($UserType==""){
    echo '<script type="text/javascript">
        swal({ 
            title:"Selecciona el tipo de usuario ABC", 
            text:"Debes de seleccionar el tipo de usuario para iniciar sesión en el sistema", 
            type: "error", 
            confirmButtonText: "Aceptar" 
        });
    </script>';
}