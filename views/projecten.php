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
    <link rel="icon" type="image/png" sizes="32x32" href="/public/img/favicon.png">
    <link href="/public/css/style.css" rel="stylesheet">
    <link href="/public/css/projecten.css" rel="stylesheet">
    <script src="/public/js/projecten.js" defer></script>

    <?php include './components/bootstrap.html'; ?>
</head>

<body>
<div class="main vh-min-100">

<?php global $projecten; ?>
<?php global $technieken; ?>

    <header class="bg-dark">
        <h1 class="text-white text-center">Tycho van Opstal</h1>
        <h2 class="text-white text-center">Software Developer</h2>
        <?php include './components/nav.html'; ?>
    </header>

    <main>
        <div>
        <h3 class="text-center m-3 text-white">
                Filter
            </h3>
            
            <div class="container">
                <div class="row text-center">
                    <div class="col-">

                        <select onchange="setFilter(this.value)" >
                            <option value="all">Alle technieken</option>
                            <?php
                                foreach ($technieken as $value) {
                                    echo "<option value='" . $value['techniek'] ."'> " . $value['techniek'] . "</option>";
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
                            
                            foreach ($value['technieken'] as $techniek) {
                                echo $techniek['techniek'] . " ";
                            }
                                echo " all'>";

                                echo "<a class='align-middle text-white' href='project/" .  $value['ID'] . "'>";
                                    echo "<div class='p-2 inner-project rounded'>";
                                        echo "<img class='img-fluid ' src='/public/img/projecten/" . $value['thumbnail'] . "' alt='" . $value['thumbnail'] . "'>";
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
</div>
</body>

</html>