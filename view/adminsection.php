<!--
 * Sistema Bibliotecario
 * Copyright 2016 Carlos Eduardo Alfaro Orellana.
 -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Secciones</title>
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
                    providerName: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su nombre'
                            }
                        }
                    },
                    providerResponsible: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese nombre de responsable'
                            }
                        }
                    },

                    providerPhone: {
                        validators: {
                            stringLength: {
                                message: 'Ingrese solo numeros'
                            },
                            integer: {                                                                
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su número de teléfono'
                            },                            
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
              <h1 class="all-tittles">Sistema bibliotecario <small>Administración Institución</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation"><a href="admininstitution.php">Institución</a></li>
              <li role="presentation"><a href="adminprovider.php">Proveedores</a></li>
              <li role="presentation"><a href="admincategory.php">Categorías</a></li>
              <li role="presentation"  class="active"><a href="adminsection.php">Secciones</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/section.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevas secciones al sistema, debes de seleccionar los datos en el siguiente formulario para registrar una sección
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Nueva sección</li>
                      <li><a href="adminlistsection.php">Listado de secciones</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Agregar una nueva sección</div>
                <form action="../controller/AddSection.php" method="post" class="form_SRCB" data-type-form="save" id="reg_form">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="form-group group-material">
                                <span>Año</span>
                                <select class="material-control tooltips-general input-group-addon" name="sectionGrade" data-toggle="tooltip" data-placement="top" title="Elige el año">

                                  <option value="" disabled="" selected="">Selecciona una opción</option>
                                  <?php $year = date("Y");
                                        for ($i=$year-5; $i<=$year; $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group group-material">
                                <span>Especialidad</span>
                                <select class="material-control tooltips-general input-group-addon" name="sectionSpecialty" data-toggle="tooltip" data-placement="top" title="Elige la especialidad">
                                    <option value="" disabled="" selected="">Selecciona una opción</option>
                                    <option value="Asistente.Ad. ">Asistente Ad.</option>
                                    <option value="Contador ">Contador</option>
                                    <option value="Electrotécnia ">Electrotécnia</option>
                                    <option value="General ">General</option>
                                    <option value="Informática ">Informática</option>
                                    <option value="Salud ">Salud</option>
                                    <option value="M. Automotriz ">M. Automotriz</option>
                                </select>
                            </div>
                            <div class="form-group group-material">
                                <span>Sección</span>
                                <select class="material-control tooltips-general input-group-addon" name="sectionSection" data-toggle="tooltip" data-placement="top" title="Elige la sección">
                                    <option value="" disabled="" selected="">Selecciona una opción</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
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
                    <?php include '../help/help-adminsection.php'; ?>
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