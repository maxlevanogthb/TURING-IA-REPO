<?php
include('db.php');
$usuario=$_REQUEST['txtUsuario'];
$password=$_REQUEST['txtPwd'];



$consulta="call sp_loginUsuarios('$usuario','$password'";

$res = mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($res);

if($filas){
  
    header("location:../Vista/PHP/home.php");

}else{
    ?>
    <?php
    include("../index.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($res);
mysqli_close($conexion);
