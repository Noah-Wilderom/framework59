<?php
namespace Framework59;

use Exception;
use ReflectionMethod;
use Framework59\Route;
use Framework59\App\Controller;

/**
 * Core of the framework
 * 
 * @author Noah Wilderom
 */
class Core extends Controller {
    protected $currentController;
    protected $currentMethod;
    protected $currentPath;
    protected $params;
    protected $errors;

    public function __construct() 
    {
        $errors = is_array($this->errors) ? $this->errors : [];
        $url = $this->getUrl();
        foreach(Route::getRoutes() as $route) 
        {
            $route = (object) $route;
            if($route->path == $url || $route->path == '/') {
                if($url == '' || $route->path == $url) 
                {
                    require_once '../app/Http/Controllers/' . explode('\Controllers\\', $route->controller)[1] . '.php';
                    if(class_exists($route->controller)) 
                    {
                        $obj = new $route->controller;
                        if(method_exists($obj, $route->method) && $obj instanceof $route->controller) 
                        {
                            $this->currentController = $route->controller;
                            $this->currentMethod = $route->method;
                            $this->params = $route->params;
                        }
                    }
                }
            }
        }


        if(!isset($this->currentController) || !isset($this->currentMethod))
        {
            $errors = [];
            if(config['DEBUG_MODE'])
            {
                if($url != null)
                {
                    $url = explode('/', $url);
                    return print_r($url);
                }

                if(!in_array($url, (array)Route::getRoutes())) $errors[] = '[Framework59] Route does not exist for: ' . $url;
                $errors[] = '[Framework59] Controller ' . $this->currentController . ' or Method' . $this->currentMethod . ' does not exists';
            }
            self::send404($errors);
        } 
        try
        {
            $controller = new $this->currentController;
            $check = new ReflectionMethod($this->currentController, $this->currentMethod);
            if(count($check->getParameters()) > 0) return call_user_func(array($controller, $this->currentMethod), $this->params);
            return call_user_func(array($controller, $this->currentMethod));
        } 
        catch (\Throwable $e) { 
            $errors[] = $e;
            self::send500($errors);
        } 
        catch (\Exception $e) {
            $errors[] = $e; 
            self::send500($errors);
        }
        

    }
    
    

    public function getURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            // Filter de url van alles wat niet in een url thuishoort 
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url;
        }
    }

    public static function send500($errors) {
        if(!is_array($errors)) $errors = [$errors];
        
        require_once 'errorpages/500.php';
        return die();
        
    }

    public static function send403($errors) {
        require_once 'errorpages/403.php';
        return die();
    }

    public static function send404($errors) {
        require_once 'errorpages/404.php';
        return die();
    }
}