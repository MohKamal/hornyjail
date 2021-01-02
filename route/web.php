<?php
/**
 * Require all file
 * Routes for routing between requests
 */

namespace Showcase {

    use \Showcase\Framework\HTTP\Routing\Router;
    use \Showcase\Framework\HTTP\Routing\Request;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\Views\View;
    use \Showcase\Controllers\HomeController;
    use \Showcase\Controllers\PictureController;
    use \Showcase\Controllers\LikeController;
    use \Showcase\Framework\IO\Debug\Log;
    use \Showcase\Models\Picture;
    use \Showcase\Framework\Session\Session;

    $router  = new Router(new Request);

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
    
    //Error Pages
    $router->get('/errors/404', function () {
        return View::show('Errors/404');
    });

    $router->get('/errors/405', function () {
        return View::show('Errors/405');
    });

    $router->get('/errors/500', function () {
        return View::show('Errors/500');
    });
}

?>