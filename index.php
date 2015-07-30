<?php

    /* index.php
     * Front-end Controller file.
     * It'll configure our application.
     */

    require 'config.php';
    //require 'helpers.php';

    // Library classes
    require 'library/Inflector.php';
    require 'library/Request.php';
    require 'library/Response.php';
    require 'library/View.php';

    // Call the right controller.
    if (empty($_GET['url'])) {
        $url = "";
    } else {
        $url = $_GET['url'];
    }

    $request = new Request($url);
    $request->execute();