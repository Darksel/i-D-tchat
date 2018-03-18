<?php

require_once 'Core/Controller.php';

class HomeController extends Controller
{
    public function index()
    {
        $params = [
          'title' => 'Bienvenue chez I@D tchat'
        ];

        $this->generateView('/home/index.php', $params);
    }
}
