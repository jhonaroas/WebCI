<!--
 * Sistema Bibliotecario
 -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administradores</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
<<<<<<< HEAD
    <script src="../js/SendForm.js"></script>    
=======
    <script src="../js/SendForm.js"></script>
    <script src="../js/bootstrapvalidator.min.js"></script>
>>>>>>> f85ccd5fd7d2e111b1cbf2c2becaf9f08bd655d4
    <script>
        $(document).ready(function(){
            $(".input-check-user").keyup(function(){
              $.ajax({
                url:"../controller/check-user.php?user="+$(this).val(),
                success:function(data){
                  $(".check-user-bd").html(data);
                }
              });
            });
        });
    </script>
<<<<<<< HEAD
    <script src="../js/bootstrapvalidator.min.js"></script>
=======
>>>>>>> f85ccd5fd7d2e111b1cbf2c2becaf9f08bd655d4
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
                    adminName: {
                        validators: {
                            stringLength: {
<<<<<<< HEAD
                                min: 4,
=======
                                min: 2,
>>>>>>> f85ccd5fd7d2e111b1cbf2c2becaf9f08bd655d4
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su nombre'
                            }
                        }
                    },
                    adminUserName: {
                        validators: {
                            stringLength: {
<<<<<<< HEAD
                                min: 4,
=======
                                min: 2,
>>>>>>> f85ccd5fd7d2e111b1cbf2c2becaf9f08bd655d4
                            },
                            notEmpty: {
                                message: 'Por favor ingrese nombre de usuario'
                            }
                        }
                    },

                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your phone number'
                            },
                            phone: {
                                country: 'US',
                                message: 'Please supply a vaild phone number with area code'
                            }
                        }
                    },
                    address: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Please supply your street address'
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
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'Please select your state'
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
                    adminMail: {
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
<<<<<<< HEAD
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su contraseña'
=======
>>>>>>> f85ccd5fd7d2e111b1cbf2c2becaf9f08bd655d4
                            }
                        }
                    },
                    adminPassword2: {
                        validators: {
                            identical: {
                                field: 'adminPassword1',
                                message: 'Las contraseña no coinciden'
<<<<<<< HEAD
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su contraseña'
=======
>>>>>>> f85ccd5fd7d2e111b1cbf2c2becaf9f08bd655d4
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
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
                <li role="presentation"  class="active"><a href="adminuser.php">Administradores</a></li>
                <li role="presentation"><a href="adminteacher.php">Docentes</a></li>
                <li role="presentation"><a href="adminstudent.php">Estudiantes</a></li>
                <li role="presentation"><a href="adminpersonal.php">Personal administrativo</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user01.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos administradores del sistema, debes de llenar todos los campos del siguiente formulario para registrar un administrador
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Nuevo administrador</li>
                      <li><a href="adminlistuser.php">Listado de administradores</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Registrar un nuevo administrador</div>

                <form action="../controller/AddAdmin.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off" id="reg_form">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Nombre completo" name="adminName"  data-toggle="tooltip" data-placement="top" title="Escribe el nombre del administrador">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre completo</label>
                            </div>
                           <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-check-user input-group-addon check-user-bd" placeholder="Nombre de usuario" name="adminUserName" data-toggle="tooltip" data-placement="top" title="Escribe un nombre de usuario sin espacios, que servira para iniciar sesión">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre de usuario</label>
                                <div class="check-user-bd"></div>
                           </div>
                            <div class="form-group group-material">
                                <input type="email" class="material-control tooltips-general input-group-addon" placeholder="E-mail" name="adminMail"  maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el Email del administrador">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="password" class="material-control tooltips-general input-group-addon" placeholder="Contraseña" name="adminPassword1" maxlength="200" data-toggle="tooltip" data-placement="top" title="Escribe una contraseña">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contraseña</label>
                            </div>
                           <div class="form-group group-material">
                                <input type="password" class="material-control tooltips-general input-group-addon" placeholder="Repite la contraseña" name="adminPassword2" maxlength="200" data-toggle="tooltip" data-placement="top" title="Repite la contraseña">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Repetir contraseña</label>
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
                    <?php include '../help/help-adminuser.php'; ?>
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