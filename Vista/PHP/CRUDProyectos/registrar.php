<?php
print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtNombreProy"]) || empty($_POST["txtDesProy"]) || empty($_POST["txtFechaInicio"])
    || empty($_POST["txtFechaFin"]) ) {
       header('Location: proyectoInicio.php?mensaje=falta');
       exit();
    }

    include_once '../database.php';
    $nombreProyecto = $_POST['txtNombreProy'];
    $desProyecto = $_POST['txtDesProy'];
    $fechInicio = $_POST['txtFechaInicio'];
    $fechaFin = $_POST['txtFechaFin'];

    $sentencia = $conn->prepare("INSERT INTO Proyectos(nombreProyecto, descripcionProyecto, fecha_inicio, fecha_tentativa, Usuarios_idUsuarios)
    VALUES(?,?,?,?,(select max(idUsuarios) from Usuarios))");
    $resultado = $sentencia->execute([$nombreProyecto,$desProyecto,$fechInicio,$fechaFin]);

    if ($resultado === TRUE) {
        header('Location: proyectoInicio.php?mensaje=registrado');
    } else {
        header('Location: proyectoInicio.php?mensaje=error');
    }

?>