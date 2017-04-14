<?php
require_once("Route.php");
class Router {

        private $url;
        private $routes= [];

        public function __construct($utl){
          $this->url = $url;
        }


        public static function get($path, $callable){

                $route = new Route($path, $callable);
                $this->routes['GET'] = $route;

                /*if($_GET['url'] == $route){
                      $function-> __invoke();
                }    */

        }
        public static function post($path, $callable){

                $route = new Route($path, $callable);
                $this->routes['POST'] = $route;

                /*if($_GET['url'] == $route){
                      $function-> __invoke();
                }    */

        }
        public function run(){
          echo'<pre>';
          echo print_r($this->route);
          echo '</pre>';
        }

}
?>
