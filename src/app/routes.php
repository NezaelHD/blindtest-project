<?php
/**
 * All routes must be registered here
 */
    $router->get('', 'Home@Index');
    $router->get('404', 'Index@error404');
    $router->get('register', 'Auth@registerIndex');
    $router->get('login', 'Auth@loginIndex');
    $router->get('logout', 'Auth@logout');
    $router->get('admin', 'Admin@Index', ['admin']);
    $router->get('user/{id}', 'User@find');

    $router->post('register', 'Auth@register');
    $router->post('login', 'Auth@login');
    $router->post('user', 'User@create');

    $router->delete('user/{id}', 'User@delete');

    $router->put('user/{id}', 'User@edit');

