<?php
require(__DIR__.'/../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function connectToDatabase() {
    $mysqli = new mysqli("127.0.0.1", "admin", "bd_admin", "bd_dashboard_admin");

    // Check the connection
    if ($mysqli->connect_error) {
        die("Error in connection: " . $mysqli->connect_error);
    }

    return $mysqli;
}


// Verificar la acción y realizar la operación correspondiente
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'exportarExcel') {
        // Obtener el DataTable desde la solicitud AJAX
        $dataTable = json_decode($_POST['datatable'], true);

        // Lógica para exportar a Excel
        exportarDataTableAExcel($dataTable);
    }
}

if(isset($_GET['accion'])){
    $accion = $_GET['accion'];
    if($accion === 'cargarventastodo'){
        listarVentasTodo();
    } elseif($accion === 'cargarventasmes'){
        listarVentasMes();
    }
}

if (isset($_POST['registrar'])) {
    registrarusuario();
}

// Verificar si se recibe la acción y el ID
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Verificar la acción y el ID
    if ($action == 'eliminarVenta' && isset($_POST['id'])) {
        $idVenta = $_POST['id'];
        eliminarVenta($idVenta);
        // Puedes imprimir un mensaje de éxito si es necesario
        echo 'Venta eliminada con éxito';
    } elseif ($action == 'editarVenta' && isset($_POST['id'])) {
        $idVenta = $_POST['id'];
        editarVenta($idVenta);
        // Puedes imprimir un mensaje de éxito si es necesario
        echo 'Venta editada con éxito';
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'obtenerProductosMasVendidos') {
        $datosProductos = obtenerProductosMasVendidos();

        // Devolver los datos como una respuesta JSON
        echo json_encode($datosProductos);
    }
}


function exportarDataTableAExcel($dataTable, $nombreArchivo = 'exportacion_excel') {
    // Crear una instancia de PhpSpreadsheet
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados
    $encabezados = array_keys($dataTable[0]);
    $columna = 1;

    foreach ($encabezados as $encabezado) {
        $sheet->setCellValueByColumnAndRow($columna, 1, $encabezado);
        $columna++;
    }

    // Agregar datos desde el DataTable
    $fila = 2;

    foreach ($dataTable as $data) {
        $columna = 1;
        foreach ($data as $valor) {
            $sheet->setCellValueByColumnAndRow($columna, $fila, $valor);
            $columna++;
        }
        $fila++;
    }

    // Crear un objeto de escritura para Excel
    $writer = new Xlsx($spreadsheet);

    // Guardar el archivo en el servidor
    $rutaArchivo = 'C:/' . $nombreArchivo . '.xlsx';
    $writer->save($rutaArchivo);

    // Devolver la ruta del archivo en la respuesta
    return $rutaArchivo;
}


function registrarusuario() {
    // Recopila los datos del formulario
    $fecha = $_POST['fecha'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $monto = $_POST['monto'];

    $mysqli = connectToDatabase();

    // Consulta para insertar los datos en la tabla "ventas"
    $sql = "INSERT INTO ventas (fecha, nombre, apellido, producto, cantidad, monto) VALUES ('$fecha', '$nombre', '$apellido', '$producto', '$cantidad', '$monto')";

    if ($mysqli->query($sql) === TRUE) {
        // Registro realizado exitosamente
        header("Location: ../registro_ventas.php?success=1");
        exit();
    } else {
        // Error al registrar
        header("Location: ../registro_ventas.php?error=1");
        exit();
    }

    // Cierra la conexión
    $mysqli->close();
}



// Función para eliminar una venta
function eliminarVenta($idVenta) {
    $mysqli = connectToDatabase();

    // Consulta para eliminar la venta con el ID proporcionado
    $sql = "DELETE FROM ventas WHERE id = $idVenta";
    error_log("sql");

    if ($mysqli->query($sql) === TRUE) {
        // Registro realizado exitosamente
       
        exit();
    } else {
        // Error al registrar
       
        exit();
    }

    $mysqli->close();
}

if (isset($_POST['editar'])) {
    // Recopila los datos del formulario
    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $monto = $_POST['monto'];

    $mysqli = connectToDatabase();

    // Consulta para actualizar los datos en la tabla "ventas"
    $sql = "UPDATE ventas SET fecha='$fecha', nombre='$nombre', apellido='$apellido', producto='$producto', cantidad='$cantidad', monto='$monto' WHERE id=$id";

    if ($mysqli->query($sql) === TRUE) {
        // Edición realizada exitosamente
        header("Location: ../tablas_usuario.php?success2=1");
        exit();
    } else {
        // Error al editar
        header("Location: ../tablas_usuario.php?error2=1");
        exit();
    }

    // Cierra la conexión
    $mysqli->close();
}

function listarVentasTodo() {
    // Conexión a la base de datos
    $mysqli = connectToDatabase();

    // Consulta para obtener todas las ventas
    $sql = "SELECT * FROM ventas";
    $result = $mysqli->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        

        // Itera a través de los resultados y genera las filas del tbody
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['fecha'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['apellido'] . '</td>';
            echo '<td>' . $row['producto'] . '</td>';
            echo '<td>' . $row['cantidad'] . '</td>';
            // Formatea el valor de la columna "Monto" como número decimal con dos decimales
            $montoFormateado = number_format($row['monto'], 2);
            echo '<td>' . $montoFormateado . '</td>';
            echo '<td>
                    <button class="btn btn-danger" onclick="eliminarVenta(' . $row['id'] . ')">Eliminar</button>
                    <button class="btn btn-warning" onclick="editarVenta(' . $row['id'] . ')">Editar</button>
                  </td>';
            echo '</tr>';
        }

       
    } else {
        // No se encontraron ventas
        echo '<p>No se encontraron ventas.</p>';
    }

    // Cierra la conexión
    $mysqli->close();
}


// Función para obtener los datos de una venta por su ID
function obtenerDatosVenta($idVenta) {
    $mysqli = connectToDatabase();

    // Consulta para obtener los datos de la venta
    $sql = "SELECT * FROM ventas WHERE id = $idVenta";

    // Ejecutar la consulta
    $result = $mysqli->query($sql);

    // Verificar si la consulta fue exitosa
    if ($result && $result->num_rows > 0) {
        // Obtener los datos de la venta como un array asociativo
        $datosVenta = $result->fetch_assoc();
    } else {
        // Manejar el caso en que no se encuentren datos
        $datosVenta = array();
    }

    // Cerrar la conexión a la base de datos
    $mysqli->close();

    return $datosVenta;
}



function listarVentasMes() {
    // Conexión a la base de datos
    $mysqli = connectToDatabase();

    // Obtén el mes actual
    $mesActual = date('m');

    // Consulta para obtener solo las ventas del mes actual
    $sql = "SELECT * FROM ventas WHERE MONTH(fecha) = $mesActual";

    $result = $mysqli->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        

        // Itera a través de los resultados y genera las filas del tbody
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['fecha'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['apellido'] . '</td>';
            echo '<td>' . $row['producto'] . '</td>';
            echo '<td>' . $row['cantidad'] . '</td>';
            // Formatea el valor de la columna "Monto" como número decimal con dos decimales
            $montoFormateado = number_format($row['monto'], 2);
            echo '<td>' . $montoFormateado . '</td>';
            echo '<td>
                    <button class="btn btn-danger" onclick="eliminarVenta(' . $row['id'] . ')">Eliminar</button>
                    <button class="btn btn-warning" onclick="editarVenta(' . $row['id'] . ')">Editar</button>
                  </td>';
            echo '</tr>';
        }

       
    } else {
        // No se encontraron ventas
        echo '<p>No se encontraron ventas.</p>';
    }

    // Cierra la conexión
    $mysqli->close();
}


if(isset($_GET['ejecutar'])){
    obtenerSumaMontosDelMes();
}

function obtenerSumaMontosDelMes() {
    // Obtén el mes actual
    $mesActual = date('m');

    $mysqli = connectToDatabase();

    // Consulta SQL para obtener la suma de montos del mes actual
    $sql = "SELECT SUM(monto) AS suma_montos FROM ventas WHERE MONTH(fecha) = ?";

    // Preparar la consulta
    $stmt = $mysqli->prepare($sql);

    // Vincular el parámetro del mes
    $stmt->bind_param("s", $mesActual);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $resultado = $stmt->get_result();

    // Obtener la suma de montos
    $fila = $resultado->fetch_assoc();
    $suma_montos = $fila['suma_montos'];

    // Cierra la conexión
    $stmt->close();
    $mysqli->close();

    echo $suma_montos;
}


if(isset($_GET['ejecutaranual'])){
    obtenerSumaMontosDelAnio();
}

function obtenerSumaMontosDelAnio() {
    // Obtén el mes actual
    $anioActual = date('Y');

    $mysqli = connectToDatabase();

    // Consulta SQL para obtener la suma de montos del mes actual
    $sql = "SELECT SUM(monto) AS suma_montos FROM ventas WHERE YEAR(fecha) = ?";

    // Preparar la consulta
    $stmt = $mysqli->prepare($sql);

    // Vincular el parámetro del mes
    $stmt->bind_param("s", $anioActual);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $resultado = $stmt->get_result();

    // Obtener la suma de montos
    $fila = $resultado->fetch_assoc();
    $suma_montos = $fila['suma_montos'];

    // Cierra la conexión
    $stmt->close();
    $mysqli->close();

    echo $suma_montos;
}


if(isset($_GET['ejecutarventames'])){
    obtenerVentasDelMes();
}

function obtenerVentasDelMes() {
    // Obtén el mes actual
    $anoActual = date('Y'); // Obtiene el año actual
    $mesActual = date('m'); // Obtiene el mes actual

    $mysqli = connectToDatabase();

    // Consulta SQL para obtener la suma de montos del mes actual
    $sql = "SELECT COUNT(*) AS total_ventas FROM ventas WHERE YEAR(fecha) = ? AND MONTH(fecha) = ?";

    // Preparar la consulta
    $stmt = $mysqli->prepare($sql);

    // Vincular el parámetro del mes
    $stmt->bind_param("ss", $anoActual, $mesActual);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $resultado = $stmt->get_result();

    // Obtener la suma de montos
    $fila = $resultado->fetch_assoc();
    $suma_montos = $fila['total_ventas'];

    // Cierra la conexión
    $stmt->close();
    $mysqli->close();

    echo $suma_montos;
}



if (isset($_GET['ejecutargraficoventas'])) {
    GraficoVentasDelMes();
}
function GraficoVentasDelMes() {

    $mysqli = connectToDatabase();

    // Consulta SQL para obtener la suma de montos del mes actual
    $sql = "SELECT MONTH(fecha) AS mes, SUM(monto) AS total_ventas FROM ventas GROUP BY MONTH(fecha)";

    error_log("Consulta SQL: " . $sql);

    // Preparar la consulta
    $result = $mysqli->query($sql);

    // Mapeo de números de mes a nombres
    $meses = array(
        1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre"
    );

   // Prepara un arreglo para almacenar los datos
    $data = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Forzar la conversión a número
            $mes_numero = intval($row['mes']);
            
            // Verificar si el número de mes está en el rango válido (1-12)
            if ($mes_numero >= 1 && $mes_numero <= 12) {
                // Usar el número de mes para obtener el nombre correspondiente
                $row['mes'] = $meses[$mes_numero];
            } else {
                // Valor no válido, asignar un mensaje de error o un valor por defecto
                $row['mes'] = "Error"; // Otra acción en caso de valor no válido
            }
            
            $data[] = $row;
        }
    }

    $mysqli->close();

    // Devuelve los datos en formato JSON
    echo json_encode($data);
}

function obtenerProductosMasVendidos() {
    $mysqli = connectToDatabase();

    // Consulta para obtener los 3 productos más vendidos
    $sql = "SELECT producto, SUM(cantidad) as total FROM ventas GROUP BY producto ORDER BY total DESC LIMIT 3";

    // Ejecutar la consulta
    $result = $mysqli->query($sql);

    // Verificar si la consulta fue exitosa
    if ($result && $result->num_rows > 0) {
        // Obtener los datos de los productos como un array asociativo
        $datosProductos = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Manejar el caso en que no se encuentren datos
        $datosProductos = array();
    }

    // Cerrar la conexión a la base de datos
    $mysqli->close();

    return $datosProductos;
}


?>