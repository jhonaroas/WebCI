<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrar Libro</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>   
    <script src="../js/SendForm.js"></script>
    <script src="../js/bootstrapvalidator.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#saveData').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    bookName: {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/i,
                                message: 'Este campo solo puede contener caracteres alfabéticos y espacios'
                            },
                            stringLength: {
                                min: 4,
                                max: 20,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese nombre del libro'
                            }
                        }
                    },
                    bookAutor: {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/i,
                                message: 'Este campo solo puede contener caracteres alfabéticos y espacios'
                            },
                            stringLength: {
                                min: 4,
                            },                            
                            notEmpty: {
                                message: 'Por favor ingrese nombre del autor'
                            }
                        }
                    },

                    bookCorrelative: {
                        validators: {
                            regexp: {
                                regexp: /^[0-9]+$/i,
                                message: 'Este campo solo puede contener numeros'
                            },
                            stringLength: {
                                min: 1                               
                            },                            
                            notEmpty: {
                                message: 'Por favor ingrese el codigo ISBN'
                            },                            
                        }
                    },
                    
                    bookYear: {
                        validators: {
                            regexp: {
                                regexp: /^[0-9]+$/i,
                                message: 'Este campo solo puede contener numeros'
                            },
                            stringLength: {
                                message: 'Ingrese solo numeros'
                            },
                            integer: {                                                                
                            },
                            notEmpty: {
                                message: 'Por favor ingrese número de telefono'
                            },                            
                        }
                    },                    
                   
                    personalPosition: {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/i,
                                message: 'Este campo solo puede contener caracteres alfabéticos y espacios'
                            },
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese un cargo'
                            }
                        }
                    },
                    bookCountry: {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/i,
                                message: 'Este campo solo puede contener caracteres alfabéticos sin espacios'
                            },
                            stringLength: {
                                min: 4,
                                max: 15,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese el pais de origen del libro'
                            }
                        }
                    },
                    bookProvider: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor seleccione al proveedor'
                            }
                        }
                    },
                    bookCategory: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor seleccione una categoría'
                            }
                        }
                    },
                    sectionGrade: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor seleccione una año'
                            }
                        }
                    },
                    zip: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your zip code'
                            },
                            zipCode: {
                                country: 'US',
                                message: 'Please supply a vaild zip code'
                            }
                        }
                    },
                    comment: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 200,
                                message:'Please enter at least 10 characters and no more than 200'
                            },
                            notEmpty: {
                                message: 'Please supply a description about yourself'
                            }
                        }
                    },
                    providerEmail: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor ingrese su dirección de correo electrónico'
                            },
                            emailAddress: {
                                message: 'Proporcione una dirección de correo electrónico válida'
                            }
                        }
                    },

                    adminPassword1: {
                        validators: {
                            identical: {
                                field: 'adminPassword2',
                                message: 'Digite su contraseña y repitala en el campo de abajo, por favor'
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su contraseña'
                            }
                        }
                    },
                    adminPassword2: {
                        validators: {
                            identical: {
                                field: 'adminPassword1',
                                message: 'Las contraseña no coinciden'
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su contraseña'
                            }
                        }
                    },
                    bookEditorial: {
                        validators: {
                            regexp: {
                                regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/i,
                                message: 'Este campo solo puede contener caracteres alfabéticos sin espacios'
                            },
                            stringLength: {
                                min: 4,
                                max: 15,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese la editorial'
                            }
                        }
                    },
                    bookEdition: {
                        validators: {
                            regexp: {
                                regexp: /^[0-9]+$/i,
                                message: 'Este campo solo puede contener numeros'
                            },
                            stringLength: {
                                message: 'Ingrese un año'
                            },
                            integer: {                                                                
                            },
                            notEmpty: {
                                message: 'Por favor ingrese el año de edición'
                            },                            
                        }
                    },    

                }
            })


                .on('success.form.bv', function(e) {
                    $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                    $('#saveData').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    e.preventDefault();

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.post($form.attr('action'), $form.serialize(), function(result) {
                        console.log(result);
                    }, 'json');
                });
        });

    </script>
</head>
<body>
    <?php 
        include '../library/configServer.php';
        include '../library/consulSQL.php';
        include '../controller/SecurityAdmin.php';
        include '../inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php 
            include '../inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema bibliotecario <small>Añadir libro</small></h1>
            </div>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/flat-book.png" alt="pdf" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para agregar nuevos libros a la biblioteca, deberas de llenar todos los campos para poder registrar el libro
                </div>
            </div>
        </div>
        <div class="container-fluid">            
            <form id="saveData" action="../controller/AddBook.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Nuevo libro</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong>Información básica</strong></legend><br>
                            <div class="form-group group-material">
                                <span>Categoría</span>
                                <select class="tooltips-general input-group-addon material-control" name="bookCategory" data-toggle="tooltip" data-placement="top" title="Elige la categoría del libro">
                                    <option value="" disabled="" selected="">Selecciona una categoría</option>
                                    <?php
                                        $checkCategory= ejecutarSQL::consultar("SELECT * FROM categoria");
                                        while($fila=mysql_fetch_array($checkCategory)){
                                            echo '<option value="'.$fila['CodigoCategoria'].'">'.$fila['Nombre'].'</option>'; 
                                        }
                                        mysql_free_result($checkCategory);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="tooltips-general input-group-addon material-control" placeholder="Escribe aquí el código ISBN del libro" name="bookCorrelative" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código ISBN</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="tooltips-general input-group-addon material-control" placeholder="Escribe aquí el título o nombre del libro" name="bookName" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el título o nombre del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Título</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="tooltips-general input-group-addon material-control" placeholder="Escribe aquí el autor del libro" name="bookAutor" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del autor del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Autor</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="tooltips-general input-group-addon material-control" placeholder="Escribe aquí el país del libro" name="bookCountry" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el país del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>País</label>
                            </div>
                            <legend><strong>Otros datos</strong></legend><br>
                            <div class="form-group group-material">
                                <span>Proveedor</span>
                                <select class="tooltips-general input-group-addon material-control" name="bookProvider" data-toggle="tooltip" data-placement="top" title="Elige el proveedor del libro">
                                    <option value="" disabled="" selected="">Selecciona un proveedor</option>
                                    <?php
                                        $checkProvider= ejecutarSQL::consultar("select * from proveedor");
                                        while($fila=mysql_fetch_array($checkProvider)){
                                            echo '<option value="'.$fila['CodigoProveedor'].'">'.$fila['Nombre'].'</option>'; 
                                        }
                                        mysql_free_result($checkProvider);
                                    ?>
                                </select>
                            </div>
                           <div class="form-group group-material">
                               <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí el año del libro" name="bookYear" maxlength="4" data-toggle="tooltip" data-placement="top" title="Solamente números, sin espacios">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Año</label>
                           </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí la editorial del libro" name="bookEditorial" maxlength="70" data-toggle="tooltip" data-placement="top" title="Editorial del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Editorial</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí la edición del libro" name="bookEdition" maxlength="4" data-toggle="tooltip" data-placement="top" title="Edición del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Edición</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon"  placeholder="Escribe aquí la cantidad de libros que registraras" name="bookCopies" pattern="[0-9]{1,7}" maxlength="7" data-toggle="tooltip" data-placement="top" title="¿Cuántos libros registraras?">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Ejemplares</label>
                            </div>
                            <legend><strong>Estado físico, ubicación y valor</strong></legend><br>
                            <div class="form-group group-material">
                               <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí la ubicación del libro" name="bookLocation" maxlength="50" data-toggle="tooltip" data-placement="top" title="¿Dónde se ubicara el libro?">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Ubicación</label>
                            </div>
                            <div class="form-group group-material">
                                <span>Cargo</span>
                                <select class="tooltips-general input-group-addon material-control" name="bookOffice" data-toggle="tooltip" data-placement="top" title="Elige el cargo del libro">
                                    <option value="" disabled="" selected="">Selecciona el cargo del libro</option>
                                    <option value="1-1">Entrega del ministerio</option>
                                    <option value="1-2">Donaciones</option>
                                    <option value="1-3">Compras con fondos propios</option>
                                    <option value="1-4">Presupuesto escolar</option>
                                    <option value="1-5">Otros</option>
                                </select>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí el precio estimado del libro" name="bookEstimated" pattern="[0-9.]{1,7}" maxlength="7" data-toggle="tooltip" data-placement="top" title="Sólo números y un punto si el valor posee decimales. Ejemplo: 7.79">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Estimado</label>
                            </div>
                            <div class="form-group group-material">
                                <span>Estado</span>
                                <select class="tooltips-general input-group-addon material-control" name="bookState" data-toggle="tooltip" data-placement="top" title="Elige el estado del libro">
                                    <option value="" disabled="" selected="">Selecciona el estado del libro</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Deteriorado">Deteriorado</option>
                                </select>
                            </div>
                         <!-- Input File Imagen -->                               
                            <legend><strong>Imágen y archivo PDF</strong></legend><br>
                            <div class="group-material">
                                <span class="lead"><i class="zmdi zmdi-image"></i> Imágen</span>
                                <input type="file" name="fileToUpload[]" id="fileToUpload">                                           
                                <small>Archivos permitidos: jpg, png</small>
                            </div>
                        <!-- Input File PDF -->    
                            <div class="group-material">
                                <span class="lead"><i class="zmdi zmdi-file"></i> PDF</span>
                                <input type="file" name="fileToUpload[]" id="fileToUpload">
                                <small>Archivos permitidos: PDF<br>Tamaño máximo: 100MB</small>
                            </div>
                       <!--   
                            <div class="form-group">
                                <span class="lead">¿El archivo PDF será visible para los usuarios?</span><br>
                                <label for="download1">
                                    <input type="radio" name="bookDownload" id="download1" value="yes"> Si
                                </label>
                                <br>
                                <label for="download2">
                                    <input type="radio" name="bookDownload" id="download2" value="no"> No
                                </label>
                            </div>
                        -->

                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                            </p>
                       </div>
                   </div>
                </div>
            </form>
        </div>
        <div class="msjFormSend"></div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include '../help/help-admininventory.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include '../inc/footer.php'; ?>
    </div>
</body>
</html>