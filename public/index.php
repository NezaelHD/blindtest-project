<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

session_start();
// Entrypoint of every requests in order to make the good treatment and show the wished page
Router::load(APPROOT . '/app/routes.php')->direct(getUri(), getMethod());