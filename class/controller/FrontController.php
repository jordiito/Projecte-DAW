<?php

class FrontController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dispatch()
    {
        $params = null;
        // if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['url'])) {
            $url = $this->sanitize($_GET['url'], 0);
            $url = trim($_GET['url'], '/'); // trec la barra final
            $url = filter_var($url, FILTER_SANITIZE_URL); // elimino caràcters especial
            $url = explode('/', $url); // divideixo la url
            if (isset($url[0])) {
                $controller_name = ucwords($url[0]); // poso la inicial en majúscula
                if (isset($url[1])) {
                    $action = $url[1];
                }
                if (isset($url[2])) {
                    $params[] = $url[2];
                    if (isset($url[3])) {
                        $params[] = $url[3];
                        if (isset($url[4])) {
                            $params[] = $url[4];
                            if (isset($url[5])) {
                                $params[] = $url[5];
                            }
                        }
                    }
                }
            }
        } else {
            $controller_name = "HomeController";
            $action = "show";
        }
        // }

        if (file_exists("class/controller/$controller_name.php")) {
            $controller = new $controller_name(); // instancio el controlador

            if (method_exists($controller, $action)) {
                $controller->$action($params); // executo l'acció
            } else {
                throw new Exception("L'acció no existeix: $action generat a 'FrontController'"); // no hi ha acció
            }
        } else {
            throw new Exception("El controlador no existeix: $controller_name generat a 'FrontController'"); // no hi ha controlador
        }
    }
}

?>