<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function sanitizeHTML($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//for verify auth
function isAuth() : void{
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin() : void{
    if(!isset($_SESSION['Admin'])){
        header('Location: /');
    }else{
        if(!$_SESSION['Admin']){
            header('Location: /');
        }
    }
}