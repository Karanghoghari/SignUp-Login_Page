<?php
require "connection.php";
session_start();
if (!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin']) != true) {
    header("location: loginPage.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="registerPage.php">SignUP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="welcomePage.php">Welcome</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="registerPage.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginPage.php">Login</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="logoutPage.php">Logout</a>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome to the Earth <?php echo $_SESSION['Email']; ?></h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
                longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">If you want to logout <a href="logoutPage.php">click here   </a> </p>
        </div>
    </div>


</body>

</html>