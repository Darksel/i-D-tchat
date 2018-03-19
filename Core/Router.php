<?php

/**
 * Class Router
 * Check url and call the controller and the action method
 * the url must be like this /index.php?controller=home&action=index
 *
 * @author Joseph Selven
 */
class Router
{
    protected $params = [];

    public function __construct()
    {
        $this->params = array_merge($_GET, $_POST);
    }

    /**
     * Creating the controller and running the action method
     *
     * @return void
     */
    public function dispatch()
    {
        try {
            $controller = $this->getController();
            $this->callAction($controller);
        } catch (Exception $e) {
            $this->displayErrorPage($e);
        }
    }

    /**
     * Get controller
     *
     * @return Controller
     * @throws Exception
     */
    private function getController()
    {
        $controller = 'Home';

        if (isset($this->params['controller']) && !empty($this->params['controller'])) {
            $controller = ucfirst(strtolower($this->params['controller']));
        }

        $controllerClass = $controller . 'Controller';
        $controllerFile = 'Controller/' . $controllerClass . '.php';

        if (file_exists($controllerFile)) {
            require($controllerFile);
            $controller = new $controllerClass();
            return $controller;
        }

        throw new Exception('Impossible de charger la classe ' . $controllerClass);
    }

    /**
     * Call the action method
     *
     * @param Controller $controller
     *
     * @return void
     * @throws Exception
     */
    private function callAction(Controller $controller)
    {
        $action = 'index';

        if (isset($this->params['action']) && !empty($this->params['action'])) {
            $action = strtolower($this->params['action']);
        }

        if (method_exists($controller, $action)) {
            $controller->{$action}();
            return;
        }

        throw new Exception('Impossible d\'invoqué la méthode ' . $action);
    }

    private function displayErrorPage(Exception $e)
    {
        require_once('View/error.php');
    }
}
