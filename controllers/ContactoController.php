<?php

    class ContactoController {

        public function ciudadAction($ciudad) {
            exit('contactos/'. $ciudad);
        }

        public function indexAction() {
            return new View('contacto', ['titulo' => 'Mejorando.la']);
        }

    }