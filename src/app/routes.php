<?php
/**
 * All routes must be registered here
 */
    $router->get('', 'Home@Index');
    $router->get('404', 'Index@error404');
    $router->get('register', 'Auth@registerIndex');
    $router->get('login.css', 'Auth@loginIndex');
    $router->get('logout', 'Auth@logout');
    $router->get('admin', 'Admin@Index', ['admin']);
    $router->get('user/{id}', 'User@find');
    $router->get('users', 'User@findAll');
    $router->get('blindtests', 'Blindtest@findAll');
    $router->get('blindtest/{id}', 'Blindtest@find');


    $router->post('register', 'Auth@register');
    $router->post('login.css', 'Auth@login.css');
    $router->post('user', 'User@create');
    $router->post('blindtest', 'Blindtest@create');

    $router->delete('user/{id}', 'User@delete');
    $router->delete('blindtest/{id}', 'Blindtest@delete');

    $router->put('user/{id}', 'User@edit');
    $router->put('blindtest/{id}', 'Blindtest@edit');
