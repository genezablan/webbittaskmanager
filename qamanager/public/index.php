<?php

error_reporting(0);


try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */

    include __DIR__ . "/../app/config/loader.php";



    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";


    //Register routing policies
    include '../app/config/routes.php';

    include __DIR__ . "/../app/config/constants.php";

    
        
    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
