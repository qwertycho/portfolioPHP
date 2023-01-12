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

<?php require("./modules/technieken.php") ?>

<?php
foreach ($projecten as $project => $value) {
    if ($value['ID'] == $_GET['project']) {
        $selectedProject = $value;
    }
}
?>

<body>

    <body>
        <div class="main vh-min-100">

            <header class="bg-dark">
                <h1 class="text-white text-center">Tycho van Opstal</h1>
                <h2 class="text-white text-center">Software Developer</h2>
                <?php include './components/nav.html'; ?>
            </header>

            <main>

                <h3 class="text-center">
                    <?php echo $selectedProject['projectNaam'] ?>
                </h3>

                <div class="container">

                    <div class="row">

                        <div class="col-sm">
                            <?php


                            echo "<div class='links bg-dark p-2'>";
                            echo "<a class='link' href='" . $selectedProject['productLink'] . "' target='_blank'>Link naar project</a>";
                            echo "<a class='link' href='" . $selectedProject['github'] . "' target='_blank'>Link naar github</a>";
                            echo "</div>";


                                foreach ($selectedProject['technieken'] as $techniek => $value) {
                                    echo "<ul> <li>" . $value . "</li> </ul>";
                                }


                            echo "<p>" . $selectedProject['omschrijving'] . "</p>";


                            ?>
                        </div>


                        <div class="col-sm">
                            <div class="container">
                                <div class="row">

                            <?php
                            foreach ($selectedProject['images'] as $img => $link) {
                                echo "<div class='col-sm-6'>";
                                echo "<img src='./img/" . $link . "' alt='project image' class='img-fluid'>";
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