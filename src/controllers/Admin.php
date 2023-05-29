<?php
namespace Controllers;

use App\Repository\UserRepository;

class Admin extends Controller
{
    public function Index() {
        $userRepo = new UserRepository();
        $this->view('admin', [
            'users' => $userRepo->findAll(),
        ]);
    }
}