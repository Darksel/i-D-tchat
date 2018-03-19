<?php

require_once 'Core/Controller.php';
require_once 'Model/Message.php';
require_once 'Service/AuthService.php';

class MessageController extends Controller
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
        // TODO
    }

    public function post()
    {
        if ($this->authService->getIsAuth() && $this->isAjax()) {
            header('Content-Type: application/json');
            $content = trim($this->params['content']);

            if (!empty($content)) {

                $this->messageModel->save($this->authService->getUser()->getId(), $content);

                $messages = $this->messageModel->getAll(50);
                $params = [
                    'authService' => $this->authService,
                    'messages' => $messages,
                ];

                echo json_encode([
                    'status' => true,
                    'view' => $this->getView('message/messages.php', $params)
                ]);

                exit();
            }

            echo json_encode([
                'status' => false
            ]);

            exit();
        }

        $this->redirectHomepage();
    }

    public function refresh()
    {
        if ($this->isAjax()) {
            header('Content-Type: application/json');

            $messages = $this->messageModel->getAll();
            $params = [
                'authService' => $this->authService,
                'messages' => $messages,
            ];

            echo json_encode([
                'status' => true,
                'view' => $this->getView('message/messages.php', $params)
            ]);

            exit();
        }

        $this->redirectHomepage();
    }
}
