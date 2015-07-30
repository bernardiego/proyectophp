<?php

    /*
     * Front-end Controller file.
     * It'll configure our application.
     */
    require 'config.php';
    //require 'helpers.php';

    // Library classes
    require 'library/Request.php';
    require 'library/Inflector.php';

    // Call the right controller.
    if (empty($_GET['url'])) {
        $url = "";
    } else {
        $url = $_GET['url'];
    }

    $request = new Request($url);
    $request->execute();