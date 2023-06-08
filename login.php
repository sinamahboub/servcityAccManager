<?php
require_once "./php/autoload.php";

$Msg = new Msg();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="./assets/images/servCityLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <?php $Msg->show() ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card text-start">
                <div class="card-body">
                    <h4 class="card-title">login</h4>
                    <p class="card-text">
                    <form action="auth.php" method="post" class="form-control">
                        <label for="username">username :</label>
                        <input type="text" name="username" id="username" class="form-control">

                        <div class="mt-2"></div>

                        <label for="password">password :</label>
                        <input type="password" name="password" id="password" class="form-control">

                        <div class="mt-2"></div>

                        <button type="submit" class="btn btn-info">submit</button>
                    </form>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>