<?php

    /* Debug 
     ***********************************************************************/

    #phpinfo();
    #echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";
    #die();
#

    /* Include all from composer
     ***********************************************************************/
    require_once __DIR__ . '/vendor/autoload.php';

    /* FIX CORS PROBLEM 
     ***********************************************************************/


    /* Declare request, response and session  
     ***********************************************************************/
    use Symfony\Component\HttpFoundation\Request;
    $request = Request::createFromGlobals();

    use Symfony\Component\HttpFoundation\Response;
    $response = new Response();

    use Symfony\Component\HttpFoundation\Session\Session;
    $session = new Session();
    $session->start();


    /*  Database Connection 
     ***********************************************************************/

    $uri = "mongodb://root:example@persistence:27017/test?ssl=false";
//    $client = new MongoDB\Client($uri);
//    $client = new \MongoDB\Client($uri);
//    $client = new MongoClient();

    $client = new MongoDB\Driver\Manager($uri);
    $query = new MongoDB\Driver\Query(array('age' => 30));
    $cursor = $client->executeQuery('test.test', $query);

    // authentication mechanism requires libmongoc built with ENABLE_SSL 

    print_r($cursor->toArray());



// Query Class

// Output of the executeQuery will be object of MongoDB\Driver\Cursor class

// Convert cursor to Array and print result
    $db = $client->test;


    /*  Analyse Request 
     ***********************************************************************/

    print_r($db);
    echo json_encode($db);


    /* Manage Session 
     ***********************************************************************/
    $session->set('token', 'a6c1e0b6');


    /* Response 
     ***********************************************************************/
    $response->setContent($session->get('token'));
    $response->headers->set('Content-Type', 'application/json');
    $response->setStatusCode(Response::HTTP_OK);
    $response->send();


?>
