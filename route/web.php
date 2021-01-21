<?php
/**
 * Routes for routing between requests
 * use $router object to define the routes
 * get and post
 */

$router->get('/', function () {
    return HomeController::Index();
});

$router->get('/s', function () {
    return HomeController::Search();
});

$router->get('/pictures', function ($request) {
    return PictureController::getPictures($request);
});

$router->post('/likeit', function ($request) {
    return LikeController::store($request);
});

$router->post('/viewed', function ($request) {
    return PictureController::viewed($request);
});