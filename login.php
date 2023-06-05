<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
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

    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>