<?php

declare(strict_types = 1);

// demo data
$numbers = [
    1234235345345345,
    3545435454354543,
    5674765786886788,
    0000000000000042,
    7896768545353535
];

$rand_keys = array_rand($numbers, 2);
$serial = $numbers[$rand_keys[0]];

$payload = [
    'status' => '42',
    'message' => 'hello world',
    'serial' => $serial,
    'pool' => $numbers
];

// view stuff
use DarkStar\View\ViewFactory;

$view_factory = new ViewFactory;
$view = $view_factory->newInstance();

// set views and layouts
$view_registry = $view->getViewRegistry();
$view_registry->set('index_view', __DIR__ . '/template/_index.php');
$view_registry->set('_item', __DIR__ . '/template/_item.php');

$layout_registry = $view->getLayoutRegistry();
$layout_registry->set('layout', __DIR__ . '/template/layout.php');
$layout_registry->set('_animation', __DIR__ . '/template/_animation.php');

// set data for views
$view->setData(['payload' => $payload]);

// set current view and layout
$view->setView('index_view');
$view->setLayout('layout');



// result
$response = $view->__invoke(); // or just $view()

header('Content-Type: text/html; charset=utf-8');
echo $response;
