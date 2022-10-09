<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Tycho van Opstal</h1>
        <h2>Software Developer</h2>
    </header>
    <?php include './components/nav.html'; ?>
    <main>
        <div class="container">
            <div class="technieken">
                <h3>Back-end Developer</h3>
                <div class="techniekIconen">
                    <div class="techniek">
                        <a href="projecten.php?techniek=nodejs">
                            <img src="./img/node.png" width="90%" alt="node.js">
                        </a>
                    </div>
                    <div class="techniek">
                        <a href="projecten.php?techniek=php">
                            <img src="./img/php.png" width="90%" alt="php">
                        </a>
                    </div>
                    <div class="techniek">
                        <a href="projecten.php?techniek=csharp">
                            <img src="./img/cSharp.png" width="90%" alt="c#">
                        </a>
                    </div>
                    <div class="techniek">
                        <a href="projecten.php?techniek=linux">
                            <img src="./img/tux.png" width="90%" alt="Linux">
                        </a>
                    </div>
                </div>
            </div>
            <div class="about">
                <h3>Over Mij</h3>
                <p>
                    Ik ben Tycho van Opstal, een student software developer aan het Grafisch Lyceum Rotterdam! xxxxxxxxxx
                    Mijn passie voor technologie zorgt ervoor dat geen uitdaging te groot is.
                    In mijn vrije tijd ben ik (meestal) bezig met allerlei projecten, zoals het ontwikkelen van websites en applicaties.
                    Maar ook het beheren van mijn eigen homelab waar ik linux servers draai, vooral voor het testen van mijn eigen projecten.
                    <br>
                    <br>
                    Als ik niet bezig ben met projecten houd ik mij bezig met (vr) games, 3d-printen of een van mijn vele andere hobbies.
                </p>
                <img class="tycho" src="./img/tycho.png" width="90%" alt="Tycho">
            </div>
        </div>
    </main>
</body>
</html>