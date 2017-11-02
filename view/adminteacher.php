<!--
 * Sistema Bibliotecario
 * Copyright 2016 Carlos Eduardo Alfaro Orellana.
 -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Docentes</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
    <script src="../js/SendForm.js"></script>
    <script src="../js/bootstrapvalidator.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#reg_form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    teachingName: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su nombre'
                            }
                        }
                    },
                    teachingSurname: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese sus apellidos'
                            }
                        }
                    },

                    teachingDUI: {
                        validators: {
                            stringLength: {
                                message: 'Ingrese solo numeros'
                            },
                            integer: {                                                                
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su número de DNI'
                            },                            
                        }
                    },

                    teachingPhone: {
                        validators: {
                            stringLength: {
                                message: 'Ingrese solo numeros'
                            },
                            integer: {                                                                
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su número de telefono'
                            },                            
                        }
                    },                    
                    teachingSpecialty: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su especialidad'
                            }
                        }
                    },
                    providerAddres: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su dirección'
                            }
                        }
                    },
                    city: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Please supply your city'
                            }
                        }
                    },
                    sectionSpecialty: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor seleccione una especialidad'
                            }
                        }
                    },
                    sectionSection: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor seleccione una sección'
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


                }
            })


                .on('success.form.bv', function(e) {
                    $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                    $('#reg_form').data('bootstrapValidator').resetForm();

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
              <h1 class="all-tittles">Sistema bibliotecario <small>Administración Usuarios</small></h1>
            </div>
        </div>
        <div class="conteiner-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
                <li role="presentation"><a href="adminuser.php">Administradores</a></li>
                <li role="presentation"  class="active"><a href="adminteacher.php">Docentes</a></li>
                <li role="presentation"><a href="adminstudent.php">Estudiantes</a></li>
                <li role="presentation"><a href="adminpersonal.php">Personal administrativo</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user02.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos docentes. Para registrar un docente debes de llenar todos los campos del siguiente formulario, también puedes ver el listado de docentes registrados
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Nuevo docente</li>
                      <li><a href="adminlistteacher.php">Listado de docentes</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Registrar un nuevo docente</div>
                <form action="../controller/AddTeacher.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off" id="reg_form">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                           <?php
                                $checkSection=ejecutarSQL::consultar("select * from seccion order by Nombre");
                                if(mysql_num_rows($checkSection)<=0){
                                    echo '<br><div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante!:</strong> No puedes registrar docentes, primero debes de agregar secciones al sistema</div><br>';
                                } 
                            ?>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí el número de DNI del docente" name="teachingDUI"  maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente números y guiones, 10 dígitos">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número de DNI</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí los nombres del docente" name="teachingName" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los nombres del docente, solamente letras">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí los apellidos del docente" name="teachingSurname" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe los apellidos del docente, solamente letras">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí el número de teléfono del docente" name="teachingPhone" maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente 10 números">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí la especialidad del docente" name="teachingSpecialty" maxlength="40" data-toggle="tooltip" data-placement="top" title="Especialidad del docente">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Especialidad</label>
                            </div>
                           <legend>Turno y Sección encargada</legend>
                            <div class="form-group group-material">
                                <span>Sección encargada</span>
                                <select class="material-control tooltips-general input-group-addon" name="teachingSection" data-toggle="tooltip" data-placement="top" title="Elige la sección encargada del docente">
                                    <option value="" disabled="" selected="">Selecciona una sección</option>
                                    <?php
                                        while($fila=mysql_fetch_array($checkSection)){
                                            $checkSectionTeacher=ejecutarSQL::consultar("select * from docente where CodigoSeccion='".$fila['CodigoSeccion']."'");
                                            if(mysql_num_rows($checkSectionTeacher)<=0){
                                               echo '<option value="'.$fila['CodigoSeccion'].'">'.$fila['Nombre'].'</option>'; 
                                            } 
                                            mysql_free_result($checkSectionTeacher);
                                        }
                                        mysql_free_result($checkSection);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group group-material">
                                <span>Turno</span>
                                <select class="material-control tooltips-general input-group-addon" name="teachingTime" data-toggle="tooltip" data-placement="top" title="Elige el turno que labora el docente">
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                </select>
                            </div>
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                            </p> 
                        </div>
                    </div>
                </form>
            </div>
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
                    <?php include '../help/help-adminteacher.php'; ?>
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