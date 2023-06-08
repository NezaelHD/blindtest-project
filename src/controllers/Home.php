<?php

namespace Controllers;

use App\Repository\BlindtestRepository;
use App\Repository\UserRepository;

class Home extends Controller
{

    public function Index()
    {
        $blindtestRepo = new BlindtestRepository();
        $userRepo = new UserRepository();
        $tableUserBlindtest = [];
        foreach ($blindtestRepo->findAll() as $blindtest) {
            $tableUserBlindtest[] = ['blindtest' => $blindtest, 'author' => $userRepo->find($blindtest->getAuthor())];
        }
        $data = [
            'tableUserBlindtest' => $tableUserBlindtest,
            'title' => 'Are you blinded ?',
        ];

        $this->view('home', $data);
    }
}