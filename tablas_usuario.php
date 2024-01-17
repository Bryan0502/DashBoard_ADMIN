<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tablas de Clientes</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.js"></script>


     <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gestion de Clientes <sup>1</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
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
                    <h1 class="h3 mb-2 text-gray-800">Lista de Ventas con Filtros</h1>

                    <button id="generatePdfButton" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate PDF
                    </button>

                    <button id="exportarExcelBtn" class="btn btn-sm btn-success shadow-sm">Exportar a Excel</button>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ventas Registradas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Monto</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Monto</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>


                            
                            <form method="get" style="display: inline-block;">
                                <input type="hidden" name="accion" value="cargarventastodo">
                                <button type="submit" class="btn btn-sm btn-primary shadow-sm">Cargar Ventas (TODAS)</button>
                            </form>
                            
                            <form method="get" style="display: inline-block;">
                                <input type="hidden" name="accion" value="cargarventasmes">
                                <button type="submit" class="btn btn-sm btn-primary shadow-sm">Cargar Ventas (MES ACTUAL)</button>
                            </form>

                            
                            

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                    
                        <!-- Modales Eliminar -->
                        <div class="modal" tabindex="-1" role="dialog" id="successModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Borrado Exitoso</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>La venta se ha borrado exitosamente.</p>
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
                                        <h5 class="modal-title">Error al Eliminar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Error al borrar la Venta. <!-- Puedes mostrar detalles del error aquí si lo deseas. --></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modales Eliminar -->
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

                        <!-- Modales Editar -->
                        <div class="modal" tabindex="-1" role="dialog" id="successModaleditar">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edición Exitosa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>La venta se ha editado exitosamente.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="modal" tabindex="-1" role="dialog" id="errorModaleditar">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Error al Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Error al editar la Venta. <!-- Puedes mostrar detalles del error aquí si lo deseas. --></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modales Editar -->
                        <?php
                        if (isset($_GET['success2']) && $_GET['success2'] == '1') {
                            echo '<script>
                                    $(document).ready(function(){
                                        $("#successModaleditar").modal("show");
                                    });
                                </script>';
                        } elseif (isset($_GET['error2'])) {
                            echo '<script>
                                    $(document).ready(function(){
                                        $("#errorModaleditar").modal("show");
                                    });
                                </script>';
                        }
                        ?>



            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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




    
 <script>
    // Función para exportar a Excel
    // Función para exportar a Excel
    function exportarAExcel() {
        console.log("funcion de exportar");
        // Obtener los datos del DataTable
        var dataTable = obtenerDataTable();

        // Realizar la solicitud AJAX a procesos.php
        $.ajax({
            type: 'POST',
            url: 'php/procesos.php',
            data: {
                accion: 'exportarExcel',
                datatable: JSON.stringify(dataTable)
            },
            success: function(response) {
                // Iniciar la descarga
                window.location.href = response;
            },
            error: function(error) {
                // Puedes manejar el error si es necesario
                console.error(error);
            }
        });
    }

    // Función para obtener el DataTable de la página actual
    function obtenerDataTable() {
        var dataTable = [];
        // Lógica para obtener los datos del DataTable de la página actual
        // Ejemplo: Iterar sobre las filas de la tabla y construir el arreglo de datos
        $('#dataTable tbody tr').each(function() {
            var fila = {};
            $(this).find('td').each(function(index, cell) {
                fila[$('thead th:eq(' + index + ')').text()] = $(cell).text();
            });
            dataTable.push(fila);
        });
        return dataTable;
    }

    // Asignar el evento al botón
    $('#exportarExcelBtn').on('click', function() {
        exportarAExcel();
    });
</script>



    <script>
                $(document).ready(function() {
            var table = $('#dataTable').DataTable(); // Inicializa DataTables

            $("form").submit(function(e) {
                e.preventDefault();
                var accion = $(this).find("input[name='accion']").val();

                $.ajax({
                    url: "php/procesos.php",
                    type: "GET",
                    data: {accion: accion},
                    success: function(data) {
                        // Destruye la instancia existente
                        table.destroy();

                        // Carga los nuevos datos
                        $("#dataTable tbody").html(data);

                        // Reinicializa DataTables
                        table = $('#dataTable').DataTable();
                    }
                });
            });
        });
    </script>

<script>
$(document).ready(function() {
    $('#generatePdfButton').on('click', function() {
    window.jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();

    // Agrega el título
    doc.setFontSize(16);
    doc.text('REPORTE DE CLIENTES', 10, 10);

    // Convierte la tabla HTML en un formato adecuado para PDF
    var table = $('#dataTable').DataTable();

    // Filtra los datos en la tabla según el filtro aplicado
    var filteredData = table.column(5, {"filter": "applied"}).data().toArray();
    
    // Calcula la suma de los montos solo para los datos filtrados
    var sumaMontos = 0;
    filteredData.forEach(function(value) {
        sumaMontos += parseFloat(value);
    });

    // Agrega la tabla al PDF
    doc.autoTable({
        html: '#dataTable',
        startY: 20  // Ajusta la posición vertical según tu preferencia
    });

    // Agrega la suma de los montos al final del informe
    doc.setFontSize(12);
    doc.text('Suma de Montos : $' + sumaMontos.toFixed(2), 10, doc.internal.pageSize.height - 10);

    // Guarda o muestra el PDF
    doc.save('Reporte_Clientes.pdf');
});

    });
</script>


<script>
    // Funciones de JavaScript para manejar las acciones
    function eliminarVenta(idVenta) {
        // Llamada AJAX para eliminar la venta
        $.ajax({
            url: 'php/procesos.php',
            type: 'POST',
            data: { action: 'eliminarVenta', id: idVenta },
            success: function(response) {
                window.location.href = '/dashboardadmin/tablas_usuario.php?success=1'; // Redirige a la página con éxito
            },
            error: function(error) {
                window.location.href = '/dashboardadmin/tablas_usuario.php?error=1'; // Redirige a la página con error
                console.error(error);
            }
        });
    }

    function editarVenta(idVenta) {
    // Redirecciona a editar_venta.php con el ID como parámetro
    window.location.href = 'editar_venta.php?id=' + idVenta;
    }


</script>


</body>

</html>