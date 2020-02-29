<?php
//Router - маршрутизация путей

/*
* Class Router
*
* @method start()
*/

class Router {

  private $routes; // Массив маршрутов
  private $route; // Получаем введенную ссылку из строки браузера
  private $page404; // Страница 404

  
  public function __construct(array $routes, string $page404) {
    $this->routes = $routes;
    $this->route = $_SERVER['REQUEST_URI'];
    $this->page404 = $page404;

  }

      // 1. Маршрутизация
    /*
    * start( string $route, array $routes )
    */
  
  public function start() {
    if ( array_key_exists($this->route, $this->routes) ) {

      include $this->routes[$this->route];

    } else {

      include $this->page404;
    }

  }
}
