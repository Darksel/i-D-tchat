<?php

require_once 'Core/Controller.php';
require_once 'Model/User.php';
require_once 'Service/AuthService.php';

/**
 * Class RegisterController
 * checking and creating account
 *
 * @author Joseph Selven
 */
class RegisterController extends Controller
{
    protected $authService;
    protected $userModel;

    public function __construct()
    {
        parent::__construct();

        $this->authService = new AuthService();
        $this->userModel = new User();
    }

    public function index()
    {
        if ($this->authService->getIsAuth() === true) {
            $this->redirectHomepage();
        }

        $errorMessages = [];

        if ($this->isPost()) {

            $name = trim($this->params['name']);
            $password = trim($this->params['password']);

            $errorMessages = $this->registerValidator($name, $password);

            if (empty($errorMessages)) {
                $userId = $this->userModel->save($name, $password);
                $_SESSION['userId'] = $userId;
                $this->redirectHomepage();
            }

        }

        $params = [
            'errorMessages' => $errorMessages
        ];

        $this->generateView('register/index.php', $params);
    }

    /**
     * Validator for user register
     *
     * @param $name
     * @param $password
     *
     * @return array
     */
    private function registerValidator($name, $password)
    {
        $errorMessages = [];

        $this->nameValidator($name, $errorMessages);
        $this->passwordValidator($password,$errorMessages);

        return $errorMessages;
    }

    /**
     * Validator for name user
     *
     * @param $name
     * @param $errorMessages
     *
     * @return void
     */
    private function nameValidator($name, &$errorMessages)
    {
        if (empty($name)) {
            $errorMessages[] = 'Votre <b>pseudo</b> ne dois pas être vide.';
        }

        if (strlen($name) < 2 || strlen($name) > 10) {
            $errorMessages[] = 'Votre <b>pseudo</b> doit contenir entre 2 et 10 caractères.';
        }

        if (!preg_match('#^[a-z0-9_-]+$#i', $name)) {
            $errorMessages[] = 'Votre <b>pseudo</b> ne peut contenir que des lettres, des chiffres ou les caractères spéciaux suivant : _-';
        }

        if ($this->userModel->checkIfNameAlreadyExist($name)) {
            $errorMessages[] = 'Votre <b>pseudo</b> est déjà utilisé';
        };
    }

    /**
     * Validator for password user
     *
     * @param $password
     * @param $errorMessages
     *
     * @return void
     */
    private function passwordValidator($password, &$errorMessages)
    {
        if (empty($password)) {
            $errorMessages[] = 'Votre <b>mot de passe</b> ne dois pas être vide.';
        }

        if (strlen($password) < 5) {
            $errorMessages[] = 'Votre <b>mot de passe</b> doit contenir au moins 5 caractères.';
        }
    }
}
