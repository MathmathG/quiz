<?php
namespace Oquiz\Controllers;
use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;
use Oquiz\Models\UserModel;
use Oquiz\Utils\User;
class MainController extends CoreController {
    public function home() {
    $quizzList = QuizModel::findAll();
    echo $this->templates->render('main/home', [
        'quizzList' => $quizzList,
      ]);
    }
}
