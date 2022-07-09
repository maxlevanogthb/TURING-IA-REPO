<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: proyectoInicio.php?mensaje=error');
        exit();
    }

    include '../database.php';
    $codigo = $_POST['codigo'];
    $nombreProy = $_POST['txtNombreProy'];
    $desProy = $_POST['txtDesProy'];
    $fechaInicio = $_POST['txtFechaInicio'];
    $fechaFin = $_POST['txtFechaFin'];

    $sentencia = $conn->prepare("UPDATE proyectos SET nombreProyecto=?, descripcionProyecto=?, fecha_inicio=?, fecha_tentativa=? WHERE idProyectos=?");
    $resultado = $sentencia->execute([$nombreProy, $desProy, $fechaInicio, $fechaFin,$codigo]);

    if($resultado === TRUE){
        header('Location: proyectoInicio.php?mensaje=editado');
    } else{
        header('Location: proyectoInicio.php?mensaje=error');
    }
?>