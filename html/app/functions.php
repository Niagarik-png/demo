<?php

function template ($name, $vars = []) {
    extract($vars);
    ob_start();
    require __DIR__ . "/templates/$name.php";
    return ob_get_clean();
}

function redirect ($url) {
    header("Location: $url");
}
