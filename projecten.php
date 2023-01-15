<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Neem contact op met de software developer Tycho van Opstal">
    <meta name="keywords" content="Tycho van Opstal, projecten, portfolio, software developer">
    <meta name="author" content="Tycho van Opstal">

    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/projecten.css" rel="stylesheet">
    <script src="./js/projecten.js" defer></script>

    <?php include './components/bootstrap.html'; ?>
</head>

<?php require("modules/fetch.php") ?>
<?php $projecten = getProjecten(); ?>
<?php $technieken = getTechnieken(); ?>


<body>

    <header class="bg-dark">
        <h1 class="text-white text-center">Tycho van Opstal</h1>
        <h2 class="text-white text-center">Software Developer</h2>
        <?php include './components/nav.html'; ?>
    </header>

    <main>
        <div>
            <h3 class="text-center">
                Filter
            </h3>
            
            <div class="container">
                <div class="row text-center">
                    <div class="col-">
                        <button onclick="urlFilter('techniek=all')">
                            Alle technieken
                        </button>

                        

                        <select onchange="setFilter(this.value)" >
                            <option value="all">Alle technieken</option>
                            <?php
                                foreach ($technieken as $val => $value) {
                                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                                }
                            ?>
                        </select>

                    </div>
                </div>
            </div>

            <div class="container">

                <div class="row">
                    
                    <?php

                        foreach ($projecten as $project => $value) {
                            echo "<div class='col-sm-4  col-6 text-center p-2 project' techniek='"  ;
                            
                            foreach ($value['technieken'] as $techniek => $tech) {
                                echo $tech . " ";
                            }

                            echo " all'>";

                            echo "<a class='align-middle' href='project.php?project=" . $value['ID'] . "'>";
                            echo "<div class='inner-project'>";
                            echo "<img class='img-fluid w-50' src='./img/" . $value['techniekImg'] . "' alt='" . $value['techniekImg'] . "'>";
                            echo "<p class='project-titel'> " . $value['projectNaam'] . "</p>";
                            echo "</div>";
                            echo "</a>";
                            echo "</div>";
                        }
                    ?>
                    

                </div>

            </div>
        </div>
    </main>

</body>

</html>