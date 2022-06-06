<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
session_set_cookie_params(0);
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // la sessio dura 7 dies
session_start();
print_r($_COOKIE["lang"]);
print_r($_COOKIE);
print_r($_COOKIE['cart']);
print_r($_SESSION['cart']);
spl_autoload_register(function ($classe) {
    $folders = array(
        'model',
        'view',
        'controller'
    );
    foreach ($folders as $folder) {
        $path = "class/$folder/$classe.php";
        if (file_exists($path)) {
            require_once ($path);
            return;
        }
    }
    throw new Exception("No es pot accedir al fitxer: $path generat a 'autoload'");
});

try {
    // Controlador frontal
    $app = new FrontController();
    $app->dispatch();
} catch (Exception $e) {
    // Controlador d'errors
    $error = new ErrorController($e);
    $error->show();
}

?>
