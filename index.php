<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
    <!-- bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
<div class="main vh-100">

    <header class="bg-dark">
        <h1 class="text-white text-center">Tycho van Opstal</h1>
        <h2 class="text-white text-center">Software Developer</h2>
        <?php include './components/nav.html'; ?>
    </header>


    <main>

        <h3 class="text-center">
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
                            Ik ben Tycho van Opstal, een student software developer aan het Grafisch Lyceum Rotterdam! xxxxxxxxxx
                            Mijn passie voor technologie zorgt ervoor dat geen uitdaging te groot is.
                            In mijn vrije tijd ben ik (meestal) bezig met allerlei projecten, zoals het ontwikkelen van websites en applicaties.
                            Maar ook het beheren van mijn eigen homelab waar ik linux servers draai, vooral voor het testen van mijn eigen projecten.
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