<!DOCTYPE html>
<html lang="nl">

<?php 
    global $selectedProject;
    global $selectedTechnieken;
    global $technieken;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $selectedProject["projectNaam"] ?>
    </title>
    <link href="/public/css/style.css" rel="stylesheet">
    <link href="/public/css/projecten.css" rel="stylesheet">
    <script src="/public/js/bewerk.js" defer></script>

    <?php include './components/bootstrap.html'; ?>
</head>

<body>

    <body>
        <div class="main vh-min-100">

            <header class="bg-dark">
                <h1 class="text-white text-center">Tycho van Opstal</h1>
                <h2 class="text-white text-center">Bewerk project</h2>
                <?php include './components/nav.html'; ?>
                <button class="btn-danger" onclick="yeet(<?php echo $selectedProject['ID']?>)" >Verwijder</button>
                <button class="btn-info"onclick="update('<?php echo $selectedProject['ID']?>')" >Opslaan</button>
            </header>

            <main>

            <h3 class="text-center m-3" id="projectNaam" contenteditable>
                    <?php echo $selectedProject['projectNaam'] ?>
                </h3>

                <div class="container">

                    <div class="row">

                        <div class="col-sm">
                            <?php


                            echo "<div class='row bg-dark p-2'>";
                            echo "<a class='col text-center text-white' href='" . $selectedProject['productLink'] . "' target='_blank'>Link naar project</a>";
                            echo "<a class='col text-center text-white' href='" . $selectedProject['github'] . "' target='_blank'>Link naar github</a>";
                            echo "</div>";

                            echo "<ul class='list-inline text-center' >";
                                foreach ($selectedProject['technieken'] as $techniek => $value) {
                                    echo "<li class='list-inline-item' >" . $value['techniek'] . "</li>";
                                }
                            echo "</ul>";

                            require("components/techniekSelectors.php");

                        echo "<p contenteditable id='omschrijving' >" . $selectedProject['omschrijving'] . "</p>";


                            ?>
                        </div>


                        <div class="col-sm">
                            <div class="container">
                                <div class="row">

                            <?php
                            foreach ($selectedProject['afbeeldingen'] as $img => $link) {
                                echo "<div class='col-sm-6'>";
                                echo "<img src='/public/img/projecten/" . $link['afbeelding'] . "' alt='project image' class='img-fluid'>";
                                echo "</div>";
                            }
                            ?>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </body>

</html>