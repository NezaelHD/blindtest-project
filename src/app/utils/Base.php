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
