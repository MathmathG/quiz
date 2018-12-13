<?php

namespace Oquiz;

//Imporet altorouter d'un autre namespace
use\AltoRouter;

class Application {


    private $router;


    private $config;

    public function __construct(){
        //Récupération de la configuration
        $this->config = parse_ini_file(__DIR__.'/config.conf');

        //J'intancie altorouter
        $this->router = new AltoRouter();

        //Le chemin complet
         $this->router->setBasePath($this->config['BASEPATH']);

         //Je définis mes routes avec une methode

         $this->defineRoutes();

    }

    public function defineRoutes(){


        $this->router->map('GET', '/', 'MainController#home', 'main_home');//acceuil
        $this->router->map('GET|POST', '/quiz/[i:id]', 'QuizController#quiz', 'main_quiz');
        $this->router->map('GET|POST', '/quiz-result/[i:id]', 'QuizController#quiz', 'main_quizResult');
        $this->router->map('GET|POST', '/signup', 'UserController#signup', 'main_signup');//inscription
        $this->router->map('GET|POST', '/signin', 'UserController#signin', 'main_signin');//connection
		$this->router->map('POST', '/signin', 'UserController#signinpost', 'main_signinpost');
        $this->router->map('GET', '/compte', 'UserController#login', 'main_login');//profil user (accessible seulement à l'user connecté)
        $this->router->map('GET', '/logout', 'UserController#logout', 'main_logout');

    }

    public function run() {
        // Je fais le match d'une route par rapport à l'URL courante

        $match = $this->router->match();

        //dump($match);

        // si on a un résultat (une route qui correspond)
        if ($match !== false) {
            // DISPATCH !
            // explode() = renvoie une tableau de string, à partir d'un autre string, en les séparant pour chaque #
            //dump($match['target']);
            $tmp = explode('#', $match['target']);
            //dump($tmp);
            // list permet d'affecter chaque élément du tableau $tmp dans des variables, en suivant l'ordre des variables
            list($controllerName, $methodName) = $tmp;
            //dump($controllerName);
            //dump($methodName);

            // Je construis le FQCN correspond au controller
            // On a besoin d'instancier la classe à partir de son FQCN ("chemin absolu")
            // car on fait un new $fqcnControllerName (PHP nous y oblige)
            $fqcnControllerName = '\Oquiz\Controllers\\'.$controllerName;

            // On instancie le controller
            $controller = new $fqcnControllerName($this);
            //dump($controller);

            // J'appelle la méthode
            $controller->$methodName($match['params']);
        }
        // Si ça match pas => Sonia-404
        else {
            // On envoie l'entete HTTP disant "Page not found"
            header("HTTP/1.0 404 Not Found");
            // On peut même afficher un truc !
            echo '404 <br>';
            exit;
        }


        }

        public function getConfig($key) {
            if (array_key_exists($key, $this->config)) {
                return $this->config[$key];
            }
                return false;
            }

        public function getRouter(){

            return $this->router;
    }
}
