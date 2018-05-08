<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
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
            <form method="POST" action="<?php base_url(""); ?>">
                <div class="form-group">
                    <label for="usu" >etl</label>
                    <input class="form-control" required="true" type="text" name="user" value="">
                </div>
                <div class="form-group">
                    <label for="pswd">etl</label>
                    <input class="form-control"  required="true" type="Password" name="pswd" value="">
                </div>
            </form>
            </div>
            <div class="Col-4"></div>
        </div>
    </div> 

    <script src="<?php echo base_url () ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url () ?>assets/js/jbootstrap.min.js"></script>
</body>
</html>