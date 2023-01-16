<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="De portfolio website van de software developer Tycho van Opstal">
    <meta name="keywords" content="Tycho van Opstal, projecten, portfolio, software developer">
    <meta name="author" content="Tycho van Opstal">

    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
    <?php include './components/bootstrap.html'; ?>
</head>

<body>
<div class="main vh-min-100">

    <header class="bg-dark">
        <h1 class="text-white text-center">
            Tycho van Opstal
        </h1>
        <h2 class="text-white text-center">
            Software Developer
        </h2>
        <?php include './components/nav.html'; ?>
    </header>


    <main>

        <h3 class="text-center m-3">
            Over Mij
        </h3>

        <div class="container">
            <div class="row">

                <div class="col-sm text-center">
                    <img class="img-fluid w-75" src="./img/tycho.png" alt="Tycho">
                </div>
                <div class="col-sm">
                    <div class="about">
                        <p class="text-justify">
                            Ik ben Tycho van Opstal, een student software developer aan het Grafisch Lyceum Rotterdam!
                            Mijn passie voor technologie zorgt ervoor dat geen uitdaging te groot is.
                            In mijn vrije tijd ben ik (meestal) bezig met allerlei projecten, zoals het ontwikkelen van websites en applicaties.
                            Maar ook het beheren van mijn eigen homelab waar ik linux servers op draai, vooral voor het testen van mijn eigen projecten.
                            <br>
                            <br>
                            Als ik niet bezig ben met projecten houd ik mij bezig met (vr) games, 3d-printen of een van mijn vele andere hobbies.
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </main>
</div>

<article class="bg-dark p-5 vh-100">

    <div class="techniekContainer">
                <?php include './components/technieken.html'; ?>
    </div>

</article>

</body>

</html>