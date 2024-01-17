<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gestion de Clientes <sup>1</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Funciones
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Funciones de usuario:</h6>
                        <a class="collapse-item" href="registro_ventas.php">Registrar Venta</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tablas</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Listar Tablas:</h6>
                        <a class="collapse-item" href="tablas_usuario.php">Historial de Ventas</a>
                </div>
            </li>

         

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Registar una Venta</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="container">

                        <div class="d-flex justify-content-center align-items-center ">
                        <?php
                        // editar_ventas.php
                        
                        if (isset($_GET['id'])) {
                            // Obtener el id enviado por la solicitud AJAX
                            $idVenta = $_GET['id'];

                            include 'php\procesos.php';

                            // Obtener los datos de la venta con la función
                            $datosVenta = obtenerDatosVenta($idVenta);

                            // Llenar el formulario con los datos obtenidos
                            ?>
                            <form action="php/procesos.php" method="post" class="p-4 border">
                                <h1 class="text-center mb-4">Formulario de Edición</h1>
                        
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID:</label>
                                    <input type="text" name="id" class="form-control" value="<?php echo $datosVenta['id']; ?>" required readonly>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha:</label>
                                    <input type="date" name="fecha" class="form-control" value="<?php echo $datosVenta['fecha']; ?>" required>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" value="<?php echo $datosVenta['nombre']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label">Apellido:</label>
                                    <input type="text" name="apellido" class="form-control" value="<?php echo $datosVenta['apellido']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="producto" class="form-label">Producto:</label>
                                    <input type="text" name="producto" class="form-control" value="<?php echo $datosVenta['producto']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" class="form-control" value="<?php echo $datosVenta['cantidad']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="monto" class="form-label">Monto:</label>
                                    <input type="text" name="monto" class="form-control" pattern="^\d+(\.\d{1,2})?$" title="Ingrese un monto válido (hasta dos decimales)" value="<?php echo $datosVenta['monto']; ?>" required>
                                </div>
                        
                                <button type="submit" class="btn btn-primary" name="editar">Guardar Cambios</button>
                            </form>
                            <?php
                        }
                            ?>
                        
                    </div>

                   <!-- Modales -->
                            <div class="modal" tabindex="-1" role="dialog" id="successModal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modificación Exitosa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>La venta se ha modificado exitosamente.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="modal" tabindex="-1" role="dialog" id="errorModal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Error al Modificar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>La venta no se ha podido modificar. <!-- Puedes mostrar detalles del error aquí si lo deseas. --></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modales -->
                            <?php
                            if (isset($_GET['success']) && $_GET['success'] == '1') {
                                echo '<script>
                                        $(document).ready(function(){
                                            $("#successModal").modal("show");
                                        });
                                    </script>';
                            } elseif (isset($_GET['error'])) {
                                echo '<script>
                                        $(document).ready(function(){
                                            $("#errorModal").modal("show");
                                        });
                                    </script>';
                            }
                            ?>


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Nombre de Empresa 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script> 

        function editarVenta(idVenta) {
                // Llamada AJAX para editar la venta
                $.ajax({
                    url: 'php/procesos.php',
                    type: 'POST',
                    data: { action: 'editarVenta', id: idVenta },
                    success: function(response) {
                        // Manejar la respuesta si es necesario
                        console.log(response);
                    },
                    error: function(error) {
                        // Manejar errores si es necesario
                        console.error(error);
                    }
                });
            }
    
    </script>

</body>

</html>