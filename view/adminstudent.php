<!--
 * Sistema Bibliotecario
 -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estudiantes</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
    <script src="../js/SendForm.js"></script>
    <script>
        $().ready(function(){
            $(".check-representative").keyup(function(){
              $.ajax({
                url:"../controller/check-representative.php?DUI="+$(this).val(),
                success:function(data){
                  $(".representative-resul").html(data);
                }
              });
            });
        });
    </script>
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
                    studentName: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese su nombre'
                            }
                        }
                    },
                    studentSurname: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Por favor ingrese sus apellidos'
                            }
                        }
                    },

                    studentNIE: {
                        validators: {
                            stringLength: {
                                message: 'Ingrese solo numeros'
                            },
                            integer: {                                                                
                            },
                            notEmpty: {
                                message: 'Por favor ingrese DNI del estudiante'
                            },                            
                        }
                    },
                    representativeDUI: {
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
                    representativeRelationship: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'No olvide llenar este campo'
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
                    studentSection: {
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
              <li role="presentation"><a href="adminteacher.php">Docentes</a></li>
              <li role="presentation"  class="active"><a href="adminstudent.php">Estudiantes</a></li>
              <li role="presentation"><a href="adminpersonal.php">Personal administrativo</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user03.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos estudiantes, para poder registrar un estudiante deberás de llenar todos los campos del siguiente formulario
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Nuevo estudiante</li>
                      <li><a href="adminliststudent.php">Listado de estudiantes</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Registrar un nuevo estudiante</div>
                <form action="../controller/AddStudent.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off" id="reg_form">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                           <?php
                                $checkTeacherSection=ejecutarSQL::consultar("select * from docente");
                                if(mysql_num_rows($checkTeacherSection)<=0){
                                    echo '<br><div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante!:</strong> No puedes registrar estudiantes, primero debes de agregar docentes al sistema</div>';
                                }
                            ?>
                           <legend>Datos del estudiante</legend>
                           <br><br>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí el DNI del alumno" name="studentNIE"  maxlength="10" data-toggle="tooltip" data-placement="top" title="DNI de estudiante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>DNI</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí los nombres del alumno" name="studentName"  maxlength="50" data-toggle="tooltip" data-placement="top" title="Nombres del estudiante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Escribe aquí los apellidos del alumno" name="studentSurname"  maxlength="50" data-toggle="tooltip" data-placement="top" title="Apellidos del estudiante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                           <div class="form-group group-material">
                                <span>Sección</span>
                                <select class="material-control tooltips-general input-group-addon" name="studentSection" data-toggle="tooltip" data-placement="top" title="Elige la sección a la que pertenece el alumno">
                                    <option value="" disabled="" selected="">Selecciona una sección</option>
                                    <?php
                                        
                                        if(mysql_num_rows($checkTeacherSection)>0){
                                            while($fila=mysql_fetch_array($checkTeacherSection)){
                                                $checkStudentSection=ejecutarSQL::consultar("select * from seccion where CodigoSeccion='".$fila['CodigoSeccion']."' order by Nombre");
                                                $row=mysql_fetch_array($checkStudentSection);
                                                echo '<option value="'.$row['CodigoSeccion'].'">'.$row['Nombre'].'</option>';
                                                mysql_free_result($checkStudentSection);
                                            }
                                        }
                                        mysql_free_result($checkTeacherSection);
                                    ?>
                                </select>
                            </div>
                            <legend>Datos del encargado</legend>
                            <br><br>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon" placeholder="Parentesco" name="representativeRelationship"  maxlength="30" data-toggle="tooltip" data-placement="top" title="Parentesco">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Parentesco</label>
                            </div>
                            <div class="form-group group-material">
                                <input type="text" class="material-control tooltips-general input-group-addon check-representative" placeholder="Escribe aquí el número de DNI del encargado" name="representativeDUI" maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente números y guiones, 10 dígitos">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número de DNI del encargado</label>
                            </div>
                            <div class="full-reset representative-resul"></div>
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
                    <?php include '../help/help-adminstudent.php'; ?>
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