<?php

//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Define a default route (home page)
$f3->route('GET /', function() {
    //echo "My Food Page";
    $view = new Template();
    echo $view->render('views/home.html');
    //echo '<img src="images/food2.jpg">';
});

//Define a default route
$f3->route('GET /@first/@last', function($f3, $params) {

    echo "Hello, " . $params['first']. " " . $params['last'];
});


//Define a "breakfast" route
$f3->route('GET /breakfast', function() {
    //echo "Breakfast";
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

//Define a "lunch" route
$f3->route('GET /lunch', function() {

    $view = new Template();
    echo $view->render('views/lunch.html');
});

//Define a "lunch/sandwich" route
$f3->route('GET /lunch/sandwich', function() { //logical

    $view = new Template();
    echo $view->render('views/sandwich.html'); //view
});

//Define a "lunch/sandwich" route
$f3->route('GET /breakfast/@item', function($f3, $params) { //logical

    var_dump($params);
    $menu = array('eggs', 'waffles', 'pancakes');
    $item = $params['item'];
    if (in_array($params['item'], $menu)) {
        switch($item) {
            case 'eggs';
                $view = new Template();
                echo $view->render('views/eggs.html');
                break;
            case 'pancakes';
                echo "Swedish of American?";
                break;
            case 'waffles';
                $f3->reroute("http://wafflehouse.com");
                break;
            default:
                $f3->error(404);
        }
    }
    else{
        echo "Sorry, we don't serve $item";
    }
    //$view = new Template();
    //echo $view->render('views/breakfast.html'); //view
});



//Run fat free
$f3->run();