<?php

class Controller
{
    /**
     * @param $view
     * @param array $datas
     */
    public function view($view, $datas = array())
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('Nem létező nézet.');
        }
    }
}