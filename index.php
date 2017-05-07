<?php
$GLOBALS['CONF'] = include 'config.php';
include 'helpers.php';

spl_autoload_register(function ($name) {
    include_once 'classes/'.$name . '.php';
});


//include controllers
foreach(glob('controllers/*.php') as $file) {
    include $file;
}

//resolver
$tplName = '';
if (empty($_GET['p'])) {
    $tplName = 'default';
} else {
    $tplName = htmlspecialchars($_GET['p']);
}
function renderView($controllerName, $template) {
    if (class_exists($controllerName, false)) {
        $view = new $controllerName($template);
        $view->render();
    } else{
        header404();
        $view = new Err404Controller('404');
        $view->render();
    }
}

renderview($tplName.'_controller', $tplName);