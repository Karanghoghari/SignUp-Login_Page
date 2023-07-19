<?php
$showAlert = false;
$showErr = false;
$alreadyExist = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $Cpassword = $_POST['Cpassword'];

    $ExistSql = "SELECT * FROM `storedata` WHERE `Email` = '$email'";
    $result = mysqli_query($conn, $ExistSql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $alreadyExist = true;
    } else {

        if ($password == $Cpassword) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `storedata` (`Email`, `Password`, `Date`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
                header("location: loginPage.php");
            }
        } else {
            $showErr = true;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-up</title>
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
    if ($alreadyExist) {
        echo "<div class='alert alert-danger' role='alert'>Entered email is already registered! Use different email for signup.</div>";
    }
    if ($showAlert) {
        echo "<div class='alert alert-success' role='alert'>Your Email has been registered successfully!</div>";
    }
    if ($showErr) {
        echo "<div class='alert alert-danger' role='alert'>Password does not match!</div>";
    }
    ?>

    <div class="container">
        <form action="registerPage.php" method="post">
            <div class="mb-3 mt-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="8" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="Cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="8" class="form-control" id="Cpassword" name="Cpassword">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>