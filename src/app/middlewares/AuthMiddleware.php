<?php

namespace App\middlewares;

use App\Repository\UserRepository;

class AuthMiddleware
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke()
    {
        if ($this->userIsLoggedIn()) {
            $_SESSION['user'] = $this->getUserData();
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
        $user = $this->userRepository->find($_SESSION['user_id']);

        if ($user) {
            return [
                'user_id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                'logged_in' => true,
            ];
        } else {
            return [];
        }
    }
}