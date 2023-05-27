<?php

namespace App\Middlewares;

use App\Repository\UserRepository;

class AuthMiddleware
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function handle()
    {
        if ($this->userIsLoggedIn()) {
            $_SESSION['user'] = $this->getUserData();
            $_SESSION['logged_in'] = true;
        } else {
            unset($_SESSION['user']);
        }
    }

    private function userIsLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    private function getUserData()
    {
        $user = $this->userRepository->find($_SESSION['user']['id']);

        if ($user) {
            return $user->toArray();
        } else {
            return [];
        }
    }
}