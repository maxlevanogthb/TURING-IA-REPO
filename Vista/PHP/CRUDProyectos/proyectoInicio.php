<?php
include 'template/header.php'
?>

<?php
require '../database.php';
$sentencia = $conn->query("SELECT
    p.idProyectos, 
    p.nombreProyecto,
    p.descripcionProyecto,
    p.fecha_inicio,
    p.fecha_tentativa,
    p.avances,
    l.nombreLogin
    FROM
    Proyectos p JOIN Login l on (p.Usuarios_idUsuarios = l.Usuarios_idUsuarios);");
$proyecto = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--Inicio Alerta -->
            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] === 'falta') {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Rellena todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] === 'registrado') {
            ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registrado!</strong> Se registro el Proyecto Correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] === 'error') {
            ?>

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
            }
            ?>

            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] === 'editado') {
            ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Editado!</strong> Los datos fueron Actualizados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
            }
            ?>

            <!--Fin Alerta -->
            <div class="card">
                <div class="card-header">
                    Lista de Proyectos
                </div>
            </div>
            <div class="p-4">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del Proyecto</th>
                            <th scope="col">Descripcion del Proyecto</th>
                            <th scope="col">Fecha de inicio de proyecto</th>
                            <th scope="col">Fecha tentativa para finalizar</th>
                            <th scope="col">Avances</th>
                            <th scope="col">Cliente</th>
                            <th scope="col" colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($proyecto as $dato) {
                                # code...

                            ?>

                                <td scope="row"><?php echo $dato->idProyectos; ?></td>
                                <td><?php echo $dato->nombreProyecto; ?></td>
                                <td><?php echo $dato->descripcionProyecto; ?></td>
                                <td><?php echo $dato->fecha_inicio; ?></td>
                                <td><?php echo $dato->fecha_tentativa; ?></td>
                                <td><?php echo $dato->avances; ?></td>
                                <td><?php echo $dato->nombreLogin; ?></td>
                                <td class="text-success"><a href="editar.php?codigo=<?php echo $dato->idProyectos; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td class="text-danger"><a href="eliminar.php?codigo="><i class="bi bi-trash"></i></a></td>

                        </tr>
                    <?php
                            }
                    ?>


                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Registrar nuevo proyecto
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">
                            Nombre:
                        </label>
                        <input name="txtNombreProy" type="text" class="form-control" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Descripcion del Proyecto:
                        </label>
                        <textarea name="txtDesProy" type="text" class="form-control" autofocus required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Fecha de Inicio
                        </label>
                        <input name="txtFechaInicio" type="text" class="form-control" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Fecha tentativa a finalizar:
                        </label>
                        <input name="txtFechaFin" type="text" class="form-control" autofocus require>
                    </div>
                    <div class="display-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>

            <div>
                <a class="btn btn-danger" href="../../../index.html">Regresar a la Pagina Principal</a>
            </div>
        </div>
    </div>

    <?php
    include 'template/footer.php'
    ?>