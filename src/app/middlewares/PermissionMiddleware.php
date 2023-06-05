<?php

namespace App\Middlewares;

class PermissionMiddleware
{
    public function handle(array $permissions)
    {
        $user = getConnectedUser();
        if (in_array('auth', $permissions)) {
            if (!$user) {
                redirect('/login');
                return;
            }
        }

        if (in_array('admin', $permissions)) {
            if ($user && !$user['isAdmin']) {
                redirect('/');
                return;
            }
        }
    }
}