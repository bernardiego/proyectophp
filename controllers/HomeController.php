<?php

    class HomeController {

        public function indexAction() {
            return new View('home', ['titulo' => 'Mejorando.la']);
        }

    }