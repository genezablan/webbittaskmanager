<?php

$env = 'localhost';

$baseUri['localhost'] = 'http://localhost/taskmanager/qamanager/';

$database['localhost']['adapter'] = 'Mysql';
$database['localhost']['host'] = 'localhost';
$database['localhost']['username'] = 'root';
$database['localhost']['password'] = '';
$database['localhost']['dbname'] = 'qamanager';




define('BASE_URI', $baseUri[$env]);

return new \Phalcon\Config(array(
    'database' => $database[$env],
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'baseUri'        => $baseUri[$env],
    )
));
