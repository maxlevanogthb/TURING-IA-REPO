<?php
include 'template/header.php'
?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: proyectoInicio.php?mensaje=error');
        exit();
    }

    include_once '../database.php';
    $codigo = $_GET['codigo'];
    $sentencia = $conn->prepare("SELECT idProyectos,nombreProyecto, descripcionProyecto, fecha_inicio, fecha_tentativa FROM Proyectos WHERE idProyectos= ?");
    $sentencia->execute([$codigo]);
    $proyecto = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar proyecto
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">
                            Nombre:
                        </label>
                        <input name="txtNombreProy" type="text" class="form-control" autofocus required value="<?php echo $proyecto->nombreProyecto ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Descripcion del Proyecto:
                        </label>
                        <input name="txtDesProy" type="text" class="form-control" autofocus required value="<?php echo $proyecto->descripcionProyecto ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Fecha de Inicio
                        </label>
                        <input name="txtFechaInicio" type="text" class="form-control" autofocus required value="<?php echo $proyecto->fecha_inicio?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Fecha tentativa a finalizar:
                        </label>
                        <input name="txtFechaFin" type="text" class="form-control" autofocus require value="<?php echo $proyecto->fecha_tentativa?>">
                    </div>
                    <div class="display-grid">
                        <input type="hidden" name="codigo" value="<?php echo $proyecto->idProyectos?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include 'template/footer.php'
?>