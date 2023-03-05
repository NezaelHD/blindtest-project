<?php
namespace Controllers;

class Home extends Controller
{

    public function Index() {
        $data = [
          'title' => 'Are you blinded ?'
        ];

        $this->view('home', $data);
    }
}