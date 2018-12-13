<?php
namespace Oquiz\Controllers;
use Oquiz\Models\QuizModel;
use Oquiz\Models\QuestionModel;
use \Oquiz\Utils\User;
class QuizController extends CoreController {

    public function quiz($param) {
        $quizzId = (int) $param['id'];
        $quizz = QuizModel::find($quizzId);
        //dump($quizz);
        $quizzList = QuizModel::findAll();
        //dump($quizzList);
        $questionsList = QuestionModel::getQuestionsByQuizzId($quizzId);
        //dump($questionsList);
        $prop = QuestionModel::getProps($quizzId);



        //dump($quizProp);
        $connectedUser = User::getUser();
        if ($connectedUser !== false){

        echo $this->templates->render('list/form', [
            'quizzId' => $quizzId,
            'quizz' => $quizz,
            'questionsList' => $questionsList,
            'quizzList' =>$quizzList,
            'prop' => $prop
        ]);
    }
    elseif ( !empty($_POST)){
        echo $this->templates->render('list/formResult', [
            'quizzId' => $quizzId,
            'quizz' => $quizz,
            'questionsList' => $questionsList,
            'quizzList' =>$quizzList,
            'prop' => $prop
        ]);
    }
    else{
        echo $this->templates->render('front/quiz', [
            'quizzId' => $quizzId,
            'quizz' => $quizz,
            'questionsList' => $questionsList,
            'quizzList' =>$quizzList,
        ]);
    }
    }
}
