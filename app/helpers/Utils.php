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

function sanitize($data) {
    if(empty($data)) {
        return;
    }

    return trim(htmlspecialchars($data));
}

function isStudent(){
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
        return true;
    } else {
        return false;
    }
}

function isTeacher(){
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
        return true;
    } else {
        return false;
    }
}

function isAdmin(){
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}


?>