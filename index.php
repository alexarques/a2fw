<?php
    ini_set('display_errors', 'Off');
    require __DIR__.'/vendor/autoload.php';
    require __DIR__ . '/bootstrap.php';

    use App\App;



    $config=require 'config.php';
    

    App::start();