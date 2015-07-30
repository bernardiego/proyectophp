<?php

    class HomeController {

        public function indexAction() {
            $view = new View('home', ['titulo' => 'Mejorando.la']);
            $view.execute();
        }

    }