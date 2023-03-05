<?php

namespace Controllers;

/*
* Base Controller
* Loads the models and views
*/

class Controller
{
    /**
     * @param string $model
     * @return $model
     *
     * Instantiate a model
     */
    public function model(string $model)
    {
        require_once '../models/' . $model . '.php';
        require_once __NAMESPACE__ . '\\' . $model;
        return new $model;
    }

    /**
     * @param string $view
     * @param array $data
     * @return void
     *
     * Loads a view file
     */
    public function view(string $view, array $data = []): void
    {
        if (file_exists(APPROOT . '/views/' . $view . '.php')) {
            require_once APPROOT . '/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}