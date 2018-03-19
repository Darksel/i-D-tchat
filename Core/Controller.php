<?php

/**
 * Abstract Class Controller
 *
 * @author Joseph Selven
 */
abstract class Controller
{
    protected $params = [];

    public function __construct()
    {
        $this->params = array_merge($_GET, $_POST);
    }

    public abstract function index();

    /**
     * get view and display it
     *
     * @param $templateFile
     * @param $params
     *
     * @return void
     */
    protected function generateView($templateFile, $params)
    {
        $view = $this->getView($templateFile, $params);

        echo $view;
    }

    /**
     * get view
     *
     * @param $templateFile
     * @param $params
     *
     * @return void
     */
    protected function getView($templateFile, $params)
    {
        extract($params);

        ob_start();
        include('View/' . $templateFile);
        $view = ob_get_contents();
        ob_end_clean();

        return $view;
    }

    /**
     * Check if is Post method
     *
     * @return bool
     */
    protected function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }

        return false;
    }

    /**
     * Check if is ajax request
     *
     * @return bool
     */
    protected function isAjax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;
    }

    /**
     * redirect in the homepage
     *
     * @return void
     */
    protected function redirectHomepage()
    {
        header("Location: /");
        exit();
    }
}
