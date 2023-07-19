<?php
$emailErr = false;
$loggedIN = false;
$passwordErr = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connection.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $sql = "SELECT * FROM `storedata` WHERE `Email` = '$email' AND `Password` = '$password'";
    $sql = "SELECT * FROM `storedata` WHERE `Email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['Password'])) {
                $loggedIN = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['Email'] = $email;
                header("location: welcomePage.php");
            } else {
                $passwordErr = true;
            }
        }

    } else {
        $emailErr = true;
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="registerPage.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginPage.php">Login</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li> -->

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if ($loggedIN) {
        echo "<div class='alert alert-danger' role='alert'>You are logged in.</div>";
    }
    if ($emailErr) {
        echo "<div class='alert alert-danger' role='alert'>You have entered wrong Email.</div>";
    }
    if ($passwordErr) {
        echo "<div class='alert alert-danger' role='alert'>You have entered wrong password.</div>";
    }
    ?>

    <div class="container mt-4">
        <h3 style="font-weight: normal">Login Your account</h3>
        <form action="loginPage.php" method="post">
            <div class="mb-3 mt-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="8" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>


</body>

</html>