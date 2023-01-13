<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/projecten.css" rel="stylesheet">
    <?php include './components/bootstrap.html'; ?>

</head>

<?php require("modules/auth.php") ?>


<?php

session_start();

if(isset($_POST['password'])) {
    if(login($_POST['password'])) {
        header("Location: ./admin.php");
    } else {
        echo "Incorrect password";
    }
}

?>

<body>
    <div class="main vh-min-100">

        <header class="bg-dark">
            <h1 class="text-white text-center">Tycho van Opstal</h1>
            <h2 class="text-white text-center">Software Developer</h2>
            <?php include './components/nav.html'; ?>
        </header>


        <main>

            <h3 class="text-center">
                Login
            </h3>

            <div class="container">

                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Wachtwoord</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        Verstuur
                    </button>
                </form>

            </div>


        </main>
    </div>


</body>

</html>