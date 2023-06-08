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
    $router->get('users', 'User@findAll');
    $router->get('blindtests', 'Blindtest@findAll');
    $router->get('blindtest/{id}', 'Blindtest@find');
    $router->get('resetPassword', 'Auth@resetPassword');
    $router->get('createNewPassword', 'Auth@createNewPassword');

    $router->post('register', 'Auth@register');
    $router->post('login', 'Auth@login');
    $router->post('user', 'User@create');
    $router->post('blindtest', 'Blindtest@create');
    $router->post('resetPassword', 'Auth@resetPassword');
    $router->post('createNewPassword', 'Auth@createNewPasswordTreatment');

    $router->delete('user/{id}', 'User@delete');
    $router->delete('blindtest/{id}', 'Blindtest@delete');

    $router->put('user/{id}', 'User@edit');
    $router->put('blindtest/{id}', 'Blindtest@edit');
