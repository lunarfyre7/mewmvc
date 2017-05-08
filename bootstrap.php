<?php
define('ROOT_PATH', __DIR__ . '/');
$GLOBALS['CONF'] = include 'config.php';
include 'helpers.php';
include 'makedb.php';

spl_autoload_register(function ($name) {
    foreach(array('classes/', 'controllers/') as $dir) {
        if (file_exists( ROOT_PATH.$dir.$name.'.php')) {
            include_once ROOT_PATH.$dir.$name.'.php';
            return;      
        }
    }
});

//resolver
$requestPage = '';
if (empty($_GET['p'])) {
    $requestPage = '/';
} else {
    $requestPage = htmlspecialchars($_GET['p']);
}
function renderView($controllerName, $template, $args=false) {
    if (class_exists($controllerName) or true) {
        $view = new $controllerName($template, $args);
        $view->render();
    } else{
        header404();
        $view = new Err404Controller('404');
        $view->render();
    }
}

#renderview($requestPage.'_controller', $requestPage);

#routes
$routes = array(
    '/' => function () {
        renderview('default_controller', 'default');
    },
    '/page/*' => function ($glob) {
        renderview('page_controller', 'default', array('page' => $glob));
    },
    '/foo/*' => function ($glob) {
        echo 'foo/'.$glob;
    }
);

function route($routes, $path) {
    $pathsym = explode('/',$path);
    foreach($routes as $route => $callback) { //parse routes
        $routesym = explode('/',$route);
        $routecnt = count($routesym);
        $pathcnt = count($pathsym);
        //check for glob op, or skip paths deeper than route
        if ($routecnt <= $pathcnt and strpos($route,'*')) {
            // echo "globbed $route";
            $do = true;
            for ($i=1;$i<$routecnt-1;$i++) {//check for matching overlap (clipping off beginning and end)
                if ($pathsym[$i] !== $routesym[$i]) 
                    $do = false;
            }
            if ($do) {
                $callback(end($pathsym));
                return;
            }
        } else if ($routecnt === $pathcnt) { //patching path lenghs
            // echo "matched $route";
            $callback();
            return;
        }
    }

    //fail
    header404();
    $view = new Err404Controller('404');
    $view->render();
}
route($routes, $requestPage);