<?php

/**
 * Simplified methods to var dump and die.
 * @param mixed $toDd
 */
function dd($toDd){
    var_dump($toDd);
    die();
}

/**
 * Simply return the request array
 * @return array
 */
function getRequest() {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

    if($contentType === 'application/json') {
        return json_decode(file_get_contents("php://input"), true);
    }
    return $_REQUEST;
}

/**
 * Hash the password passed in param with BCRYPT algorithm.
 *
 * @param string $password
 * @return false|string
 */
function hashPassword($password): string|false {
    return password_hash($password, PASSWORD_BCRYPT);
}

/**
 * Get the base URL with the protocol used by the server.
 * @return string
 */
function getUrl(): string {
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $url = 'https://'.$_SERVER['SERVER_NAME'];
    }
    else {
        $url = 'http://'.$_SERVER['SERVER_NAME'];
    }
    return $url;
}

/**
 *
 * Redirect to the route specified in param.
 *
 * @param string $route
 */
function redirect(string $route): void {
    header("location:".getUrl().$route);
}

/**
 * Récupère l'utilisateur connecté si il y en à un retourne false sinon.
 * @return false|array
 */
function getConnectedUser(): array|false{
    if(isset($_SESSION['logged_in'])){
        return $_SESSION['user'];
    }
    else{
        return false;
    }
}
