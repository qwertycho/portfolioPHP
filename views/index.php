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
    <link rel="icon" type="image/png" sizes="32x32" href="/public/img/favicon.png">
    <link href="/public/css/style.css" rel="stylesheet">
    <?php include './components/bootstrap.html'; ?>
</head>


<?php global $technieken; ?>

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
                    <img class="img-fluid w-75 dark rounded" src="/public/img/tycho.png" alt="Tycho">
                </div>
                <div class="col-sm">
                    <div class="about">
                        <p class="p-3 dark rounded">
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

<article class="bg-dark p-5 min-vh-50">

    <div class="techniekContainer">
        <div class="container">
            <div class="row">
        <?php
        foreach ($technieken as $techniek) {
                echo "<a class='col-sm text-center p-2 m-2 techniek' href='/projecten?techniek=" . $techniek['techniek'] . "'>";
                    echo '<img class="img-fluid" src="/public/img/technieken/' . $techniek['thumbnail'] . '" alt="' . $techniek['techniek'] . '">';
                    echo '<h4 class="text-center align-self-center text-white">' . $techniek['techniek'] . '</h4>';
                echo '</a>';
        }
        ?>
        </div>
        </div>
    </div>

</article>

</body>

</html>