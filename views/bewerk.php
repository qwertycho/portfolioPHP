<!DOCTYPE html>
<html lang="nl">

<?php require("modules/fetch.php") ?>
<?php 

if (isset($_GET['id'])) {
    $selectedProject = getProject($_GET['id']);
} else {
    // header("Location: ./projecten.php");
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $selectedProject['omschrijving'] ?>">
    <meta name="keywords" content="Tycho van Opstal, projecten, portfolio, software developer">
    <meta name="author" content="Tycho van Opstal">

    <title>
        <?php echo $selectedProject["projectNaam"] ?>
    </title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/projecten.css" rel="stylesheet">

    <?php include './components/bootstrap.html'; ?>
</head>





<body>

    <body>
        <div class="main vh-min-100">

            <header class="bg-dark">
                <h1 class="text-white text-center">Tycho van Opstal</h1>
                <h2 class="text-white text-center">bewerken</h2>
                <a href="delete.php?id=<?php echo $selectedProject['ID']; ?>" class="btn btn-danger">Verwijderen</a>
                <a href="update.php?id=<?php echo $selectedProject['ID']; ?>" class="btn btn-warning">update</a>
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

                            echo "<ul class='list-inline text-center'>";
                                foreach ($selectedProject['technieken'] as $techniek => $value) {
                                    echo "<li class='list-inline-item' >" . $value . "</li>";
                                }
                            echo "</ul>";


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