<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$userType=consultasSQL::CleanStringText($_GET['user']);
if($userType=="Teacher"){ $tableUser="prestamodocente"; }
if($userType=="Student"){ $tableUser="prestamoestudiante"; }
if($userType=="Visitor"){ $tableUser="prestamovisitante"; }
if($userType=="Personal"){ $tableUser="prestamopersonal"; }
$selectALoans=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE Estado='Prestamo'");
if(mysql_num_rows($selectALoans)>=1){
    $countL=0;
    while($datALS=mysql_fetch_array($selectALoans)){
        $selectLus=ejecutarSQL::consultar("SELECT * FROM ".$tableUser." WHERE CodigoPrestamo='".$datALS['CodigoPrestamo']."'");
        if(mysql_num_rows($selectLus)>0){ $countL=$countL+1; }
        mysql_free_result($selectLus);
    }
    if($countL>=1){ echo 'Avaliable'; }else{ echo 'NotAvaliable'; }
}else{
    echo 'NotAvaliable';
}
mysql_free_result($selectALoans);