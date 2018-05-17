<? php 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url () ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url () ?>assets/css/style.css">

    <title></title>
  </head>
  <body>
    <!-- Inicia Barra de navegacion -->
    <div bg-dark>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">ETL Clinica</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <!--  -->
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/Pruebas/pets_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            Clientes/Mascotas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Cliente</a>
                        <a class="dropdown-item" href="#">Mascota</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/Pruebas/consult_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">   
                            Consultas/Historicos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Consulta</a>
                        <a class="dropdown-item" href="#">Historico Analisis</a>
                        <a class="dropdown-item" href="#">Historico Cirugias</a>
                        <a class="dropdown-item" href="#">Historico Estadias</a>
                        <a class="dropdown-item" href="#">Historico Medicamento</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/Pruebas/veterinarian_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                        Veterinarios/Especialidades
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Veterinario</a>
                        <a class="dropdown-item" href="#">Especialidad</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/Pruebas/pay_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                        Facturas/Pagos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Facturas</a>
                        <a class="dropdown-item" href="#">Pagos</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <img src="/Pruebas/excel_icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            Generar excel
                        </a>
                    </li>
                    
                </ul>
                <!-- Logout -->
                <form class="form-inline">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerrar sesion</button>
                </form>
            </div>
        </nav>
    </div>
    <!-- Finaliza Barra de navegacion -->
    <div>
        <?php 
            //if(isset($childrensuffering['enfcar']) != 0){
                echo '<form action="">';
                    echo '<div class="container">';
                        echo '</br> </br> </br>';
                        echo '<h2 style="text-align: center;"> El proceso de ETL (Extracción, transformacion y carga) </h2>';
                        echo '<h4> Ofrece la posibilidad de tener </h4>';
                        echo '</br> </br>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                            echo '</div>';
                            echo '<div class="col-md-4">';
                                echo '<button class="btn" type="submit" style="background-color:green; color:white;"> Comenzar proceso ETL </button>';
                            echo '</div>';
                            echo '<div class="col-md-4">';
                            echo '</div>';
                        echo '</div>';    
                    echo '</div>'; 
                echo '</form>'; 
            //}
        ?>
    </div>
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url("assets/js/jquery.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js") ?>"></script>
    </body>
</html>