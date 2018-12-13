<?php
namespace Oquiz\Controllers;
use Oquiz\Utils\User;
abstract class CoreController {
    protected $router;
    protected $templates;
    public function __construct($app) {
        $this->templates = new \League\Plates\Engine(__DIR__.'/../Views');
        $this->router = $app->getRouter();
        $this->templates->addData([
            'title' => 'O\'Quizz',
            'basePath' => $app->getConfig('BASEPATH').'/',
            'router' => $this->router,
            'connectedUser' => User::getUser()
        ]);
    }
    public static function sendJSON($data) {
      header('Content-Type: application/json');
      echo json_encode($data, JSON_PRETTY_PRINT);
      exit;
    }
    public function sendHttpError($code, $source='') {
        if ($code == 403) {
            header('HTTP/1.0 403 Forbidden');
            echo $source;
            exit;
        }
    }
    public function redirect($url) {
        header('Location: '.$url);
        exit;
    }
    public function redirectToRoute($routeName, $params=array()) {
        $this->redirect($this->router->generate($routeName, $params));
    }
}
