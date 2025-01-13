<?php

spl_autoload_register("controllers");
spl_autoload_register("models");
spl_autoload_register("helpers");

function controllers($class_name) {
    include __DIR__ . "/app/controllers/" . $class_name . ".php";
}
function models($class_name) {
    include __DIR__ . "/app/models/" . $class_name . ".php";
}
function helpers($class_name) {
    include __DIR__ . "/app/helpers/" . $class_name . ".php";
}

?>