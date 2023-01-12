<?php

require("modules/fetch.php");

$json = file_get_contents('./projecten.json');
$json = json_decode($json, true);

$technieken = getTechnieken();

$projecten = getProjecten();