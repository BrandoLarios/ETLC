<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url () ?>assets/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <form method="POST" action="<?= base_url("index.php/Signin/sign_in") ?>">
                <div class="form-group">
                    <label for="usu" >Usuario</label>
                    <input class="form-control" required="true" type="text" name="user" value="<?= (isset($input['user'])) ? $input['user'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="usu" >Correo</label>
                    <input class="form-control" required="true" type="email" name="mail" value="<?= (isset($input['mail'])) ? $input['mail'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="pswd">Contraseña</label>
                    <input class="form-control" required="true" type="Password" name="pswd" value="">
                </div>
                <div class="form-group">
                    <label for="pswdv">Verificar contraseña</label>
                    <input class="form-control" required="true" type="Password" name="pswdv" value="">
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
                <a class="btn btn-secondary" href="<?= base_url('index.php/Signin/volver')?>">
                    Volver
                </a>
                <!--<input type="button" name="" value="Validar" >-->
            </form>
            </div>
            <div class="Col-4"></div>
        </div>
    </div> 

    <script src="<?php echo base_url("assets/js/jquery.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js") ?>"></script>
</body>
</html>