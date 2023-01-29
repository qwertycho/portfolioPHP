<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    
    <title>Login</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/img/favicon.png">
    <link href="/public/css/style.css" rel="stylesheet">
    <link href="/public/css/projecten.css" rel="stylesheet">
    <?php include './components/bootstrap.html'; ?>

</head>


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

                <form action="/admin/login" method="post">
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