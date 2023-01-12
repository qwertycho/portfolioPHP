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
<body>
    <header>
        <h1>Tycho van Opstal</h1>
        <h2>Admin</h2>
    </header>
    <?php include './components/nav.html'; ?>
    <main>
        <div class="container">
            <form class="projectForm" id="projectForm">
                <input type="text" name="projectTitel" id="projectTitel" placeholder="Project naam">

                <select name="techniekSelector" id="projectTechniek" class="techniekSelector">
                    <option value="geen">null</option>
                </select>
                <select name="techniekSelector" id="projectTechniek" class="techniekSelector">
                    <option value="geen">null</option>
                </select>
                <select name="techniekSelector" id="projectTechniek" class="techniekSelector">
                    <option value="geen">null</option>
                </select>


                <input type="text" name="projectLink" id="projectLink" placeholder="Project link">
                <input type="text" name="projectRepo" id="projectRepo" placeholder="Project repo link">
                <input type="text" name="projectImg" id="projectImg" placeholder="Project img">
                <input type="text" name="projectBeschrijving" id="projectOmschrijving" placeholder="Project beschrijving">
                <input type="date" name="projectDatum" id="projectDatum" placeholder="Project datum">
                <input type="date" name="projectEindDatum" id="projectEindDatum" placeholder="Project eind datum">
                <button type="submit" id="projectFormSubmit">Submit</button>     
            </form>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="hidden" name="action" value="techniek">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="text" name="techniek"  placeholder="techniek">
                <input type="submit" value="Upload Image" name="submit">

        </div>
    </main>
</body>
</html>