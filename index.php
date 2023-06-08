<?php
require_once "./checkLogin.php";
require_once "./php/autoload.php";

$DB = new DB();
$Msg = new Msg();

$stmt = $DB->prepare('SELECT COUNT(*) as count FROM users');
$stmt->execute();
$userCount = $stmt->fetchColumn();

$stmt = $DB->prepare('SELECT COUNT(*) as count FROM panels');
$stmt->execute();
$panelCount = $stmt->fetchColumn();

$stmt = $DB->prepare("SELECT * FROM `panels`");
$stmt->execute();
$listPanels = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./assets/images/servCityLogo.jpg" type="image/x-icon">
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">servcity</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#users" href="">users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#panel" href="">panel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./signOut.php">sign out</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <h2 style="color: #fff;"></h2>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-md-12">
                <?php $Msg->show() ?>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">user count :</h4>
                        <p class="card-text"><?php echo $userCount ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">panel count :</h4>
                        <p class="card-text"><?php echo $panelCount ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">update info :</h4>
                        <p class="card-text">no update</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">

                <?php
                $stmt = $DB->prepare("SELECT * FROM `users` ORDER BY id ASC");
                $result = $stmt->execute();
                if (!$result) {
                    exit("اشکال در پیدا کردن دیتا ها -");
                }

                $listUser = $stmt->fetchAll();
                ?>

                <table class="table table-bordered table-hover table-striped text-center">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>username</th>
                            <th>name</th>
                            <th>date</th>
                            <th>accType</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listUser as $users) { ?>
                            <tr>
                                <td><?= $users->id ?></td>
                                <td><?= $users->username ?></td>
                                <td><?= $users->name ?></td>
                                <td><?= $users->date ?></td>
                                <td><?= $users->accType ?></td>
                                <td><a href="./deleteUser.php?id=<?= $users->id ?>">delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="users">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">users</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./addUser.php" method="post">
                            <input type="hidden" name="id" id="id" readonly>


                            <div class="mb-3 mt-1">
                                <label for="username" class="form-label">username :</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">name :</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">password :</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">date :</label>
                                <input type="text" class="form-control" id="date" name="date">
                            </div>
                            <div class="mb-3">
                                <label for="accType" class="form-label">accType :</label>
                                <select id="accType" name="accType" class="form-control" required>
                                    <option value="" selected>select</option>
                                    <?php foreach ($listPanels as $panels) : ?>
                                        <option value="<?= $panels->id ?>"><?= $panels->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="telegramId" class="form-label">telegram ID :</label>
                                <input type="number" class="form-control" id="telegramId" name="telegramId">
                            </div>
                            <div class="mb-3">
                                <label for="payStatus" class="form-label">payment status :</label>
                                <select name="payStatus" id="payStatus" class="form-control">
                                    <option value="0">unpaid</option>
                                    <option value="1">Paid</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="accStatus" class="form-label">acc status :</label>
                                <select name="accStatus" id="accStatus" class="form-control">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="about" class="form-label">about :</label>
                                <textarea name="about" id="about" cols="15" rows="5" class="form-control"></textarea>
                            </div>


                            <button type=" submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="panel">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">panels</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Modal body..
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>