<?php
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';
include '../library/SelectMonth.php';

$loanCode=consultasSQL::CleanStringText($_GET['loanCode']);
$selectInstitution=ejecutarSQL::consultar("SELECT * FROM institucion");
$dataInstitution=mysql_fetch_array($selectInstitution);
$selectLoan=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoPrestamo='".$loanCode."'");
$dataLoan=mysql_fetch_array($selectLoan);
$selectBook=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$dataLoan['CodigoLibro']."'");
$dataBook=mysql_fetch_array($selectBook);
$selectUserKey=ejecutarSQL::consultar("SELECT * FROM prestamoestudiante WHERE CodigoPrestamo='".$loanCode."'");
$dataKey=mysql_fetch_array($selectUserKey);
$selectUser=ejecutarSQL::consultar("SELECT * FROM estudiante WHERE NIE='".$dataKey['NIE']."'");
$dataUser=mysql_fetch_array($selectUser);
$selectRepresentative=ejecutarSQL::consultar("SELECT * FROM encargado WHERE DUI='".$dataUser['DUI']."'");
$dataRepresentative=mysql_fetch_array($selectRepresentative);
$selectSection=ejecutarSQL::consultar("SELECT * FROM seccion WHERE CodigoSeccion='".$dataUser['CodigoSeccion']."'");
$dataSection=mysql_fetch_array($selectSection);
$selectTeacher=ejecutarSQL::consultar("SELECT * FROM docente WHERE CodigoSeccion='".$dataUser['CodigoSeccion']."'");
$dataTeacher=mysql_fetch_array($selectTeacher);
if($dataTeacher['Nombre']==""&&$dataTeacher['Apellido']==""){
    $nameTeacher="Sin asignar";
}else{
    $nameTeacher=$dataTeacher['Nombre'].' '.$dataTeacher['Apellido'];
}
if($dataLoan['FechaSalida']!=""){
    $SelectDayFS=date("d",strtotime($dataLoan['FechaSalida']));
    $SelectMonthFS=date("m",strtotime($dataLoan['FechaSalida']));
    $SelectYearFS=date("Y",strtotime($dataLoan['FechaSalida']));
    $SelectMontNameFS=CalMonth::CurrentMonth($SelectMonthFS);
    $SelectDateFS=$SelectDayFS.' de '.$SelectMontNameFS.' de '.$SelectYearFS;
    $SelectDayFE=date("d",strtotime($dataLoan['FechaEntrega']));
    $SelectMonthFE=date("m",strtotime($dataLoan['FechaEntrega']));
    $SelectYearFE=date("Y",strtotime($dataLoan['FechaEntrega']));
    $SelectMontNameFE=CalMonth::CurrentMonth($SelectMonthFE);
    $SelectDateFE=$SelectDayFE.' de '.$SelectMontNameFE.' de '.$SelectYearFE;
}else{
    $SelectDateFS="";
    $SelectDateFE="";
}   
class PDF extends FPDF{
}
$pdf=new PDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont("Times","",20);
$pdf->SetMargins(25,20,25);
$pdf->Image('../assets/img/logo-biblio.png',25,16,45,25);
//$pdf->Image('../assets/img/ins.png',170,16,18,20);
$pdf->Ln(10);
//$pdf->Cell (0,5,utf8_decode($dataInstitution['Nombre']),0,1,'C');
$pdf->Ln(30);
$pdf->SetFont("Times","b",14);
$pdf->Cell (0,5,utf8_decode('Solicitud de libros para estudiantes'),0,1,'C');
$pdf->Ln(10);
$pdf->SetFont("Times","b",9);
$pdf->Cell (0,5,utf8_decode('Solicitud prestamo / Comprobante de Tramite'),0);
$pdf->Ln(5);
$pdf->SetFont("Times","b",12);
$pdf->Cell (0,5,utf8_decode('---------------------------------------------------------------------------------------------------------------------'),0,1,'C');
$pdf->Ln(5);
$pdf->SetTextColor(0,51,102);
$pdf->SetFont("Times","b",14);
$pdf->Cell (0,5,utf8_decode('Comprobante prestamo de Libro'),0,1);

$pdf->Ln(10);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (17,5,utf8_decode('Datos del estudiante: '),0);

$pdf->Ln(9);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (25,5,utf8_decode('N° DNI: '),0);
$pdf->SetTextColor(0,0,0); //negro
$pdf->SetFont("Times","",12);
$pdf->Cell (50,5,utf8_decode($dataUser['NIE']),0);

$pdf->Ln(9);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (25,5,utf8_decode('Nombre: '),0);
$pdf->SetTextColor(0,0,0); //negro
$pdf->SetFont("Times","",12);
$pdf->Cell (50,5,utf8_decode($dataUser['Nombre'].' '.$dataUser['Apellido']),0);

$pdf->Ln(18);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (17,5,utf8_decode('Datos del Libro: '),0);

$pdf->Ln(9);
$pdf->SetFont("Times","b",12);
$pdf->Cell (25,5,utf8_decode('Nombre: '),0);
$pdf->SetTextColor(0,0,0); //negro
$pdf->SetFont("Times","",12);
$pdf->Cell (50,5,utf8_decode($dataBook['Titulo']),0);
$pdf->Ln(9);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (25,5,utf8_decode('Autor: '),0);
$pdf->SetFont("Times","",12);
$pdf->SetTextColor(0,0,0); //negro
$pdf->Cell (50,5,utf8_decode($dataBook['Autor']),0);
$pdf->SetFont("Times","b",12);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->Cell (25,5,utf8_decode('Código ISBN: '),0);
$pdf->SetFont("Times","",12);
$pdf->SetTextColor(0,0,0); //negro
$pdf->Cell (50,5,utf8_decode($dataLoan['CorrelativoLibro']),0,0,'R');

$pdf->Ln(18);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (17,5,utf8_decode('Datos del prestamo: '),0);
$pdf->Ln(15);
$pdf->SetFont("Times","b",12);
$pdf->Cell (35,5,utf8_decode('Fecha de solicitud: '),0);
$pdf->SetFont("Times","",11);
$pdf->Cell (45,5,utf8_decode($SelectDateFS),0);
$pdf->SetFont("Times","b",12);
$pdf->Cell (33,5,utf8_decode('Fecha de entrega: '),0);
$pdf->SetFont("Times","",11);
$pdf->Cell (45,5,utf8_decode($SelectDateFE),0);
$pdf->Ln(15);
$pdf->SetTextColor(64,64,64); //plomo
$pdf->SetFont("Times","b",12);
$pdf->Cell (35,5,utf8_decode('Observaciones: '),0);

$pdf->SetFont("Times","",12);
$pdf->MultiCell(120, 5,utf8_decode('Debe presentarse a la Biblioteca una vez recibida la solicitud vía web para el trámite correspondiente. Es una solicitud por estudiante sin exepción y solo se prestan libros adquiridos con fondos de la biblioteca'),0);
$pdf->Ln(4);
$pdf->Cell (0,5,utf8_decode('---------------------------------------------------------------------------------------------------------------------'),0,1,'C');

$pdf->Ln(2);
$pdf->SetFont("Times","",9);
$pdf->Cell (0,5,utf8_decode('Bivir Portal estudiantil. Todos los derechos reservados.'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Biblioteca Virtual'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Oficina de Becas y Atención Socioeconómica'),0,1,'C');
 

$pdf->Output('N-'.$loanCode,'I');
mysql_free_result($selectLoan);
mysql_free_result($selectBook);
mysql_free_result($selectInstitution);
mysql_free_result($selectUserKey);
mysql_free_result($selectUser);
mysql_free_result($selectRepresentative);
mysql_free_result($selectSection);
mysql_free_result($selectTeacher);