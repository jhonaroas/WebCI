<?php 

class ejecutarSQL{
  private $conexion; private $total_consultas;
  public function conectar(){ 
    if(!isset($this->conexion)){
      $this->conexion = (mysql_connect("localhost","root",""))
        or die(mysql_error());
      mysql_select_db("librarysystem",$this->conexion) or die(mysql_error());
    }
  }
  public function consulta($consulta){ 
    $this->total_consultas++; 
    $resultado = mysql_query($consulta,$this->conexion);
    if(!$resultado){ 
      echo 'MySQL Error: ' . mysql_error();
      exit;
    }
    return $resultado;
  }
 
}

/* 
duffamebe-3345@yopmail.com
jhona2189

Your account number is: 243965
Server: sql10.freemysqlhosting.net
Name: sql10199987
Username: sql10199987
Password: vQU4jr8h5y
Port number: 3306
*/


?>


