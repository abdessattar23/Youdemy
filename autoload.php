<?php

spl_autoload_register("controllers");
spl_autoload_register("models");
spl_autoload_register("helpers");
spl_autoload_register("core");

function controllers($class_name) {
    if(file_exists(__DIR__ . "/app/controllers/" . $class_name . ".php")) {
        include __DIR__ . "/app/controllers/" . $class_name . ".php";
        return;
    }
}
function models($class_name) {
    if(file_exists(__DIR__ . "/app/models/" . $class_name . ".php")) {
        include __DIR__ . "/app/models/" . $class_name . ".php";
        return;
    }
}
function helpers($class_name) {
    if(file_exists(__DIR__ . "/app/helpers/" . $class_name . ".php")) {
        include __DIR__ . "/app/helpers/" . $class_name . ".php";
        return;
    }
}

function core($class_name) {
    if(file_exists(__DIR__ . "/core/" . $class_name . ".php")) {
        include __DIR__ . "/core/" . $class_name . ".php";
        return;
    }
}

?>