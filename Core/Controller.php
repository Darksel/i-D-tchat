<?php

/**
 * Abstract Class Controller
 *
 * @author Joseph Selven
 */
abstract class Controller
{
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
}
