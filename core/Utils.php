<?php

function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function redirect($url, $params = []) {
    header("Location: $url?" . http_build_query($params));
    exit();
}
?>