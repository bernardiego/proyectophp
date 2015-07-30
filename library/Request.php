<?php

class Request {
    protected $action;
    protected $controller;
    protected $defaultAction = 'index';
    protected $defaultController = 'home';
    protected $params = array();
    protected $url;

    /*
     * Constructor. It receive in the parameter $url, a GET string.
     * Ex: /home, /our-team/about, /contacto/ciudad.
     */
    public function __construct($url) {
        $this->url = $url;
        $segments = explode('/', $this->getUrl()); // Ej: segments = ['our-team','about', ...].

        $this->resolveController($segments);
        $this->resolveAction($segments);
        $this->resolveParams($segments);
    }

    /*
     * Call the correspondent ActionMethod of the correspondent Controller.
     * Ex: if $url = /contacto/ciudad/mi/locacion, then executes ciudadAction
     *     of ContactoController with params = ['mi','locacion'].
     */
    public function execute() {
        $controllerClassName = $this->getControllerClassName();
        $controllerFileName  = $this->getControllerFileName();
        $actionMethodName    = $this->getActionMethodName();
        $params              = $this->getParams();

        if (!file_exists($controllerFileName)) {
            exit('Controlador no existe');
        }

        require $controllerFileName;
        $controller = new $controllerClassName();

        call_user_func_array([$controller, $actionMethodName], $params);
    }

    /*
     * Returns the action name.
     */
    public function getAction() {
        return $this->action;
    }

    /*
     * Using Inflector (See /library/Inflector),
     * this function generate camel-cased action names.
     * Ex: if $url = '/contacto/ciudad', then it will return 'ciudadAction'.
     */
    public function getActionMethodName() {
        return Inflector::lowerCamel($this->getAction()) . 'Action';
    }

    /*
     * Returns the controller name.
     */
    public function getController() {
        return $this->controller;
    }

    /*
     * Using Inflector (See /library/Inflector),
     * this function generate camel-cased controllers names.
     * Ex: if $url = '/contacto/ciudad', then it will return 'ContactoController'.
     */
    public function getControllerClassName() {
        return Inflector::camel($this->getController()) . 'Controller';
    }

    /*
     * Return the file path of the controller.
     */
    public function getControllerFileName() {
        return 'controllers/' . $this->getControllerClassName() . '.php';
    }

    /*
     * Returns the parameters of the url.
     */
    public function getParams() {
        return $this->params;
    }

    /*
     * Returns the url that came though GET.
     */
    public function getUrl() {
        return $this->url;
    }

    /*
    * This function obtain only the Action part of the url.
    * Ex: if segments = ['our-team','about', ..], then $this->action = 'about'.
    */
    public function resolveAction(&$segments) {
        $this->action = array_shift($segments);

        if(empty($this->action)) {
            $this->action = $this->defaultAction;
        }
    }

    /*
     * This function obtain only the controller part of the url.
     * Ex: if segments = ['our-team','about', ..], then $this->controller = 'our-team'.
     */
    public function resolveController(&$segments) {
        $this->controller = array_shift($segments);

        if(empty($this->controller)) {
            $this->controller = $this->defaultController;
        }
    }

    /*
    * This function obtain only the params part of the url.
    * Ex: if segments = ['our-team','about', ..], then $this->params = 'about'.
    */
    public function resolveParams(&$segments) {
        $this->params = $segments;
    }
}
