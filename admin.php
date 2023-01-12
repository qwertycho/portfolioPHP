<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/projecten.css" rel="stylesheet">
    <script src="./js/projecten.js" defer></script>

    <?php include './components/bootstrap.html'; ?>
</head>

<?php require("modules/technieken.php") ?>


<header class="bg-dark">
    <h1 class="text-white text-center">Tycho van Opstal</h1>
    <h2 class="text-white text-center">Admin</h2>
    <?php include './components/nav.html'; ?>
</header>

<main>
    <div class="container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="action" value="project">
            <input class="form-control" type="text" name="projectNaam" placeholder="Project naam">

            <select class="form-control" name="technieken[]" id="projectTechniek" class="techniekSelector">
                <?php
                echo "<option value='null'>techniek 1</option>";
                foreach ($technieken as $val => $value) {
                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                }
                ?>
            </select>
            <select class="form-control" name="technieken[]" id="projectTechniek" class="techniekSelector">
                <?php
                echo "<option value='null'>techniek 2</option>";
                foreach ($technieken as $val => $value) {
                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                }
                ?>
            </select>
            <select class="form-control" name="technieken[]" id="projectTechniek" class="techniekSelector">
                <?php
                echo "<option value='null'>techniek 3</option>";
                foreach ($technieken as $val => $value) {
                    echo "<option value='$value[techniek]'>$value[techniek]</option>";
                }
                ?>
            </select>


            <input class="form-control" type="text" name="productLink" placeholder="Product link">
            <input class="form-control" type="text" name="github" placeholder="Project github link">
            <input class="form-control" type="text" name="omschrijving" placeholder="Project omschrijving">
            <input class="form-control" type="date" name="projectDatum" placeholder="Project datum">
            <input class="form-control" type="date" name="projectEindDatum" placeholder="Project eind datum">
            <input class="form-control" type="file" multiple accept="image/" name="afbeeldingen[]">

            <button class="form-control" type="submit" id="projectFormSubmit">Submit</button>

        </form>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="action" value="techniek">
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
            <input class="form-control" type="text" name="techniek" placeholder="techniek">
            <input class="form-control" type="submit" value="Upload Image" name="submit">
    </div>
    
</main>
</body>

</html>