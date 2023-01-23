<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="De portfolio website van de software developer Tycho van Opstal">
    <meta name="keywords" content="Tycho van Opstal, projecten, portfolio, software developer">
    <meta name="author" content="Tycho van Opstal">

    <title>Tycho van Opstal CV</title>
    <link href="/public/css/style.css" rel="stylesheet">
    <?php include './components/bootstrap.html'; ?>
</head>


<?php global $technieken; ?>

<body>
<div class="main vh-min-100">

    <header class="bg-dark">
        <h1 class="text-white text-center">
            Tycho van Opstal CV
        </h1>
        <h2 class="text-white text-center">
            Software Developer
        </h2>
        <?php include './components/nav.html'; ?>
    </header>


    <main>

        <h3 class="text-center m-3 text-white">
        CV
        </h3>

        <div class="container-fluid cv-container text-white">
            <div class="row row-cols-1">
                <div class="col-12">
                        <p>
                            Ik ben Tycho van Opstal, een student software developer aan het Grafisch Lyceum Rotterdam! 
                            Mijn passie voor technologie zorgt ervoor dat geen uitdaging te groot is. In mijn vrije tijd ben ik (meestal) bezig met allerlei projecten, 
                            zoals het ontwikkelen van websites en applicaties. Maar ook het beheren van mijn eigen homelab waar ik linux servers op draai, vooral voor het testen van mijn eigen projecten.  
                            Ik ben Tycho van Opstal, een student software developer aan het Grafisch Lyceum Rotterdam!
                            Mijn passie voor technologie zorgt ervoor dat geen uitdaging te groot is.
                            In mijn vrije tijd ben ik (meestal) bezig met allerlei projecten, zoals het ontwikkelen van websites en applicaties.
                            Maar ook het beheren van mijn eigen homelab waar ik linux servers op draai, vooral voor het testen van mijn eigen projecten.
                        </p>
                </div>
            </div>
            <hr>
            <div class="row row-cols-1">
                <div class="col col-sm">
                    <h4 class="text-center">
                        Opleidingen
                    </h4>

                    <p >
                        Grafisch Lyceum Rotterdam <br>
                        MBO 4 Software Developer <br>
                        2021 - heden
                    </p> 
                    <hr>
                     <p class="text-left">
                        Grafisch Lyceum Rotterdam <br>
                        MBO 3 Allround-DTP <br>
                        2018 - 2021 <br>
                        diploma behaald
                    </p> 
                    <hr>
                     <p class="text-left">
                        Maerlant college Brielle <br>
                        Theoretische Leerweg | sector economie <br>
                        2014 - 2018 <br>
                        diploma behaald
                    </p> 

                </div>

                <div class="col col-sm">
                    <h4 class="text-center">
                        Werkervaring
                    </h4>

                    <p>
                        Allround medewerker <br>
                        Anl V Geest. <br>
                        2018 - heden <br>
                    </p> 
                    <hr>

                    <p>
                        Stagiair DTP'er  <br>
                        Don Plotter Service <br>
                        09-2020 - 01-2021 <br> <br>
                    </p> 
                    <hr>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col col-sm">
                    <h4 class="text-center">
                        Vaardigheden
                    </h4>
                    <p class="text-center">
                        <?php foreach ($technieken as $techniek) : ?>
                            <span class="badge bg-primary">
                                <?php echo $techniek['techniek']; ?>
                            </span>
                        <?php endforeach; ?>

                        <span class="badge bg-primary">scrum</span>
                        <span class="badge bg-primary">git</span>
                        <span class="badge bg-primary">github</span>
                        <span class="badge bg-primary">Visual Studio (code)</span>
                    </p>
                </div>

                <div class="col col-sm">
                    <h4 class="text-center">
                        Extra
                    </h4>

                    <p>
                        Lid debatclub Grafisch Lyceum Rotterdam <br>
                        2022 - heden <br>
                    </p> 
                    <hr>

                    <p>
                        Project Digital Signage Grafisch Lyceum Rotterdam <br>
                        2019 - 2019 <br>
                    </p> 
                    <hr>

                    <p>
                        Lid centrale studentenraad Grafisch lyceum Rotterdam<br>
                        2018 - 2021 <br>
                    </p>

        </div>


    </main>
</div>

</body>

</html>