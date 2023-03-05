<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Entrypoint of every requests in order to make the good treatment and show the wished page
Router::load(APPROOT . '/app/routes.php')->direct(getUri(), getMethod());