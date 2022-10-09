<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tycho van Opstal</title>
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/projecten.css" rel="stylesheet">
    <script src="./js/projecten.js" defer></script>
</head>
<body>
    <header>
        <h1>Tycho van Opstal</h1>
        <h2>Software Developer</h2>
    </header>
    <?php include './components/nav.html'; ?>
    <main>
        <div class="container">
            <div class="projecten">
                <h3>Filter</h3>
                <div class="filter">
                    <button class="filterButton" id="project" onclick="filter('project')">alle</button>
                    <button class="filterButton" id="nodejs" onclick="filter('nodejs')">node.js</button>
                </div>
                <div class="projectIconen">
                    <div class="project nodejs sql plesk">
                        <a href="projecten.php?techniek=nodejs">
                            <img src="./img/node.png" width="90%" alt="node.js">
                            <p>
                                Komkommer.eu
                            </p>
                            <p>
                                Node.js | SQL | Plesk
                            </p>
                        </a>
                    </div>
                    <div class="project">
                        <a href="projecten.php?techniek=php">
                            <img src="./img/php.png" width="90%" alt="php">
                        </a>
                    </div>
                    <div class="project">
                        <a href="projecten.php?techniek=csharp">
                            <img src="./img/cSharp.png" width="90%" alt="c#">
                        </a>
                    </div>
                    <div class="project">
                        <a href="projecten.php?techniek=linux">
                            <img src="./img/tux.png" width="90%" alt="Linux">
                        </a>
                    </div>

                    <div class="project">
                        <a href="projecten.php?techniek=node">
                            <img src="./img/node.png" width="90%" alt="node.js">
                            <p>
                                Komkommer.eu
                            </p>
                        </a>
                    </div>
                    <div class="project">
                        <a href="projecten.php?techniek=php">
                            <img src="./img/php.png" width="90%" alt="php">
                        </a>
                    </div>
                    <div class="project">
                        <a href="projecten.php?techniek=csharp">
                            <img src="./img/cSharp.png" width="90%" alt="c#">
                        </a>
                    </div>
                    <div class="project">
                        <a href="projecten.php?techniek=linux">
                            <img src="./img/tux.png" width="90%" alt="Linux">
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
</body>
</html>