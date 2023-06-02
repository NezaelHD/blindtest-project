<?php
namespace Controllers;

use App\Repository\BlindtestRepository;
use App\Repository\BlindtestSongsRepository;
use App\Repository\UserRepository;

class Admin extends Controller
{
    public function Index() {
        $userRepo = new UserRepository();
        $blindtestRepo = new BlindtestRepository();
        $this->view('admin', [
            'users' => $userRepo->findAll(),
            'blindtests' => $blindtestRepo->findAll(),
        ]);
    }
}