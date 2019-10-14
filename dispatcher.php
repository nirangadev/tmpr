<?php

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';
        try{
            if (!file_exists($file)){
                throw new Exception ("404 - Not Found");
            } else{
                require($file);
                $controller = new $name();
                return $controller;
            }
        } catch(exception $e){
                http_response_code(404);

                echo $e->getMessage();
                die();        
        }
    }

}
?>