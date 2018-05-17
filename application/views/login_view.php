<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url () ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url () ?>assets/css/style.css">
    <title>ETL LOGIN</title>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <form method="POST" action="<?= base_url("index.php/Login/login") ?>">
                <div class="form-group">
                    <label style="color:white;" for="user" >Usuario</label>
                    <input class="form-control" required="true" type="text" name="user" value="<?= (isset($input['user'])) ? $input['user'] : '' ?>">
                </div>
                <div class="form-group">
                    <label style="color:white;" for="pswd">Password</label>
                    <input class="form-control"  required="true" type="Password" name="pswd" value="">
                </div>
                <div class="form-group">
                    <label class="error"><?php echo (isset($input['mensaje'])) ? $input['mensaje'] : '' ?></label>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
                <a class="btn btn-secondary" href="<?= base_url('index.php/Login/sign_in') ?>">
                    Registrarse
                </a>
            </form>
            </div>
            <div class="Col-4"></div>
        </div>
    </div>
    <script src="<?php echo base_url("assets/js/jquery.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js") ?>"></script>
</body>
</html>