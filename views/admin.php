<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    
    <title>Admin pagina</title>
    <link href="/public/css/style.css" rel="stylesheet">
    <link href="/public/css/projecten.css" rel="stylesheet">

    <?php include './components/bootstrap.html'; ?>
</head>

<body>
<div class="main vh-min-100">

<?php global $technieken; ?>

<header class="bg-dark">
    <h1 class="text-white text-center">Tycho van Opstal</h1>
    <h2 class="text-white text-center">Admin</h2>
    <?php include './components/nav.html'; ?>
</header>

<main>

        <h3 class="text-center m-3">
            Adminpagina
        </h3>

    <div class="container">
        <form action="/admin/newProject" method="post" enctype="multipart/form-data" class="col-sm">
            <input class="form-control" type="hidden" name="action" value="project" >
            <input class="form-control" type="text" name="projectNaam" placeholder="Project naam" required>
            <label>thumbnail</label><input class="form-control" type="file" accept="image/" name="thumbnail" required>

            <select class="form-control" name="technieken[]" id="projectTechniek" class="techniekSelector" required>
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


            <input class="form-control" type="text" name="productLink" placeholder="Product link" required>
            <input class="form-control" type="text" name="github" placeholder="github link" required>
            <textarea class="form-control" type="text" name="omschrijving" required placeholder="omschrijving"></textarea>
            <label>project foto's</label><input class="form-control" type="file" multiple accept="image/" name="afbeeldingen[]" required>

            <button class="form-control" type="submit" id="projectFormSubmit">Submit</button>

        </form>

        <div class="col-sm">

        <form action="/admin/newTechniek" method="post" enctype="multipart/form-data">
            <input class="form-control" type="hidden" name="action" value="techniek">
            <input class="form-control" type="file" name="afbeelding" >
            <input class="form-control" type="text" name="techniek" placeholder="techniek" required>
            <input class="form-control" type="submit" value="Upload Image" name="submit">
        </form>

        <div>
                <h3 class=""> 
                    technieken
                </h3>

                <?php  
                    foreach ($technieken as $val => $value) {
                        echo "<form action='/admin/updateTechniek' method='post' enctype='multipart/form-data'>";
                            echo "<input class='form-control' type='hidden' name='action' value='updateTechniek'>";
                            echo "<input class='form-control' type='hidden' name='id' value='$value[techniek]'>";
                            echo "<input type='hidden' name='afbeeldingLink' value='$value[thumbnail]'>";
                            echo "<input class='form-control' type='text' name='techniek' value='$value[techniek]'>";
                            echo "<input class='form-control' type='file' name='afbeelding' >";
                            echo "<input class='form-control' type='submit' value='Update' name='submit'>";
                        echo "</form>";
                    }
                ?>

        </div>

    </div>

    </div>
    
</main>
</div>
</body>

</html>