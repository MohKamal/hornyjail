<?php

namespace Showcase\Framework\HTTP\Routing {

    use \Showcase\AutoLoad;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\Views\View;

    /**
     * Response object
     * To make return response easy
     */
    class Response
    {
        public function __construct()
        {
            //todo
        }

        /**
         * 
         * return a view by name
         * 
         * @param string view name
         */
        function view($view, array $vars=array()){
            return View::show($view, $vars);
        }

        /**
         * Redirection to an url
         * 
         * @param string url to be redirected to
         */
        function redirect($url){
            return URL::Redirect($url);
        }

        /**
         * Return a json response
         * 
         * @param object data to return
         */
        function json($data){
            header('Content-Type: application/json');
            return json_encode($data);
        }
    }
}
