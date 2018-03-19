<?php

require_once 'Core/Controller.php';
require_once 'Model/Message.php';
require_once 'Service/AuthService.php';

/**
 * Class HomeController
 * homepage where tchat is display
 *
 * @author Joseph Selven
 */
class HomeController extends Controller
{
    protected $authService;
    protected $messageModel;

    public function __construct()
    {
        parent::__construct();

        $this->authService = new AuthService();
        $this->messageModel = new Message();
    }

    public function index()
    {
        $messages = $this->messageModel->getAll(50);

        $params = [
            'authService' => $this->authService,
            'messages' => $messages,
        ];

        $this->generateView('/home/index.php', $params);
    }
}
