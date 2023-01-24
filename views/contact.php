<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Neem contact op met de software developer Tycho van Opstal">
    <meta name="keywords" content="Tycho van Opstal, contact, email, portfolio, software developer">
    <meta name="author" content="Tycho van Opstal">

    <title>Tycho van Opstal</title>
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

        <h3 class="text-center text-white m-3">
                Contact
            </h3>

            <div class="container">

                <form action="/api/email" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="emailAdres" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" required>
                    </div>

                    <div class="form-group">
                        <label for="bericht">
                            Uw bericht
                        </label>
                        <textarea name="bericht" class="form-control" rows="10" cols="50" placeholder="Bericht" required></textarea>
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