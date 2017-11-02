<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';      

$bookCorrelative=consultasSQL::CleanStringText($_POST['bookCorrelative']);
$bookCategory=consultasSQL::CleanStringText($_POST['bookCategory']);
$bookName=consultasSQL::CleanStringText($_POST['bookName']);
$bookAutor=consultasSQL::CleanStringText($_POST['bookAutor']);
$bookCountry=consultasSQL::CleanStringText($_POST['bookCountry']);
$bookProvider=consultasSQL::CleanStringText($_POST['bookProvider']);
$bookYear=consultasSQL::CleanStringText($_POST['bookYear']);
$bookEditorial=consultasSQL::CleanStringText($_POST['bookEditorial']);
$bookEdition=consultasSQL::CleanStringText($_POST['bookEdition']);
$bookCopies=consultasSQL::CleanStringText($_POST['bookCopies']);
$bookBorrowed=0;
$bookLocation=consultasSQL::CleanStringText($_POST['bookLocation']);
$bookOffice=consultasSQL::CleanStringText($_POST['bookOffice']);
$bookEstimated=consultasSQL::CleanStringText($_POST['bookEstimated']);
$bookState=consultasSQL::CleanStringText($_POST['bookState']);

if($bookCorrelative=="" || $bookCategory=="" || $bookName==""|| $bookAutor==""|| $bookCountry==""||
    $bookProvider==""|| $bookYear==""|| $bookEditorial==""|| $bookEdition==""|| $bookCopies==""){
    echo '<script type="text/javascript">
        swal({ 
            title:"Error en el registro", 
            text:"Verifique que que los campos del formulario no esten vacios.", 
            type: "error", 
            confirmButtonText: "Aceptar" 
        });
    </script>';
}else{
    $checkAllBookReg=ejecutarSQL::consultar("SELECT * FROM libro");
    $checktotalBookReg=mysql_num_rows($checkAllBookReg);
    $numB=$checktotalBookReg+1;
    $bookCheckInstitution=ejecutarSQL::consultar("SELECT * FROM institucion");
    $dataInst=mysql_fetch_array($bookCheckInstitution);
    $bookInstitution=$dataInst['CodigoInfraestructura'];
    $codigo="";
    $longitud=4;
    for ($i=1; $i<=$longitud; $i++){
        $numero = rand(0,9);
        $codigo .= $numero;
    }
    $bookCode="I".$dataInst['CodigoInfraestructura']."Y".$dataInst['Year']."C".$bookCategory."B".$numB."N".$codigo."";
    if(mysql_num_rows($bookCheckInstitution)>0){
        if(!$bookCategory=="" && !$bookProvider=="" && !$bookOffice=="" && !$bookState==""){

            $checkBookName=ejecutarSQL::consultar("SELECT * FROM libro WHERE Titulo='".$bookName."' AND Autor='".$bookAutor."'");
            if(mysql_num_rows($checkBookName)<=0){
                if(consultasSQL::InsertSQL("libro", "CodigoLibro, CodigoCorrelativo, CodigoCategoria, CodigoProveedor, CodigoInfraestructura, Autor, Pais, Year, Estimado, Titulo, Edicion, Ubicacion, Cargo, Editorial, Existencias, Prestado,Estado", "'$bookCode','$bookCorrelative','$bookCategory','$bookProvider','$bookInstitution','$bookAutor','$bookCountry','$bookYear','$bookEstimated','$bookName','$bookEdition','$bookLocation','$bookOffice','$bookEditorial','$bookCopies','$bookBorrowed','$bookState'")){
                  /*Guardar Imagen
                  bookCorrelative
                  bookPicture */                 
                  # definimos la carpeta destino

                  $carpetaDestino="imagenes_/";
                  $carpetaDestino2="pdf_/";
                  $var=$bookCorrelative;

                    # si hay algun archivo que subir
                    if($_FILES["fileToUpload"]["name"][0])
                    {
                 
                        # recorremos todos los arhivos que se han subido
                        for($i=0;$i<count($_FILES["fileToUpload"]["name"]);$i++)
                        {
                 
                            # si es un formato de imagen
                            if($_FILES["fileToUpload"]["type"][$i]=="image/jpeg" || $_FILES["fileToUpload"]["type"][$i]=="image/pjpeg" || $_FILES["fileToUpload"]["type"][$i]=="image/gif" || $_FILES["fileToUpload"]["type"][$i]=="image/png")
                            {
                 
                                # si exsite la carpeta o se ha creado
                                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                                {
                                    $origen=$_FILES["fileToUpload"]["tmp_name"][$i];
                                    $destino=$carpetaDestino.$_FILES["fileToUpload"]["name"][$i];
                 
                                    # movemos el archivo
                                    if(@move_uploaded_file($origen, $carpetaDestino.$var."_".$i.".jpg"))
                                    {
                                        echo "<br>".$_FILES["fileToUpload"]["name"][$i]." movido correctamente";
                                    }else{
                                        echo "<br>No se ha podido mover el archivo: ".$_FILES["fileToUpload"]["name"][$i];
                                    }
                                }else{
                                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                                }
                            }else{
                                echo "<br>".$_FILES["fileToUpload"]["name"][$i]." - NO es imagen jpg";
                            }
                            # si es un archivo pdf
                            if($_FILES["fileToUpload"]["type"][$i]=="application/pdf")
                            {
                              # si exsite la carpeta o se ha creado
                                if(file_exists($carpetaDestino2) || @mkdir($carpetaDestino2))
                                {
                                    $origen=$_FILES["fileToUpload"]["tmp_name"][$i];
                                    $destino=$carpetaDestino.$_FILES["fileToUpload"]["name"][$i];
                 
                                    # movemos el archivo
                                    if(@move_uploaded_file($origen, $carpetaDestino2.$var.".pdf"))
                                    {
                                        echo "<br>".$_FILES["fileToUpload"]["name"][$i]." movido correctamente";
                                    }else{
                                        echo "<br>No se ha podido mover el archivo: ".$_FILES["fileToUpload"]["name"][$i];
                                    }
                                }else{
                                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                                }
                            }
                        }
                    }else{
                        echo "<br>No se ha subido ninguna imagen";
                    }
                  /*----------------------------------------*/
                    echo '<script type="text/javascript">
                    swal({
                       title:"¡Libro registrado!",
                       text:"Los datos del libro se registraron correctamente",
                       type: "success",
                       confirmButtonText: "Aceptar"
                    });
                    $(".saveData")[0].reset();
                </script>';
                }else{
                    echo '<script type="text/javascript">
                    swal({
                       title:"¡Ocurrió un error inesperado!",
                       text:"No se pudo registrar el libro, por favor intenta nuevamente",
                       type: "error",
                       confirmButtonText: "Aceptar"
                    });
                </script>';
                }
            }else{
                echo '<script type="text/javascript">
                swal({
                   title:"¡Ocurrió un error inesperado!",
                   text:"El nombre y autor del libro que acabas de escribir ya está almacenado en el sistema",
                   type: "error",
                   confirmButtonText: "Aceptar"
                });
            </script>';
            }
        }else{
            echo '<script type="text/javascript">
            swal({
               title:"¡Ocurrió un error inesperado!",
               text:"Verifica que hayas seleccionado una categoría, proveedor, cargo y estado del libro válidos. Si aún tienes problemas verifica que tengas categorías y proveedores registrados en el sistema",
               type: "error",
               confirmButtonText: "Aceptar"
            });
        </script>';
        }
    }else{
        echo '<script type="text/javascript">
        swal({
           title:"¡Ocurrió un error inesperado!",
           text:"No has registrado los datos de la institución, por favor registralos para poder guardar libros",
           type: "error",
           confirmButtonText: "Aceptar"
        });
    </script>';
    }
}

mysql_free_result($checkBookName);
mysql_free_result($bookCheckInstitution);
mysql_free_result($checkAllBookReg);

// header('Location:' . getenv('HTTP_REFERER'));