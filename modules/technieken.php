<?php

$json = file_get_contents('./projecten.json');
$json = json_decode($json, true);

$technieken = $json['technieken'];

$projecten = $json['projecten'];