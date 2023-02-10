<?php
session_start();
/* 
Check if the user data existe in the session and store the boolean value in the variable 
$logged
Just with $logged we can know if the user is connected or not
*/
$logged = isset($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Stock</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Acceuil</a>
                    </li>

                    <?php if (!$logged): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="produits.php">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">Logout</a>
                        </li>
                    <?php endif ?>

                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <?php if (isset($_SESSION["errors"])): ?>
            <ul class="alert alert-danger list-group">
                <?php foreach ($_SESSION["errors"] as $error): ?>
                    <li class="list-group-item bg-danger text-white">
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>

            </ul>
        <?php endif; ?>

        <?php if (isset($_SESSION["error"])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION["error"] ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success ">
                <?= $_SESSION["success"] ?>
            </div>
        <?php endif; ?>
    </div>