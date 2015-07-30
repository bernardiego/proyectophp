<?php

    class View extends Response {

        protected $template;
        protected $vars = Array();

        public function __construct($template, $vars = array()) {
            $this->template = $template;
            $this->vars = $vars;
        }

        public function execute() {
            $template = $this->getTemplate();
            $vars     = $this->getVars();

            call_user_func(function() use ($template, $vars) {
                extract($vars);

                /*
                 * Store in a variable the content of the template/strings
                 * contained between ob_start() and ab_get_clean().
                 */
                ob_start();
                view($template);
                $tpl_content = ob_get_clean();

                view('layout', ['tpl_content' => $tpl_content]);
            });
        }

        public function getTemplate()
        {
            return $this->template;
        }

        public function getVars()
        {
            return $this->vars;
        }

    }