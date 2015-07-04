<?php
    
    define( 'BASE_PATH', substr( __DIR__, 0, strrpos( __DIR__, DIRECTORY_SEPARATOR ) ) ); 
    set_include_path( get_include_path() . PATH_SEPARATOR . BASE_PATH );

    
    // register autoload
    include('src\Eceon\Autoload.php');
    $loader = new Eceon\Autoload();
    $loader->register();
    $loader->addNamespace( 'Application//', 'application/' );

    
    // create DI container
    $dic = new Eceon\DI\Container( 'app.di.container' );
    
    // create di loader and load application wire file
    $diLoader = new Eceon\DI\Loader\XML();
    $diLoader->importFileIntoContainer( $dic, 'application/app.xml' );


    // request & response 
    $request = $dic->load( 'app.request' );
    $response = $dic->load( 'app.response' );
    
    // create frontcontroller
    $frontController = $dic->load( 'app.frontcontroller' );
    
    // run frontcontroller
    $frontController->run( $request, $response );
    