<?php

    function add($var, $value){
        $this->args[$var] = $value;
    }

    function controller ($name) {
        if (empty($name)) {
            $name = "home";
        }

        $file = "controllers/$name.php";

        if (file_exists($file)) {
            require $file;
        } else {
            header("HTTP/1.0 404 Not Found");
            exit("Página no encontrada");
        }
    }

    function view($template, $vars = array()) {
        extract($vars);
        require "views/$template.tpl.php";
    }

    // Get the GET url.
    function url() {
        if (empty($_GET['url'])) {
            $url = "";
        } else {
            $url = $_GET['url'];
        }
        return $url;
    }