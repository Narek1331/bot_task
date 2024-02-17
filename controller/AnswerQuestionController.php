<?php
require_once $baseDir . '/model/AnswerQuestionModel.php';

class AnswerQuestionController{

    private $answer_model;
    public function __construct(){
        $this->answer_model = new AnswerQuestionModel();
    }

    public function index(){
        $datas =  $this->answer_model->getAll();

        include 'view/answer.php';
    }

    public function store(){

        $answer = $_POST["answer"];
        $question = $_POST["question"];

        if(!$answer || !$question ){
            header("Location: /index.php");
            exit();
        }

        $this->answer_model->store($answer,$question);

        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
        exit();

    }

    public function destroy(){

        $answer_id = $_POST["answer_id"];

        if(!$answer_id){
            header("Location: /index.php");
            exit();
        }

        $this->answer_model->delete($answer_id);

        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
        exit();

    }

    public function updateQuestion(){

        $answer_id = $_POST["answer_id"];
        $new_question_name = $_POST["new_question_name"];

        if(!$answer_id || !$new_question_name){
            header("Location: /index.php");
            exit();
        }

        $this->answer_model->updateQuestion($answer_id, $new_question_name);

        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
        exit();

    }


}