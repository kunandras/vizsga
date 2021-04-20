<?php

class View
{
    const DEFAULT_VIEW = '__default__';

    private array $viewContents = array();
    private array $variables = array();
    private string $currentView = self::DEFAULT_VIEW;
    private string $layout = 'base';

    /**
     * View constructor.
     * Ha nincs munkamenet státusz akkor indítunk egyet
     * Elindítjuk a kimeneti pufferelést
     */
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ob_start();
    }

    /**
     * A nézet tartalom nulladik indexére berakjuk a jelenlegi nézetet és vissza adjuk a kimeneti buffer tartalmát
     * Töröljük a kimeneti buffert
     */
    public function saveCurrentView()
    {
        $this->viewContents[$this->currentView] .= ob_get_contents();
        ob_clean();
    }

    /**
     * Jelenlegi nézet változó megkapja a $name változó nevét és a nézet mentésbe rakjuk
     * @param string $name Megkapja megváltoztatott nézet nevét
     */
    public function moveToView(string $name)
    {
        $this->saveCurrentView();
        $this->currentView = $name;
    }

    /**
     * Alapértelmezett nézet beállítása
     */
    public function moveToDefaultView()
    {
        $this->moveToView(self::DEFAULT_VIEW);
    }

    /**
     * Ha nem létezik nézet tartalomban $fragment változó akkor visszatérünk $default-al
     * Különben belerakjuk a tömbbe
     * @param string $fragment
     * @param string $default
     * @return mixed|string
     */
    public function getView(string $fragment, string $default = '')
    {
        if (!isset($this->viewContents[$fragment])) {
            return $default;
        }
        return $this->viewContents[$fragment];
    }

    public function setVariable($varname, $value, $falsh = false)
    {
        $this->variables[$varname] = $value;
        if ($falsh === true) {
            if (!isset($_SESSION['view_flash'])) {
                $_SESSION['view_flash'][$varname] = $value;
                print_r($_SESSION['view_flash']);
            } else {
                $_SESSION['view_flash'][$varname] = $value;
            }
        }
    }

    public function getVariable($varname, $default = null)
    {
        if (!isset($this->variables[$varname])) {
            if (isset($_SESSION['view_flash']) && isset($_SESSION['view_flash'][$varname])) {
                $store = $_SESSION['view_flash'][$varname];
                unset($_SESSION['view_flash'][$varname]);
                return $store;
            }
            return $default;
        }
        return $this->variables[$varname];
    }

    public function setFlash($flashMessage)
    {
        $this->setVariable('__flashmessage__', $flashMessage, true);
    }

    public function addFlash()
    {
        return $this->getVariable('__flashmessage__', '');
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $controller
     * @param string $view
     */
    public function render(string $controller, string $view)
    {
        include __DIR__ . '../../views/' . $controller . '/' . $view . '.php';
        $this->renderLayout();
    }

    /**
     * @param string $controller
     * @param string $view
     * @param string $params
     */
    public function redirect(string $controller, string $view, string $params)
    {
        header('Location: ' . URLROOT.$controller . '/' . $view . '/' . (isset($params) ? "$params" : ''));
        $this->renderLayout();
    }

    public function renderLayout()
    {
        $this->moveToView('layout');
        include __DIR__ . '../../views/layouts/' . $this->layout . '.php';
        ob_flush();
    }

    private static $view_singleton = 'empty';

    public static function getInstance()
    {
        if (self::$view_singleton === 'empty') {
            self::$view_singleton = new View();
        }
        return self::$view_singleton;
    }
}

View::getInstance();