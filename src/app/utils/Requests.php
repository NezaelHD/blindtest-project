<?php
/**
 * Get URI path.
 * Return a string.
 */
function getUri()
{
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    return $uri;
}
/**
 * Get request method.
 * Return a string.
 */
function getMethod()
{
    $method = $_SERVER['REQUEST_METHOD'];
    return $method;
}

function getPostRequest(){
    return array_map(function($value) {
        return htmlspecialchars(trim($value));
    }, $_POST);
}