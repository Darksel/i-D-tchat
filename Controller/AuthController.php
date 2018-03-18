<?php

require_once 'Core/Controller.php';
require_once 'Model/User.php';
require_once 'Service/AuthService.php';

/**
 * Class AuthController
 * user authentication
 *
 * @author Joseph Selven
 */
class AuthController extends Controller
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

        $errorMessage = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errorMessage = 'Connexion refusée. Pseudo ou mot de passe incorrect';
            $name = trim($this->params['name']);
            $password = trim($this->params['password']);

            $user = $this->userModel->getByName($name);

            if ($user instanceof User) {

                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['userId'] = $user->getId();
                    header("Location: /");
                    exit();
                }
            }
        }

        $params = [
            'errorMessage' => $errorMessage
        ];

        $this->generateView('auth/index.php', $params);
    }

    /**
     * disconnect
     *
     * @return void
     */
    public function disconnect()
    {
        unset($_SESSION['userId']);
        $this->redirectHomepage();
    }
}
